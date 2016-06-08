<?php
    require_once("scripts/database.php");
    require_once("user.php");
    $db = new MySql("localhost", "ps", "psmysql01", "agregator");
    $db->connect();
    
    $user = new User();
?>
    <link href="/css/custom.css" rel="stylesheet" type="text/css"/>
    <!-- BEGIN TOP BAR -->
    <div class="pre-header">
        <div class="container">
            <div class="row">
                <!-- BEGIN TOP BAR LEFT PART -->
                <div class="col-md-6 col-sm-6 additional-shop-info">
                    <ul class="list-unstyled list-inline">
                        <li><i class="fa fa-envelope-o"></i><span>info@postscanner.ru</span></li>
                    </ul>
                </div>
                <!-- END TOP BAR LEFT PART -->
                <!-- BEGIN TOP BAR MENU -->
                <div class="col-md-6 col-sm-6 additional-nav">
                    <ul class="list-unstyled list-inline pull-right">
                    
                    <?php if ($user->isLogged()) {?>
                        <li><a href="#" class="" title="Логин"><?php echo $user->getUserEmail() ?></a></li>
                        
                        <li>
                            <a href="#" id="logout" class="" title="Выход">Выход</a>
                        </li>
                        
                    <?php } else {?>
                        <li><a href="/login/" class="" title="Логин">Вход</a></li>
                        <li><a href="/login/">Регистрация</a></li>
                    <?php } ?>
                    </ul>
                </div>
                <!-- END TOP BAR MENU -->
            </div>
        </div>        
    </div>
    <!-- END TOP BAR -->
    <!-- BEGIN HEADER -->
    <div class="header">
      <div class="container">
        <a class="site-logo" href="/"><img src="../../assets/frontend/layout/img/logos/logo-corp-blue1.png" alt="Postscanner"></a>

        <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>

        <!-- BEGIN NAVIGATION -->
        <div class="header-navigation pull-right font-transform-inherit">
          <ul>
          <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="" data-target="#" href="/o_kompanii/">
                О компании
                
              </a>
                
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="" data-target="#" href="/">
                Поиск
                
              </a>
                
            </li>
            
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="" data-target="#" href="/tracking/">
                Отслеживание посылок 
                
              </a>
                
            </li>

            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="" data-target="#" href="/uslugi_dostavki/">
                Полезные советы 
                
              </a>
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="" data-target="#" href="/novosti/">
                Новости 
                
              </a>
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="" data-target="#" href="/contacts/">
                Контакты                
              </a>
            </li>
            
          </ul>
        </div>
        <!-- END NAVIGATION -->
      </div>
    </div>
    <!-- Header END -->

	
