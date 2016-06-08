<?php
    require_once("database.php"); 
#    $_POST["q"] = "Кра";
    $db = new MySql("localhost", "ps", "psmysql01", "world_cities");
    $db->connect();
    $q = $_GET["q"];
    $q = $db->e($q);
#    $arr = array(
#    array("id" => "1",
#          "text" => $q."123"));
    $arr = array();
    $cities = $db->fetch_all("SELECT DISTINCT ci.name as city_name, ci.city_id, reg.name as region_name
                    FROM `city` as ci
                    JOIN `region` as reg on (reg.region_id = ci.region_id)
                    WHERE ci.country_id=3159 AND ci.name LIKE '".$q."%'");
    
    $names = [];
    $twice = [];
    foreach ($cities as $city) {
        $name = $city->city_name;        
        if (in_array($name, $names)) {
            if (!in_array($name, $twice)) {
                $twice[] = $name;
            }
        } else {
            $names[] = $name;
        }
    }
    foreach ($cities as $city) {
    
        $name = $city->city_name;
        if (in_array($name, $twice)) {
            $name .= ', '.$city->region_name;
        } 
        array_push($arr, array("id" => $city->city_id, "text" => $name));
    }
#        print_r($city->name);
    echo json_encode($arr);
?>
