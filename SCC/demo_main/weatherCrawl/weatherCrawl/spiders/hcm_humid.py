import scrapy
import re
from ..items import WeathercrawlItem

class HcmSpider(scrapy.Spider):
    
    name='hcm_humid'
    start_urls = ['https://www.accuweather.com/en/vn/ho-chi-minh-city/353981/daily-weather-forecast/353981']

    # def get_Date(dates):
         
    def parse(self,response):
        count=2
        item=WeathercrawlItem()
        for i in range(2,15):
            data_humid=response.xpath('/html/body/div/div[5]/div[1]/div[1]/div['+str(count)+']/a/div[3]/text()').extract()
            data_humid=[ x.replace('\t', '').replace('\n', '') for x in data_humid ]
            data_humid = [e for e in data_humid if e] 
            data_date1=response.xpath('/html/body/div/div[5]/div[1]/div[1]/div['+str(count)+']/a/div[1]/h2/span[1]/text()').extract() 
            date_date2=response.xpath('/html/body/div/div[5]/div[1]/div[1]/div['+str(count)+']/a/div[1]/h2/span[2]/text()').extract()
            count+=1
            if re.search(r'\d+', str(data_humid)) is not None:
                item['Humid']=data_humid
                item['Date']=data_date1+date_date2
            yield item
            
            
            