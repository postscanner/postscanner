<?php
    $cities = file_get_contents("list");
    $cities_a = json_decode($cities, True)["geonames"];
    print_r(count($cities_a));
?>
