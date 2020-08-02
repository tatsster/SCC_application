import scrapy

from ..items import WeathercrawlItem

class HcmSpider(scrapy.Spider):
    
    
    name= 'hcmspi'
    start_urls = ['https://www.accuweather.com/vi/vn/ho-chi-minh-city/353981/july-weather/353981']
   
    def parse(self,response):
        b=['TB trong lịch sử']   
        item=WeathercrawlItem()
        count=0
        count1=0
        
        predict_weather=[]
        temperature='°'
        for i in range(1,36):
            if response.xpath('/html/body/div/div[5]/div[1]/div[1]/div[2]/div/div[2]/a['+str(i)+']/div[2]/div[1]/text()').extract()==[]:
                break
            else: 
                count1+=1
        
        while (count<=7):
            data_temp=response.xpath('/html/body/div/div[5]/div[1]/div[1]/div[2]/div/div[2]/a['+str(count1)+']/div[2]/div[1]/text()').extract()
            data_temp=[ x.replace('\t', '').replace('\n', '') for x in data_temp]
            item['Temp']=data_temp
            count1-=1
            count+=1
            yield item
       
        # for i in range(0,len(predict_weather)):
        #     predict_weather = predict_weather.replace("'","")
            
        
        
           
            
        
        
            
        