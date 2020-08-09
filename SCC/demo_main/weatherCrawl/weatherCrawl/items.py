# Define here the models for your scraped items
#
# See documentation in:
# https://docs.scrapy.org/en/latest/topics/items.html

import scrapy


class WeathercrawlItem(scrapy.Item):
    # define the fields for your item here like:
    # name = scrapy.Field()
    Humid=scrapy.Field()
    Temp=scrapy.Field()
    Date=scrapy.Field()
    pass
