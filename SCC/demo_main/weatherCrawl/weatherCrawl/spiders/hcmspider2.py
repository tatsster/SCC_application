import scrapy
import re
from ..items import WeathercrawlItem

class HcmSpider(scrapy.Spider):
    
    
    name= 'hcmspi2'
    year=2000
    months=['january','february','march','april','may','june','july','august','september','october','november','december']
    count=1
    i=1
    condition=True
    start_urls = ['https://www.accuweather.com/en/vn/ho-chi-minh-city/353981/august-weather/353981?year=2000']

        
    def parse(self,response):
        
        for count in range(1,36):
            
            if HcmSpider.year>=2020 and HcmSpider.i>=7:
                if len(response.xpath('/html/body/div/div[5]/div[1]/div[1]/div[2]/div/div[2]/a['+str(count)+']/div[2]/div[1]/text()').extract())== 0:
                    break
            else:
                item=WeathercrawlItem()
                data_temp=response.xpath('/html/body/div/div[5]/div[1]/div[1]/div[2]/div/div[2]/a['+str(count)+']/div[2]/div[1]/text()').extract()
                data_date=response.xpath('/html/body/div/div[5]/div[1]/div[1]/div[2]/div/div[2]/a['+str(count)+']/div[1]/text()').extract()
                
                print(len(response.xpath('/html/body/div/div[5]/div[1]/div[1]/div[2]/div/div[2]/a['+str(count)+']/div[2]/div[1]/text()').extract()))
                if re.search(r'\d+', str(data_temp)) is not None:
                    item['Temp']=int(re.search(r'\d+', str(data_temp)).group())
                    item['Date']=str(re.search(r'\d+', str(data_date)).group())
                    
                    yield item
        HcmSpider.i+=1
        if(HcmSpider.i>=12):
            HcmSpider.i=0
            HcmSpider.year+=1
            HcmSpider.condition=False
        
        next_month='https://www.accuweather.com/en/vn/ho-chi-minh-city/353981/'+str(HcmSpider.months[HcmSpider.i])+'-weather/353981?year='+str(HcmSpider.year)
        print(next_month)    
        if HcmSpider.i<12 and HcmSpider.condition==True:
           
        
            # print((HcmSpider.months[HcmSpider.i]))
            yield response.follow(next_month,callback = self.parse)
        elif HcmSpider.year<=2020:
            
            HcmSpider.condition=True
            yield response.follow(next_month,callback = self.parse)
            
                
        
            
        
     
            