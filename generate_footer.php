<?php 
    require_once("scripts/database.php");
    $db = new MySql("localhost", "ps", "psmysql01", "agregator");
    $db->connect();
    $names = $db->fetch_all("SELECT name, calc_url from agregators");
    foreach ($names as $name) {
        print_r('<div class="client-item">
                <a href="'.$name->calc_url.'">
                  <img src="./img/logo/gray/'.$name->name.'.png" class="img-responsive" alt="">
                  <img src="./img/logo/'.$name->name.'.png" class="color-img img-responsive" alt="">
                </a>
              </div>');
    }
?>