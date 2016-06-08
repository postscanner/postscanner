<?php
require_once("database.php");

$db = new MySql("localhost", "ps", "psmysql01", "agregator");
$db->connect();

$url = 'http://dpd.ru/ols/calc/calc.do2';

//$cities = file_get_contents("dpd/list");
//$cities_a = json_decode($cities, True)["geonames"];
//$ind = Array();
//for ($i = 0; $i < count($cities_a); $i++) {
//    $one = $cities_a[$i];
//    var_dump($one);
//    print_r($one["name"].$one["id"]);
//    $db->query("INSERT INTO dpd SET id=".$one['id'].", name='".$one['name']."'");
//    $ind[$one["name"]] = $one["id"];
//}
function get_city_id($name) {
    global $db;
    return $db->fetch_field("SELECT id FROM dpd WHERE name='".$name."'");
}

//echo "Original city:";
//$originalCity = substr(fgets(STDIN), 0, -1);
$originalCity = $argv[1];

//echo "Deliviry city:";
//$deliviryCity = substr(fgets(STDIN), 0, -1);
$deliviryCity = $argv[2];

//echo "Weight";
//$weight = substr(fgets(STDIN), 0, -1);
$weight = $argv[3];
$volume = $argv[4];
$value = $argv[5];

//$origId = $ind[$originalCity];
//$deliId = $ind[$deliviryCity];
$origId = get_city_id($originalCity);
$deliId = get_city_id($deliviryCity);

$fields_string = "method%3Acalc=&direction=&form.cityPickupId=".$origId."&form.cityDeliveryId=".$deliId."&form.cityPickupType=0&form.cityDeliveryType=0&form.weightStr=".$weight."&form.volumeStr=".$volume."&form.declaredCostStr=".$value."&sendDateStr=&form.maxDays=&form.maxCostStr=";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

//execute post
$result = curl_exec($ch);
 
//print_r($result);

require_once("simple_html_dom.php");

$html = str_get_html($result);

$i = 0;
$len = count($html->find('input[id=cost]'));


$time = $html->find('input[id=days]');
$conditions = $html->find('#calc_result_table > tbody:nth-child(1) > tr:nth-child(1) > td:nth-child(1) > table:nth-child(1) > tbody:nth-child(1) > tr > td > a');
foreach($html->find('input[id=cost]') as $element) {
    if ($i == $len - 1)
        break;
    // echo $element->value .' '.$time[$i]->value. PHP_EOL;
    // echo json_encode(array("1" => 2));
    echo json_encode(array("price" => $element->value, "time" => $time[$i]->value, "condition" => trim($conditions[$i]->innertext))). PHP_EOL;
    ++$i;
}
?>
