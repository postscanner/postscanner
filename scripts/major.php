<?php

$url = 'http://www.me-online.ru/calculator.aspx';
/*
$cities = file_get_contents("list");
$cities_a = json_decode($cities, True)["geonames"];
$ind = Array();
for ($i = 0; $i < count($cities_a); $i++) {
    $one = $cities_a[$i];
//    var_dump($one);
    $ind[$one["name"]] = $one["id"];
}

echo "Original city:";
$originalCity = substr(fgets(STDIN), 0, -1);

echo "Deliviry city:";
$deliviryCity = substr(fgets(STDIN), 0, -1);

$origId = $ind[$originalCity];
$deliId = $ind[$deliviryCity];
*/
$fields_string = "__EVENTTARGET=&__EVENTARGUMENT=&__VIEWSTATE=%2FwEPDwULLTE1ODI3OTgwMTgPZBYCZg9kFgICAw9kFgoCAw88KwAFAQAPFgIeBVZhbHVlZWRkAgUPPCsABQEADxYCHwBlZGQCBw8UKwAFDxYCHwAFH9CS0YvQsdC10YDQuNGC0LUg0L%2FRgNC%2B0LTRg9C60YJkZGQ8KwAJAQg8KwAEAQAWBB4SRW5hYmxlQ2FsbGJhY2tNb2RlaB4nRW5hYmxlU3luY2hyb25pemF0aW9uT25QZXJmb3JtQ2FsbGJhY2sgaGRkAgkPPCsABAEADxYCHwBoZGQCDQ9kFiACAQ8UKwAFDxYCHwACAWRkZDwrAAkBCDwrAAQBABYEHwFoHwJoZGQCAw8UKwAFDxYEHwBmHg9EYXRhU291cmNlQm91bmRnZGRkPCsACQEIFCsABBYEHwFnHwJoZGQPZBAWAWYWARQrAAEWAh4PQ29sVmlzaWJsZUluZGV4ZmRkZAIFDxQrAAUPFgQfAGYfA2dkZGQ8KwAJAQgUKwAEFgQfAWcfAmhkZA9kEBYBZhYBFCsAARYCHwRmZGRkAgcPFCsABQ8WBh8AAoEBHgdFbmFibGVkZx8DZ2RkZDwrAAkBCBQrAAQWBB8BZx8CaGRkD2QQFgFmFgEUKwABFgIfBGZkZGQCCQ8UKwAFDxYGHwACVh8FZx8DZ2RkZDwrAAkBCBQrAAQWBB8BZx8CaGRkD2QQFgFmFgEUKwABFgIfBGZkZGQCCw88KwAFAQAPFgIfAAUCMTBkZAINDzwrAAQBAA8WAh8ABRDQo9C%2F0LDQutC%2B0LLQutCwZGQCDw88KwAFAQAPFgIfAAUCMTBkZAIRDxQrAAUPFgQfAAIDHgdWaXNpYmxlZ2RkZDwrAAkBCDwrAAQBABYEHwFoHwJoZGQCEw8UKwAFDxYEHwACAR8GaGRkZDwrAAkBCDwrAAQBABYEHwFoHwJoZGQCFw88KwAEAQAPFgIfAGVkZAIZDzwrABECAA8WAh8GaGQBEBYAFgAWAGQCGw88KwARAgAPFgYeC18hRGF0YUJvdW5kZx4LXyFJdGVtQ291bnQCAR8GZ2QBEBYAFgAWABYCZg9kFgZmDw8WAh8GaGRkAgEPZBYCZg9kFgJmDxUFBzIyMzAsODIBMAExASAAZAICDw8WAh8GaGRkAh0PFgIfBmdkAh8PFgIfBmhkAiEPZBYEAgEPFCsABQ8WAh8AZGRkZDwrAAkBCDwrAAQBABYEHwFoHwJoZGQCAw88KwAFAQAPFgIfAGVkZBgDBR5fX0NvbnRyb2xzUmVxdWlyZVBvc3RCYWNrS2V5X18WCwUTY3RsMDAkY2JQcm9kdWN0JERERAUPY3RsMDAkYnRuUG9wTG9nBSdjdGwwMCRDb250ZW50UGxhY2VIb2xkZXIxJGNiUHJvZHVjdCREREQFK2N0bDAwJENvbnRlbnRQbGFjZUhvbGRlcjEkY2JDb3VudHJ5RnJvbSREREQFKWN0bDAwJENvbnRlbnRQbGFjZUhvbGRlcjEkY2JDb3VudHJ5VG8kREREBShjdGwwMCRDb250ZW50UGxhY2VIb2xkZXIxJGNiQ2l0eUZyb20kREREBSZjdGwwMCRDb250ZW50UGxhY2VIb2xkZXIxJGNiQ2l0eVRvJERERAUnY3RsMDAkQ29udGVudFBsYWNlSG9sZGVyMSRjYlBhY2thZ2UkREREBSFjdGwwMCRDb250ZW50UGxhY2VIb2xkZXIxJGJ0bkNhbGMFPmN0bDAwJENvbnRlbnRQbGFjZUhvbGRlcjEkRGVsaXZlcnlCbG9jazEkY2JEZWxpdmVyeVByb2R1Y3QkREREBTFjdGwwMCRDb250ZW50UGxhY2VIb2xkZXIxJERlbGl2ZXJ5QmxvY2sxJGJ0bkNoZWNrBSBjdGwwMCRDb250ZW50UGxhY2VIb2xkZXIxJGd2Q2FsYw88KwAMAQgCAWQFJWN0bDAwJENvbnRlbnRQbGFjZUhvbGRlcjEkZ3ZJbnRlckNhbGMPZ2TPOa5l7a5o8ARlMAt89arA35w6IHqNrbK%2FMYXwKR5CnA%3D%3D&__PREVIOUSPAGE=hCxYm-G9wVgyGd20xHlN6VXwFT2FrZVhPJS_VVAYRXyQgKWMMwOsyIoUIXAXxYk7g2GEorycbv2NefEofDy4gP8c0QjPQhg5vz3uNWE8LDc1&__EVENTVALIDATION=%2FwEWCQLo0vToCQKWuLyyBwK8v5SrAQLB%2BunSCAKiqbXjAwLY7f3FDwKq463PDQKJkoqaCQKg4cr0BnLGwjebsUgPaiTdZoCqlLHOuLufYzKcQZOFQmEAzCTf&tbPopLog_Raw=&ctl00%24tbPopLog=%D0%9B%D0%BE%D0%B3%D0%B8%D0%BD&tbPopPwd_Raw=&ctl00%24tbPopPwd=%D0%9F%D0%B0%D1%80%D0%BE%D0%BB%D1%8C&cbProduct_VI=%D0%92%D1%8B%D0%B1%D0%B5%D1%80%D0%B8%D1%82%D0%B5+%D0%BF%D1%80%D0%BE%D0%B4%D1%83%D0%BA%D1%82&ctl00%24cbProduct=%D0%92%D1%8B%D0%B1%D0%B5%D1%80%D0%B8%D1%82%D0%B5+%D0%BF%D1%80%D0%BE%D0%B4%D1%83%D0%BA%D1%82&cbProduct_DDDWS=0%3A0%3A-1%3A-10000%3A-10000%3A0%3A-10000%3A-10000%3A1&cbProduct_DDD_LDeletedItems=&cbProduct_DDD_LInsertedItems=&cbProduct_DDD_LCustomCallback=&ctl00%24cbProduct%24DDD%24L=&ctl00%24chbRemember=U&ContentPlaceHolder1_cbProduct_VI=1&ctl00%24ContentPlaceHolder1%24cbProduct=%D0%AD%D0%BA%D1%81%D0%BF%D1%80%D0%B5%D1%81%D1%81-%D0%B4%D0%BE%D1%81%D1%82%D0%B0%D0%B2%D0%BA%D0%B0&ContentPlaceHolder1_cbProduct_DDDWS=0%3A0%3A-1%3A-10000%3A-10000%3A0%3A-10000%3A-10000%3A1&ContentPlaceHolder1_cbProduct_DDD_LDeletedItems=&ContentPlaceHolder1_cbProduct_DDD_LInsertedItems=&ContentPlaceHolder1_cbProduct_DDD_LCustomCallback=&ctl00%24ContentPlaceHolder1%24cbProduct%24DDD%24L=1&ContentPlaceHolder1_cbCountryFrom_VI=0&ctl00%24ContentPlaceHolder1%24cbCountryFrom=%D0%A0%D0%BE%D1%81%D1%81%D0%B8%D1%8F&ContentPlaceHolder1_cbCountryFrom_DDDWS=0%3A0%3A-1%3A-10000%3A-10000%3A0%3A-10000%3A-10000%3A1&ContentPlaceHolder1_cbCountryFrom_DDD_LDeletedItems=&ContentPlaceHolder1_cbCountryFrom_DDD_LInsertedItems=&ContentPlaceHolder1_cbCountryFrom_DDD_LCustomCallback=&ctl00%24ContentPlaceHolder1%24cbCountryFrom%24DDD%24L=0&ContentPlaceHolder1_cbCountryTo_VI=0&ctl00%24ContentPlaceHolder1%24cbCountryTo=%D0%A0%D0%BE%D1%81%D1%81%D0%B8%D1%8F&ContentPlaceHolder1_cbCountryTo_DDDWS=0%3A0%3A-1%3A-10000%3A-10000%3A0%3A-10000%3A-10000%3A1&ContentPlaceHolder1_cbCountryTo_DDD_LDeletedItems=&ContentPlaceHolder1_cbCountryTo_DDD_LInsertedItems=&ContentPlaceHolder1_cbCountryTo_DDD_LCustomCallback=&ctl00%24ContentPlaceHolder1%24cbCountryTo%24DDD%24L=0&ContentPlaceHolder1_cbCityFrom_VI=129&ctl00%24ContentPlaceHolder1%24cbCityFrom=Краснодар&ContentPlaceHolder1_cbCityFrom_DDDWS=0%3A0%3A-1%3A-10000%3A-10000%3A0%3A-10000%3A-10000%3A1&ContentPlaceHolder1_cbCityFrom_DDD_LDeletedItems=&ContentPlaceHolder1_cbCityFrom_DDD_LInsertedItems=&ContentPlaceHolder1_cbCityFrom_DDD_LCustomCallback=&ctl00%24ContentPlaceHolder1%24cbCityFrom%24DDD%24L=129&ContentPlaceHolder1_cbCityTo_VI=86&ctl00%24ContentPlaceHolder1%24cbCityTo=%D0%9A%D0%B0%D0%B7%D0%B0%D0%BD%D1%8C&ContentPlaceHolder1_cbCityTo_DDDWS=0%3A0%3A-1%3A-10000%3A-10000%3A0%3A-10000%3A-10000%3A1&ContentPlaceHolder1_cbCityTo_DDD_LDeletedItems=&ContentPlaceHolder1_cbCityTo_DDD_LInsertedItems=&ContentPlaceHolder1_cbCityTo_DDD_LCustomCallback=&ctl00%24ContentPlaceHolder1%24cbCityTo%24DDD%24L=86&ContentPlaceHolder1_tbCalcWeight_Raw=10&ctl00%24ContentPlaceHolder1%24tbCalcWeight=10&ContentPlaceHolder1_tbCost_Raw=10&ctl00%24ContentPlaceHolder1%24tbCost=10&ContentPlaceHolder1_cbPackage_VI=3&ctl00%24ContentPlaceHolder1%24cbPackage=%D0%94%D1%80%D1%83%D0%B3%D0%B0%D1%8F+%D1%83%D0%BF%D0%B0%D0%BA%D0%BE%D0%B2%D0%BA%D0%B0&ContentPlaceHolder1_cbPackage_DDDWS=0%3A0%3A-1%3A-10000%3A-10000%3A0%3A-10000%3A-10000%3A1&ContentPlaceHolder1_cbPackage_DDD_LDeletedItems=&ContentPlaceHolder1_cbPackage_DDD_LInsertedItems=&ContentPlaceHolder1_cbPackage_DDD_LCustomCallback=&ctl00%24ContentPlaceHolder1%24cbPackage%24DDD%24L=3&ctl00%24ContentPlaceHolder1%24btnCalc=&ContentPlaceHolder1_DeliveryBlock1_cbDeliveryProduct_VI=&ctl00%24ContentPlaceHolder1%24DeliveryBlock1%24cbDeliveryProduct=%D0%92%D1%8B%D0%B1%D0%B5%D1%80%D0%B8%D1%82%D0%B5+%D0%BF%D1%80%D0%BE%D0%B4%D1%83%D0%BA%D1%82&ContentPlaceHolder1_DeliveryBlock1_cbDeliveryProduct_DDDWS=0%3A0%3A-1%3A-10000%3A-10000%3A0%3A-10000%3A-10000%3A1&ContentPlaceHolder1_DeliveryBlock1_cbDeliveryProduct_DDD_LDeletedItems=&ContentPlaceHolder1_DeliveryBlock1_cbDeliveryProduct_DDD_LInsertedItems=&ContentPlaceHolder1_DeliveryBlock1_cbDeliveryProduct_DDD_LCustomCallback=&ctl00%24ContentPlaceHolder1%24DeliveryBlock1%24cbDeliveryProduct%24DDD%24L=&ContentPlaceHolder1_DeliveryBlock1_InvoiceNumber_Raw=&ctl00%24ContentPlaceHolder1%24DeliveryBlock1%24InvoiceNumber=%D0%92%D0%B2%D0%B5%D0%B4%D0%B8%D1%82%D0%B5+%D0%BD%D0%BE%D0%BC%D0%B5%D1%80+%D0%BD%D0%B0%D0%BA%D0%BB%D0%B0%D0%B4%D0%BD%D0%BE%D0%B9&DXScript=1_42%2C2_34%2C2_41%2C1_75%2C2_33%2C1_68%2C1_65%2C2_36%2C2_30%2C2_27%2C1_46%2C1_54";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

//execute post
$result = curl_exec($ch);

print_r($result);
/*
require_once("simple_html_dom.php");

$html = str_get_html($result);

echo "dpd.com".PHP_EOL;

foreach($html->find('input[id=cost]') as $element) 
    echo $element->value . PHP_EOL;
*/

?>
