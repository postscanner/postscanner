import json
import requests
import sys
from urllib import parse

def getCityId(name):    
    orig_name = name
    name = parse.quote(name)
    strange_name = parse.quote("c0:LBCRI|4;0:99;CBLF|" + str(len(orig_name)) + ";" + orig_name + ";")
    strange_name = strange_name.replace("%25", '')
    strange_name = "c0:LBCRI|4;0:99;CBLF|" + str(len(orig_name)) + ";" + orig_name + ";"
    # print(name)
    headers = {"Accept":"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
    "Accept-Encoding":"gzip,deflate,sdch",
    "Accept-Language":"en-US,en;q=0.8",
    "Content-Type":"application/x-www-form-urlencoded; charset=utf-8",
    }
    payload = {
    '__EVENTTARGET': '',
    '__EVENTARGUMENT': '',
    '__VIEWSTATE': '/wEPDwUKLTY5NjI1Nzk1Mg9kFgJmD2QWAgIDD2QWCgIDDzwrAAYBAA8WAh4FVmFsdWVlZGQCBQ88KwAGAQAPFgIfAGVkZAIHDxQrAAYPFgIfAAUf0JLRi9Cx0LXRgNC40YLQtSDQv9GA0L7QtNGD0LrRgmRkZDwrAAwBCzwrAAUBABYEHhJFbmFibGVDYWxsYmFja01vZGVoHidFbmFibGVTeW5jaHJvbml6YXRpb25PblBlcmZvcm1DYWxsYmFjayBoZGRkAgkPPCsABAEADxYCHwBoZGQCDQ9kFiACAQ8UKwAGDxYCHwACAWRkZDwrAAwBCzwrAAUBABYEHwFoHwJoZGRkAgMPFCsABg8WBB8AZh4PRGF0YVNvdXJjZUJvdW5kZ2RkZDwrAAwBCxQrAAUWBB8BZx8CaGRkZA9kEBYBZhYBFCsAARYCHg9Db2xWaXNpYmxlSW5kZXhmZGRkZAIFDxQrAAYPFgQfAGYfA2dkZGQ8KwAMAQsUKwAFFgQfAWcfAmhkZGQPZBAWAWYWARQrAAEWAh8EZmRkZGQCBw8UKwAGDxYGHwACgQEeB0VuYWJsZWRnHwNnZGRkPCsADAELFCsABRYEHwFnHwJoZGRkD2QQFgFmFgEUKwABFgIfBGZkZGRkAgkPFCsABg8WBh8AAnAfBWcfA2dkZGQ8KwAMAQsUKwAFFgQfAWcfAmhkZGQPZBAWAWYWARQrAAEWAh8EZmRkZGQCCw88KwAGAQAPFgIfAAUBMmRkAg0PPCsABgEADxYCHwAFATNkZAIPDzwrAAYBAA8WAh8ABQE0ZGQCEQ88KwAGAQAPFgIfAAUBNWRkAhMPPCsABAEADxYCHwAFENCj0L/QsNC60L7QstC60LBkZAIVDzwrAAYBAA8WAh8ABQE2ZGQCFw8UKwAGDxYEHwACAx4HVmlzaWJsZWdkZGQ8KwAMAQs8KwAFAQAWBB8BaB8CaGRkZAIdDzwrAAQBAA8WAh8AZWRkAh8PPCsAEQIADxYCHwZoZAEQFgAWABYAZAIhDzwrABECAA8WBh4LXyFEYXRhQm91bmRnHgtfIUl0ZW1Db3VudAIBHwZnZAEQFgAWABYAFgJmD2QWBmYPDxYCHwZoZGQCAQ9kFgJmD2QWAmYPFQYBNQY4NjUsNTQBMAExASAAZAICDw8WAh8GaGRkAicPZBYEAgEPFCsABg8WAh8AZGRkZDwrAAwBCzwrAAUBABYEHwFoHwJoZGRkAgMPPCsABgEADxYCHwBlZGQYAwUeX19Db250cm9sc1JlcXVpcmVQb3N0QmFja0tleV9fFgsFE2N0bDAwJGNiUHJvZHVjdCREREQFD2N0bDAwJGJ0blBvcExvZwUnY3RsMDAkQ29udGVudFBsYWNlSG9sZGVyMSRjYlByb2R1Y3QkREREBStjdGwwMCRDb250ZW50UGxhY2VIb2xkZXIxJGNiQ291bnRyeUZyb20kREREBSljdGwwMCRDb250ZW50UGxhY2VIb2xkZXIxJGNiQ291bnRyeVRvJERERAUoY3RsMDAkQ29udGVudFBsYWNlSG9sZGVyMSRjYkNpdHlGcm9tJERERAUmY3RsMDAkQ29udGVudFBsYWNlSG9sZGVyMSRjYkNpdHlUbyREREQFJ2N0bDAwJENvbnRlbnRQbGFjZUhvbGRlcjEkY2JQYWNrYWdlJERERAUhY3RsMDAkQ29udGVudFBsYWNlSG9sZGVyMSRidG5DYWxjBT5jdGwwMCRDb250ZW50UGxhY2VIb2xkZXIxJERlbGl2ZXJ5QmxvY2sxJGNiRGVsaXZlcnlQcm9kdWN0JERERAUxY3RsMDAkQ29udGVudFBsYWNlSG9sZGVyMSREZWxpdmVyeUJsb2NrMSRidG5DaGVjawUgY3RsMDAkQ29udGVudFBsYWNlSG9sZGVyMSRndkNhbGMPPCsADAEIAgFkBSVjdGwwMCRDb250ZW50UGxhY2VIb2xkZXIxJGd2SW50ZXJDYWxjD2dkFh6Y+zDwlqiIMrx2hY5tcQFPxpV+UNBkbHyn/3c5v8Y=',
    '__PREVIOUSPAGE': 'hCxYm-G9wVgyGd20xHlN6VXwFT2FrZVhPJS_VVAYRXyQgKWMMwOsyIoUIXAXxYk7g2GEorycbv2NefEofDy4gP8c0QjPQhg5vz3uNWE8LDc1',
    'tbPopLog_Raw': '',
    'ctl00$tbPopLog': 'Логин',
    'tbPopPwd_Raw': '',
    'ctl00$tbPopPwd': 'Пароль',
    'cbProduct_VI': 'Выберите продукт',
    'ctl00$cbProduct': 'Выберите продукт',
    'cbProduct_DDDWS': '0:0:-1:-10000:-10000:0:0:0:1:0:0:0',
    'cbProduct_DDD_LDeletedItems': '',
    'cbProduct_DDD_LInsertedItems': '',
    'cbProduct_DDD_LCustomCallback': '',
    'ctl00$cbProduct$DDD$L': '',
    'ctl00$chbRemember': 'U',
    'ContentPlaceHolder1_cbProduct_VI': '1',
    'ctl00$ContentPlaceHolder1$cbProduct': 'Экспресс-доставка',
    'ContentPlaceHolder1_cbProduct_DDDWS': '0:0:-1:-10000:-10000:0:0:0:1:0:0:0',
    'ContentPlaceHolder1_cbProduct_DDD_LDeletedItems': '',
    'ContentPlaceHolder1_cbProduct_DDD_LInsertedItems': '',
    'ContentPlaceHolder1_cbProduct_DDD_LCustomCallback': '',
    'ctl00$ContentPlaceHolder1$cbProduct$DDD$L': '1',
    'ContentPlaceHolder1_cbCountryFrom_VI': '0',
    'ctl00$ContentPlaceHolder1$cbCountryFrom': 'Россия',
    'ContentPlaceHolder1_cbCountryFrom_DDDWS': '0:0:-1:-10000:-10000:0:0:0:1:0:0:0',
    'ContentPlaceHolder1_cbCountryFrom_DDD_LDeletedItems': '',
    'ContentPlaceHolder1_cbCountryFrom_DDD_LInsertedItems': '',
    'ContentPlaceHolder1_cbCountryFrom_DDD_LCustomCallback': '',
    'ctl00$ContentPlaceHolder1$cbCountryFrom$DDD$L': '0',
    'ContentPlaceHolder1_cbCountryTo_VI': '0',
    'ctl00$ContentPlaceHolder1$cbCountryTo': 'Россия',
    'ContentPlaceHolder1_cbCountryTo_DDDWS': '0:0:-1:-10000:-10000:0:0:0:1:0:0:0',
    'ContentPlaceHolder1_cbCountryTo_DDD_LDeletedItems': '',
    'ContentPlaceHolder1_cbCountryTo_DDD_LInsertedItems': '',
    'ContentPlaceHolder1_cbCountryTo_DDD_LCustomCallback': '',
    'ctl00$ContentPlaceHolder1$cbCountryTo$DDD$L': '0',
    'ContentPlaceHolder1_cbCityFrom_VI': '129',
    'ctl00$ContentPlaceHolder1$cbCityFrom': 'Сан',
    'ContentPlaceHolder1_cbCityFrom_DDDWS': '1:1:12000:526:367:1:198:48:1:0:0:0',
    'ContentPlaceHolder1_cbCityFrom_DDD_LDeletedItems': '',
    'ContentPlaceHolder1_cbCityFrom_DDD_LInsertedItems': '',
    'ContentPlaceHolder1_cbCityFrom_DDD_LCustomCallback': '',
    'ctl00$ContentPlaceHolder1$cbCityFrom$DDD$L': '',
    'ContentPlaceHolder1_cbCityTo_VI': '112',
    'ctl00$ContentPlaceHolder1$cbCityTo': 'Санкт-Петербург',
    'ContentPlaceHolder1_cbCityTo_DDDWS': '0:0:-1:-10000:-10000:0:0:0:1:0:0:0',
    'ContentPlaceHolder1_cbCityTo_DDD_LDeletedItems': '',
    'ContentPlaceHolder1_cbCityTo_DDD_LInsertedItems': '',
    'ContentPlaceHolder1_cbCityTo_DDD_LCustomCallback': '',
    'ctl00$ContentPlaceHolder1$cbCityTo$DDD$L': '112',
    'ContentPlaceHolder1_tbLength_Raw': '2',
    'ctl00$ContentPlaceHolder1$tbLength': '2',
    'ContentPlaceHolder1_tbWidth_Raw': '3',
    'ctl00$ContentPlaceHolder1$tbWidth': '3',
    'ContentPlaceHolder1_tbHeight_Raw': '4',
    'ctl00$ContentPlaceHolder1$tbHeight': '4',
    'ContentPlaceHolder1_tbCalcWeight_Raw': '5',
    'ctl00$ContentPlaceHolder1$tbCalcWeight': '5',
    'ContentPlaceHolder1_tbCost_Raw': '6',
    'ctl00$ContentPlaceHolder1$tbCost': '6',
    'ContentPlaceHolder1_cbPackage_VI': '3',
    'ctl00$ContentPlaceHolder1$cbPackage': 'Другая упаковка',
    'ContentPlaceHolder1_cbPackage_DDDWS': '0:0:-1:-10000:-10000:0:0:0:1:0:0:0',
    'ContentPlaceHolder1_cbPackage_DDD_LDeletedItems': '',
    'ContentPlaceHolder1_cbPackage_DDD_LInsertedItems': '',
    'ContentPlaceHolder1_cbPackage_DDD_LCustomCallback': '',
    'ctl00$ContentPlaceHolder1$cbPackage$DDD$L': '3',
    'ContentPlaceHolder1_DeliveryBlock1_cbDeliveryProduct_VI': '',
    'ctl00$ContentPlaceHolder1$DeliveryBlock1$cbDeliveryProduct': 'Выберите продукт',
    'ContentPlaceHolder1_DeliveryBlock1_cbDeliveryProduct_DDDWS': '0:0:-1:-10000:-10000:0:0:0:1:0:0:0',
    'ContentPlaceHolder1_DeliveryBlock1_cbDeliveryProduct_DDD_LDeletedItems': '',
    'ContentPlaceHolder1_DeliveryBlock1_cbDeliveryProduct_DDD_LInsertedItems': '',
    'ContentPlaceHolder1_DeliveryBlock1_cbDeliveryProduct_DDD_LCustomCallback': '',
    'ctl00$ContentPlaceHolder1$DeliveryBlock1$cbDeliveryProduct$DDD$L': '',
    'ContentPlaceHolder1_DeliveryBlock1_InvoiceNumber_Raw': '',
    'ctl00$ContentPlaceHolder1$DeliveryBlock1$InvoiceNumber': 'Введите номер накладной',
    'DXScript': '1_187,1_101,1_130,1_137,1_180,1_105,1_141,1_129,1_98,1_172,1_170,1_132,1_124,1_121',
    'DXCss': '1_7,1_16,1_8,1_6,1_14,1_1,styles.css',
    '__CALLBACKID': 'ctl00$ContentPlaceHolder1$cbCityFrom',
    '__CALLBACKPARAM': strange_name,
    '__EVENTVALIDATION': '/wEWCQKe0uKRAQKWuLyyBwK8v5SrAQLB+unSCAKiqbXjAwLY7f3FDwKq463PDQKJkoqaCQKg4cr0BndB0+VsjJShK3J3E/Tqa4C79p1jDGL/JQQAANw+n+jZ',
    }
    url = 'http://www.me-online.ru/calculator.aspx'
    r = requests.post(url, data=payload, headers=headers)
    print(r.text)
    return r.text.split('(')[1]
    # return r.text.split("|")[3][:-1]

url = 'http://www.me-online.ru/calculator.aspx'

#print("Original city:")
#originalCityName = input()
#print("Deliviry city:")
#deliviryCityName = input()
origName = sys.argv[1]
delivName = sys.argv[2]
weight = sys.argv[3]
value = sys.argv[4]
origId = getCityId(origName)
delivId = getCityId(delivName)

origName = parse.quote(origName)
delivName = parse.quote(delivName)

payload = { 
    '__EVENTTARGET': '',
    '__EVENTARGUMENT': '',
    '__VIEWSTATE': '/wEPDwUKLTY5NjI1Nzk1Mg9kFgJmD2QWAgIDD2QWCgIDDzwrAAYBAA8WAh4FVmFsdWVlZGQCBQ88KwAGAQAPFgIfAGVkZAIHDxQrAAYPFgIfAAUf0JLRi9Cx0LXRgNC40YLQtSDQv9GA0L7QtNGD0LrRgmRkZDwrAAwBCzwrAAUBABYEHhJFbmFibGVDYWxsYmFja01vZGVoHidFbmFibGVTeW5jaHJvbml6YXRpb25PblBlcmZvcm1DYWxsYmFjayBoZGRkAgkPPCsABAEADxYCHwBoZGQCDQ9kFiACAQ8UKwAGDxYCHwACAWRkZDwrAAwBCzwrAAUBABYEHwFoHwJoZGRkAgMPFCsABg8WBB8AZh4PRGF0YVNvdXJjZUJvdW5kZ2RkZDwrAAwBCxQrAAUWBB8BZx8CaGRkZA9kEBYBZhYBFCsAARYCHg9Db2xWaXNpYmxlSW5kZXhmZGRkZAIFDxQrAAYPFgQfAGYfA2dkZGQ8KwAMAQsUKwAFFgQfAWcfAmhkZGQPZBAWAWYWARQrAAEWAh8EZmRkZGQCBw8UKwAGDxYGHwACgQEeB0VuYWJsZWRnHwNnZGRkPCsADAELFCsABRYEHwFnHwJoZGRkD2QQFgFmFgEUKwABFgIfBGZkZGRkAgkPFCsABg8WBh8AAnAfBWcfA2dkZGQ8KwAMAQsUKwAFFgQfAWcfAmhkZGQPZBAWAWYWARQrAAEWAh8EZmRkZGQCCw88KwAGAQAPFgIfAAUBMmRkAg0PPCsABgEADxYCHwAFATNkZAIPDzwrAAYBAA8WAh8ABQE0ZGQCEQ88KwAGAQAPFgIfAAUBNWRkAhMPPCsABAEADxYCHwAFENCj0L/QsNC60L7QstC60LBkZAIVDzwrAAYBAA8WAh8ABQE2ZGQCFw8UKwAGDxYEHwACAx4HVmlzaWJsZWdkZGQ8KwAMAQs8KwAFAQAWBB8BaB8CaGRkZAIdDzwrAAQBAA8WAh8AZWRkAh8PPCsAEQIADxYCHwZoZAEQFgAWABYAZAIhDzwrABECAA8WBh4LXyFEYXRhQm91bmRnHgtfIUl0ZW1Db3VudAIBHwZnZAEQFgAWABYAFgJmD2QWBmYPDxYCHwZoZGQCAQ9kFgJmD2QWAmYPFQYBNQY4NjUsNTQBMAExASAAZAICDw8WAh8GaGRkAicPZBYEAgEPFCsABg8WAh8AZGRkZDwrAAwBCzwrAAUBABYEHwFoHwJoZGRkAgMPPCsABgEADxYCHwBlZGQYAwUeX19Db250cm9sc1JlcXVpcmVQb3N0QmFja0tleV9fFgsFE2N0bDAwJGNiUHJvZHVjdCREREQFD2N0bDAwJGJ0blBvcExvZwUnY3RsMDAkQ29udGVudFBsYWNlSG9sZGVyMSRjYlByb2R1Y3QkREREBStjdGwwMCRDb250ZW50UGxhY2VIb2xkZXIxJGNiQ291bnRyeUZyb20kREREBSljdGwwMCRDb250ZW50UGxhY2VIb2xkZXIxJGNiQ291bnRyeVRvJERERAUoY3RsMDAkQ29udGVudFBsYWNlSG9sZGVyMSRjYkNpdHlGcm9tJERERAUmY3RsMDAkQ29udGVudFBsYWNlSG9sZGVyMSRjYkNpdHlUbyREREQFJ2N0bDAwJENvbnRlbnRQbGFjZUhvbGRlcjEkY2JQYWNrYWdlJERERAUhY3RsMDAkQ29udGVudFBsYWNlSG9sZGVyMSRidG5DYWxjBT5jdGwwMCRDb250ZW50UGxhY2VIb2xkZXIxJERlbGl2ZXJ5QmxvY2sxJGNiRGVsaXZlcnlQcm9kdWN0JERERAUxY3RsMDAkQ29udGVudFBsYWNlSG9sZGVyMSREZWxpdmVyeUJsb2NrMSRidG5DaGVjawUgY3RsMDAkQ29udGVudFBsYWNlSG9sZGVyMSRndkNhbGMPPCsADAEIAgFkBSVjdGwwMCRDb250ZW50UGxhY2VIb2xkZXIxJGd2SW50ZXJDYWxjD2dkFh6Y+zDwlqiIMrx2hY5tcQFPxpV+UNBkbHyn/3c5v8Y=',
    '__PREVIOUSPAGE': 'hCxYm-G9wVgyGd20xHlN6VXwFT2FrZVhPJS_VVAYRXyQgKWMMwOsyIoUIXAXxYk7g2GEorycbv2NefEofDy4gP8c0QjPQhg5vz3uNWE8LDc1',
    '__EVENTVALIDATION': '/wEWCQK1hP/TDQKWuLyyBwK8v5SrAQLB+unSCAKiqbXjAwLY7f3FDwKq463PDQKJkoqaCQKg4cr0BnJt11zNMmacm8EPW8HgG2a2CzLbHNILBS6yCOh73hof',
    'tbPopLog_Raw': '',
    'ctl00$tbPopLog': 'Логин',
    'tbPopPwd_Raw': '',
    'ctl00$tbPopPwd': 'Пароль',
    'cbProduct_VI': 'Выберите продукт',
    'ctl00$cbProduct': 'Выберите продукт',
    'cbProduct_DDDWS': '0:0:-1:-10000:-10000:0:0:0:1:0:0:0',
    'cbProduct_DDD_LDeletedItems': '',
    'cbProduct_DDD_LInsertedItems': '',
    'cbProduct_DDD_LCustomCallback': '',
    'ctl00$cbProduct$DDD$L': '',
    'ctl00$chbRemember': 'U',
    'ContentPlaceHolder1_cbProduct_VI': '1',
    'ctl00$ContentPlaceHolder1$cbProduct': 'Экспресс-доставка',
    'ContentPlaceHolder1_cbProduct_DDDWS': '0:0:-1:-10000:-10000:0:0:0:1:0:0:0',
    'ContentPlaceHolder1_cbProduct_DDD_LDeletedItems': '',
    'ContentPlaceHolder1_cbProduct_DDD_LInsertedItems': '',
    'ContentPlaceHolder1_cbProduct_DDD_LCustomCallback': '',
    'ctl00$ContentPlaceHolder1$cbProduct$DDD$L': '1',
    'ContentPlaceHolder1_cbCountryFrom_VI': '0',
    'ctl00$ContentPlaceHolder1$cbCountryFrom': 'Россия',
    'ContentPlaceHolder1_cbCountryFrom_DDDWS': '0:0:-1:-10000:-10000:0:0:0:1:0:0:0',
    'ContentPlaceHolder1_cbCountryFrom_DDD_LDeletedItems': '',
    'ContentPlaceHolder1_cbCountryFrom_DDD_LInsertedItems': '',
    'ContentPlaceHolder1_cbCountryFrom_DDD_LCustomCallback': '',
    'ctl00$ContentPlaceHolder1$cbCountryFrom$DDD$L': '0',
    'ContentPlaceHolder1_cbCountryTo_VI': '0',
    'ctl00$ContentPlaceHolder1$cbCountryTo': 'Россия',
    'ContentPlaceHolder1_cbCountryTo_DDDWS': '0:0:-1:-10000:-10000:0:0:0:1:0:0:0',
    'ContentPlaceHolder1_cbCountryTo_DDD_LDeletedItems': '',
    'ContentPlaceHolder1_cbCountryTo_DDD_LInsertedItems': '',
    'ContentPlaceHolder1_cbCountryTo_DDD_LCustomCallback': '',
    'ctl00$ContentPlaceHolder1$cbCountryTo$DDD$L': '0',
    'ContentPlaceHolder1_cbCityFrom_VI': '129',
    'ctl00$ContentPlaceHolder1$cbCityFrom': 'Москва',
    'ContentPlaceHolder1_cbCityFrom_DDDWS': '0:0:-1:-10000:-10000:0:0:0:1:0:0:0',
    'ContentPlaceHolder1_cbCityFrom_DDD_LDeletedItems': '',
    'ContentPlaceHolder1_cbCityFrom_DDD_LInsertedItems': '',
    'ContentPlaceHolder1_cbCityFrom_DDD_LCustomCallback': '',
    'ctl00$ContentPlaceHolder1$cbCityFrom$DDD$L': '129',
    'ContentPlaceHolder1_cbCityTo_VI': '112',
    'ctl00$ContentPlaceHolder1$cbCityTo': 'Санкт-Петербург',
    'ContentPlaceHolder1_cbCityTo_DDDWS': '0:0:-1:-10000:-10000:0:0:0:1:0:0:0',
    'ContentPlaceHolder1_cbCityTo_DDD_LDeletedItems': '',
    'ContentPlaceHolder1_cbCityTo_DDD_LInsertedItems': '',
    'ContentPlaceHolder1_cbCityTo_DDD_LCustomCallback': '',
    'ctl00$ContentPlaceHolder1$cbCityTo$DDD$L': '112',
    'ContentPlaceHolder1_tbLength_Raw': '2',
    'ctl00$ContentPlaceHolder1$tbLength': '2',
    'ContentPlaceHolder1_tbWidth_Raw': '3',
    'ctl00$ContentPlaceHolder1$tbWidth': '3',
    'ContentPlaceHolder1_tbHeight_Raw': '4',
    'ctl00$ContentPlaceHolder1$tbHeight': '4',
    'ContentPlaceHolder1_tbCalcWeight_Raw': '5',
    'ctl00$ContentPlaceHolder1$tbCalcWeight': '5',
    'ContentPlaceHolder1_tbCost_Raw': '6',
    'ctl00$ContentPlaceHolder1$tbCost': '6',
    'ContentPlaceHolder1_cbPackage_VI': '3',
    'ctl00$ContentPlaceHolder1$cbPackage': 'Другая упаковка',
    'ContentPlaceHolder1_cbPackage_DDDWS': '0:0:-1:-10000:-10000:0:0:0:1:0:0:0',
    'ContentPlaceHolder1_cbPackage_DDD_LDeletedItems': '',
    'ContentPlaceHolder1_cbPackage_DDD_LInsertedItems': '',
    'ContentPlaceHolder1_cbPackage_DDD_LCustomCallback': '',
    'ctl00$ContentPlaceHolder1$cbPackage$DDD$L': '3',
    'ctl00$ContentPlaceHolder1$btnCalc': 'submit',
    'ContentPlaceHolder1_DeliveryBlock1_cbDeliveryProduct_VI': '',
    'ctl00$ContentPlaceHolder1$DeliveryBlock1$cbDeliveryProduct': 'Выберите продукт',
    'ContentPlaceHolder1_DeliveryBlock1_cbDeliveryProduct_DDDWS': '0:0:-1:-10000:-10000:0:0:0:1:0:0:0',
    'ContentPlaceHolder1_DeliveryBlock1_cbDeliveryProduct_DDD_LDeletedItems': '',
    'ContentPlaceHolder1_DeliveryBlock1_cbDeliveryProduct_DDD_LInsertedItems': '',
    'ContentPlaceHolder1_DeliveryBlock1_cbDeliveryProduct_DDD_LCustomCallback': '',
    'ctl00$ContentPlaceHolder1$DeliveryBlock1$cbDeliveryProduct$DDD$L': '',
    'ContentPlaceHolder1_DeliveryBlock1_InvoiceNumber_Raw': '',
    'ctl00$ContentPlaceHolder1$DeliveryBlock1$InvoiceNumber': 'Введите номер накладной',
    'DXScript': '1_187,1_101,1_130,1_137,1_180,1_105,1_141,1_129,1_98,1_172,1_170,1_132,1_124,1_121',
    'DXCss': '1_7,1_16,1_8,1_6,1_14,1_1,styles.css',
}

headers = {"Accept":"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
"Accept-Encoding":"gzip,deflate,sdch",
"Accept-Language":"en-US,en;q=0.8",
"Content-Type":"application/x-www-form-urlencoded",
}

r = requests.post(url, data=payload, headers=headers)

import lxml.html

print(r.text)
r = lxml.html.fromstring(r.text)
r = r.xpath("//span")
cost = float(r[10].text.replace(",",".")) + float(r[12].text.replace(",","."))
print(json.dumps({ "price": str(cost),
    "time": r[14].text.replace(' ', ''),
    "condition": None,
    }))
#for x in r:
#    print(x.text)


#print(r)
#print(r.text)
