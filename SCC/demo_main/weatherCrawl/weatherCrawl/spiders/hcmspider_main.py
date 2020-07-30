import scrapy
import re
from ..items import WeathercrawlItem

class HcmSpider(scrapy.Spider):

    name='hcmcurrent'
    start_urls = ['https://www.accuweather.com/en/vn/ho-chi-minh-city/353981/hourly-weather-forecast/353981']

    # def get_Date(dates):
         
    def parse(self,response):
        
        item=WeathercrawlItem()
        data_temp=response.xpath('/html/body/div/div[5]/div[1]/div[1]/div[1]/div[1]/div[1]/div/div[1]/text()').extract()
        data_time=response.xpath('/html/body/div/div[5]/div[1]/div[1]/div[1]/div[1]/div[1]/div/h2/span[1]/text()').extract()
        data_date=response.xpath('/html/body/div/div[5]/div[1]/div[1]/div[1]/div[1]/div[1]/div/h2/span[2]/text()').extract()
        data_humid=response.xpath('/html/body/div/div[5]/div[1]/div[1]/div[1]/div[1]/div[2]/div/div/div[1]/p[4]/span/text()').extract()
        data_date=[ x.replace('\t', '').replace('\n', '') for x in data_date ]
      
        item['Temp']=int(re.search(r'\d+', str(data_temp)).group())
        item['Date']=data_date+data_time   
        item['Humid']=data_humid
        yield item