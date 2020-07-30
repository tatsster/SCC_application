import re

b = "xem báo cáo tầng 4 phòng 193  tòa A4 thiết bị A504 25/07/2020 từ 12:00:00 đến 14:00:00"
x = 'tầng'
# mystring =  "hi my name is ryan, and i am new to python and would like to learn more"
# keyword = 'name'
# before_keyword, keyword, after_keyword = mystring.partition(keyword)
# print(before_keyword)
# arr = after_keyword.split(" ", 3)
# print(arr[1])
import re
from datetime import datetime

def get_input(b, a):
    if a in b:
        b = b.split(a)
        b = b[1].split(' ', 3)
        return b[1]
    else:
        return None
def get_time(b):
    arr = ["hôm nay", "hôm qua"]
    for x in arr:
        if x in b:
            return x
    matches = re.findall('(\d{2}[-/](\d{2})[-/]\d{2,4})', b)
    if matches:
        for match in matches:
            return match[0]
    else:
        return None

def extract_info(b):
    building = get_input(b, "tòa")
    floor = get_input(b, "tầng")
    room = get_input(b, "phòng")
    date = get_time(b)
    if date is None:
        fr_om,t_o=None
    else:
        fr_om = get_input(b, "từ")
        t_o = get_input(b, "đến")
    return building, floor, room, date, fr_om, t_o

print(get_input(b,"thiết bị"))
building, floor, room, date, fr_om, t_o = extract_info(b)
c = datetime.strptime(str(fr_om), '%H:%M:%S')
print(c)
print(building, floor, room, date, fr_om, t_o)

