<?php
    require_once("scripts/database.php");
    require_once("user.php");
    $db = new MySql("localhost", "ps", "psmysql01", "agregator");
    $db->connect();
    
    $user = new User();
?>
    

<!-- HEADER BEGINS -->   

    <div class="header_light">
        <div class="col-xs-6 col-sm-9 col-md-9 col-lg-9">
            <img src="img/design_new/logo-corp-blue1.png" width="150px;" class="img-responsive" />
        </div>
        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
            <div class="auth">
                <a href="#">Вход в личный кабинет</a>
            </div>
        </div>
    </div>
<!-- HEADER ENDS -->

	
