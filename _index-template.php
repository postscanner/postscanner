<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Head BEGIN -->
<head>
  <meta charset="utf-8">
  <title>Поиск дешевой доставки | Агрегатор экспресс-доставки Postscanner | почтовые отправления </title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <meta content="Найди лучшие условия доставки посылки вместе с Postscanner!" name="description">
  <meta content="Metronic Shop UI keywords" name="keywords">
  <meta content="keenthemes" name="author">

  <meta property="og:site_name" content="-CUSTOMER VALUE-">
  <meta property="og:title" content="-CUSTOMER VALUE-">
  <meta property="og:description" content="-CUSTOMER VALUE-">
  <meta property="og:type" content="website">
  <meta property="og:image" content="-CUSTOMER VALUE-"><!-- link to image for socio -->
  <meta property="og:url" content="-CUSTOMER VALUE-">

  <link rel="shortcut icon" href="favicon.ico">

  <!-- Fonts START -->
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans+Narrow|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css">
  <!-- Fonts END -->

  <!-- Global styles START -->          
  <link href="./assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="./assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="./assets/global/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
  <!-- Global styles END --> 
   
  <!-- Page level plugin styles START -->
  <link href="./assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
  <link href="./assets/global/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.css" rel="stylesheet">

  <!-- Page level plugin styles END -->

  <!-- Theme styles START -->
  <link href="./assets/global/css/components.css" rel="stylesheet">
  <link href="./assets/frontend/layout/css/style.css" rel="stylesheet"><!-- metronic revo slider styles -->
  <link href="./assets/frontend/layout/css/style-responsive.css" rel="stylesheet">
  <link href="./assets/frontend/layout/css/themes/blue.css" rel="stylesheet" id="style-color">
  <link href="./assets/frontend/layout/css/custom.css" rel="stylesheet">
  <link href="./css/loading.css" rel="stylesheet">
  <link href="./css/progress_bar.css" rel="stylesheet">
  <link href="./assets/admin/pages/scripts/form-validation.js" rel="stylesheet">

  <!-- Theme styles END -->

    <link href="select2/select2.css" rel="stylesheet"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>


<!-- BEGIN PAGE LEVEL STYLES -->
<!--<link rel="stylesheet" type="text/css" href="./assets/global/plugins/select2/select2.css"/>-->
<link rel="stylesheet" type="text/css" href="./assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
<link rel="stylesheet" type="text/css" href="./assets/global/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css"/>
<link rel="stylesheet" type="text/css" href="./assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="./css/revo-slider-custom.css"/>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/jquery-notific8/jquery.notific8.min.css"/>
<!-- END PAGE LEVEL STYLES -->

<link href="./assets/global/css/components.css" rel="stylesheet" type="text/css"/>
<link href="./assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>







</head>
<!-- Head END -->

<!-- Body BEGIN -->
<body class="corporate">
    <!-- <div id="loading" style="display: none">
        <div class="page-spinner-bar" ng-spinner-bar="">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
        <div style="height: 100%; width: 100%; z-index: 2000; display: block; position: fixed; background: url(http://www.vacansoleil.it/static/images/newvcloader.gif) no-repeat 50% 50%;"></div> 
        <div class="blackout" style="height: 100%; width: 100%; z-index: 1000; display: block; position: fixed; background: rgb(0,0,0); opacity: 0.5;">
        </div>
    </div>
    -->
    
    <?php require('header.php'); ?>
    <!-- BEGIN SLIDER -->
    <style>
        .filter-wrapper
        {
            background: url("./img/bg.jpg");
            background-size:   cover;                      /* <------ */
            background-repeat: no-repeat;
            background-position: center center;
        }
        .fullwidthabnner
        {
            height:100%;
            max-width:1140px;
            margin-left:auto;
            margin-right:auto;
            width: 100%;  opacity: 1; visibility: inherit;
            
            padding-top:30px;
            padding-bottom:3%;
        }
        #dbg_test
        {
            margin-bottom:15px;
            color: #ffffff;
            font: 300 47px/66px "Open Sans",sans-serif;
            text-transform: uppercase;
        }
        .filter .subtitle
        {
            background: #3b99cf none repeat scroll 0 0;
            color: #fafafa;
            font: 400 22px/25px "Open Sans",sans-serif;
            padding: 3px 5px;
            padding-bottom:2px;
            text-transform: uppercase;
        }
        .filter .filter_text
        {
            max-width:460px;
            color: #ffffff;
            font-size: 18px;
            margin-top:13px;
            letter-spacing: 0;
            line-height: 25px;
        }
        .select2-container
        {
            margin-top:-5px;
            text-align:left;
            
            display:inline-block;
        }
        .main_filter_form
        {
            margin-top:17px;
            background: url("./img/background_transp.png");
            padding:10px;
            -moz-border-radius: 10px; /* закругление для старых Mozilla Firefox */
            -webkit-border-radius: 10px; /* закругление для старых Chrome и Safari */
            -khtml-border-radius:10px; /* закругл. для браузера Konquerer системы Linux */
            border-radius: 10px; /* закругление углов для всех, кто понимает */
        }
        .filter .white_link
        {
            color: white;
            text-decoration: underline !important;
            font-size:	18px;
            margin-right:10px;
            display:inline-block;
            margin-top:8px;
            margin-left:13px;
            margin-bottom:7px;
        }
        .filter .main_filter_form input
        {
            border: 1px solid #dbdbdb;
            border-radius: 0;
            box-shadow: none;
            color: #777;
            font: 14px Arial,sans-serif;
            padding: 6px 12px;
            height: 34px;
        }
        .filter .main_filter_form .filter_line
        {
            max-width:850px;
            margin-bottom:10px;
           
        }
         .filter .main_filter_form  div.filter_second_line 
        {
            max-width:955px;
            text-align: right;
        }
        .toCity, .fromCity {
            display: inline-block;
        }
        .preloader
        {
            background: url("/img/preloader.gif") repeat scroll 0 0;
            display: inline-block;
            height: 25px;
            width: 25px;
            margin-left:15px;
            margin-bottom:15px;
        }
    </style>
    <div class="page-slider margin-bottom-40 filter-wrapper">
     
        <div class="fullwidthabnner filter"  >
            <div id="dbg_test">
                Найди лучшие условия доставки!
            </div>
            <span class="subtitle">
                Агрегатор экспресс-доставки
            </span>
              <div class="filter_text">
                Сравни стоимость услуг различных служб доставки!
              
                Удобно, бесплатно и без регистрации.
              </div>
              
              <div class="main_filter_form">
                <div class="filter_first_line filter_line">
                    
                    <a style="margin-left:0px;" data-toggle="popover" data-trigger="focus" data-container="body"  data-placement="top" data-content='В поле "ОТКУДА" начните вводить название города отправления и выберите нужный из списка'  href="javascript:;" class="white_link" id="notific8_from" tabindex='-1'>Откуда:</a>
                    <div class="fromCity" id="fromCity" tabindex='0'></div>
                    
                    <a href="javascript:;" data-toggle="popover" data-trigger="focus" data-container="body"  data-placement="top" data-content='В поле "КУДА" начните вводить название города назначения и выберите нужный из списка'  id="notific8_to"  class="white_link" tabindex='-1'>Куда:</a>
                    <div class="toCity" id="toCity"></div>
                    
                    
                        <a href="javascript:;" data-toggle="popover" data-trigger="focus" data-container="body"  data-placement="top" data-content='В поле "ВЕС" введите ориентировочную массу посылки в килограммах'  id="notific8_weight"  class="white_link" tabindex='-1'>Вес:</a> 
                        <input type="text" class="" required placeholder="Килограммы" id="weight" name="Weight"/>
                   
                </div>
                
                <div class="filter_second_line filter_line">
                    
                    
                    <a href="javascript:;"  data-toggle="popover" data-trigger="focus" data-container="body"  data-placement="bottom" data-content='В полях "ДЛИНА", "ШИРИНА" и "ВЫСОТА" введите размеры посылки в сантиметрах'   id="notific8_size_1" class="white_link"  tabindex='-1'>Длина:</a> 
                    <input type="text" class="" placeholder="См" id="length" name="length"/>
                  
                    <a href="javascript:;"  data-toggle="popover" data-trigger="focus" data-container="body"  data-placement="bottom" data-content='В полях "ДЛИНА", "ШИРИНА" и "ВЫСОТА" введите размеры посылки в сантиметрах'   id="notific8_size_2" class="white_link"  tabindex='-1'>Ширина:</a> 
                    <input type="text" class="" placeholder="См" id="width" name="width"/>
                  
                    <a href="javascript:;"  data-toggle="popover" data-trigger="focus" data-container="body"  data-placement="bottom" data-content='В полях "ДЛИНА", "ШИРИНА" и "ВЫСОТА" введите размеры посылки в сантиметрах'   id="notific8_size_3"  class="white_link" tabindex='-1'>Высота:</a> 
                    <input type="text" class="" placeholder="См" id="height" name="height"/>
                  
                    <a href="javascript:;"   data-toggle="popover" data-trigger="focus" data-container="body"  data-placement="bottom" data-content='В поле "СТОИМОСТЬ" введите страховую стоимость посылки'  id="notific8_price"  class="white_link" tabindex='-1'>Стоимость:</a> 
                    <input type="text" class="" placeholder="Страховая стоимость, руб." id="value" name="value"/>
                    
                    <a data-trigger='manual'  data-content="Заполнены не все поля, либо заполнены некорректно"  data-original-title="Ошибка" style="  margin-left: 41px; " id="sendRequest" href="#" class="btn btn-primary"><font size="4" color="white"><i class="fa fa-envelope-o fa margin-right-10"></i>поиск</font></a>
                    
                </div>
				
              

            </div>           
            <div class="clear"></div>
               
          
        </div>
      
    </div>
    <!-- END SLIDER -->

    <div class="main">
      <div class="container">
        
        
     
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN CONTENT -->
            
            <div class="page-content">
                <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
                <div class="modal fade" id="portlet-config" tabindex=x="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title">Modal title</h4>
                            </div>
                            <div class="modal-body">
                                 Widget settings form goes here
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn blue">Save changes</button>
                                <button type="button" class="btn default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
                <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
                <!-- BEGIN PAGE CONTENT-->
                <div class="progress-bar_ blue stripes hidden">
                    <span style="width: 1%"></span>
                    <br />
                    <p style="color:grey;">Идет поиск...</p>
                </div> 
                <div class="row">
                    <style>
                        .zakazBtTh
                        {
                            width:100px;
                        }
                    </style>  
                    <!--<span class="preloader hidden" id="preloader"></span>-->
                    
                         
                    <div class="col-md-12" id="response"></div>
                    <div class="col-md-12 hidden" id="response-new">
                    
                        <div class='portlet box blue-madison'>
                            <div class='portlet-title'>
                            	<div class="caption">
                            		<i class="fa fa-envelope"></i>Отправление <span class="city-from"> <?php echo $fromCity ?></span> - <span class="city-to"><?php echo $toCity ?></span>.     Вес <span class="weight"><?php echo $weight ?> </span> кг
                            	</div>
                            </div>
                            <div class="portlet-body">
                            	
                                <table class="table-res table table-striped table-bordered table-hover" id="sample_4">
                                	<thead>
                                	<tr>
                                		<th>
                                		</th>
                                		<th>
                                			 Компания
                                		</th>
                                		<th>
                                			 Срок<span class="hidden-xs"> доставки</span>
                                		</th>
                                		<th>
                                			 Стоимость
                                		</th>
                                        	
                                		<th>
                                			 Условия доставки
                                		</th>
                                        <th>
                                			
                                		</th>						
                                	</tr>
                                	</thead>
                                	<tbody> 
                                    </tbody>
                                </table>
                            </div>
                        </div> 
                        <select class="comp_sel selectpicker hidden" data-style="company-list-button"  data-selected-text-format="none" id="compainsList" multiple="multiple">
                            <option selected="selected">Все</option>
                        </select>            
                        <!-- content receiving using search.php via ajax (see custom.js) -->
                    </div>
                </div>
                <!-- END PAGE CONTENT-->
            
        
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
            <!--Cooming Soon...-->
            <!-- END QUICK SIDEBAR -->
        </div>
        <!-- END CONTAINER -->
    </div>
       <!-- BEGIN BLOCKQUOTE BLOCK -->   
        <div class="row quote-v1 margin-bottom-30">
          <div class="col-md-9">
            <span>Postscanner - поиск по более чем 40 службам доставки</span>
          </div>
<!--          <div class="col-md-3 text-right">
            <a id="sendRequest" href="#" class="btn-transparent"><i class="fa fa-rocket margin-right-10"></i>Поиск</a>
          </div>
-->
<!--          <div class="col-md-3 text-right">
            <a id="sendRequest-1" href="#" class="btn-transparent"><i class="fa fa-search margin-right-10"></i>Трекинг посылки</a>
          </div>
 -->       </div>
    <!-- BEGIN SERVICE BOX -->   
        <div class="row service-box margin-bottom-40 hide-on-request-performed">
          <div class="col-md-4 col-sm-4">
            <div class="service-box-heading">
              <em><i class="fa fa-user"></i></em>
              <span>Пользователям</span>
            </div>
            <p>Postscanner поможет вам за несколько секунд найти наиболее оптимальный
вариант экспресс-доставки посылки по России, что позволит отправить
документы, груз или письмо и при этом существенно сэкономить.
Бесплатный поиск с Postscanner – это быстро, просто и удобно!</p>
          </div>
          <div class="col-md-4 col-sm-4">
            <div class="service-box-heading">
              <em><i class="fa fa-envelope"></i></em>
              <span>Почтовым операторам</span>
            </div>
            <p>Postscanner предоставляет возможность рассказать о новых сервисах,
направлениях почтовых отправлений и актуальных акциях по доставке
посылок. Делайте ваши лучшие предложения по экспресс-доставке посылок
на Postscanner и вместе мы поможем людям стать ближе.</p>
          </div>
          <div class="col-md-4 col-sm-4">
            <div class="service-box-heading">
              <em><i class="fa fa-laptop"></i></em>
              <span>Веб-сервисам</span>
            </div>
            <p>Виджет от Postscanner поможет предоставить вашим клиентам различные
условия экспресс-доставки по России. В результате доставка посылок
становится более выгодной, что позволяет клиентам сделать выбор в вашу
пользу.</p>
          </div>
        </div>
        <!-- END SERVICE BOX -->

        <!-- BEGIN RECENT WORKS -->
        <div class="row recent-work margin-bottom-40">
          <div class="col-md-3">
            <h2><a href="news.php">Новости сайта</a></h2>
            <p>Мы внимательно следим за самыми актуальными и интересными событиями в области экспресс-доставки и всегда рады рассказать о них вам.</p>
          </div>
		  
          <div class="col-md-9">
            <div class="owl-carousel owl-carousel3">

			<?php 
              foreach ($all_news as $news) {
                $link = 'news.php?id='.$news->id;
                $picture = '/img/news/'.$news->id;
                $usePicture = file_exists($_SERVER['DOCUMENT_ROOT'].$picture);
            ?>

              <div class="recent-work-item">
                <em>
                  <?php if ($usePicture) {?>
                  <img src="<?php echo $picture ?>" alt="Заголовок новости" align = "center" height="203" >
				  <?php }?>
                  <a href="<?php echo $link ?>" title="Читать полностью"><i class="fa fa-link"></i></a>
<!--                  <a href="./<?php echo $picture ?>" class="fancybox-button" title="Увеличить" data-rel="fancybox-button"><i class="fa fa-search"></i></a>
-->                </em>
                <a class="recent-work-description" href="<?php echo $link ?>">
                  <strong><?php echo $news->title ?></strong>
				</a>
              </div>
     		  <?php }?>
			  


			  </div>       
          </div>
        </div>   
        <!-- END RECENT WORKS -->
        

        <!-- BEGIN TABS AND TESTIMONIALS -->
        <div class="row mix-block margin-bottom-40 hide-on-request-performed">
          <!-- TABS -->
          <div class="col-md-7 tab-style-1">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab-1" data-toggle="tab">Как это работает</a></li>
              <li><a href="#tab-2" data-toggle="tab">Наши преимущества</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane row fade in active" id="tab-1">
                <div class="col-md-3 col-sm-3">
                    <img class="img-responsive" src="./assets/frontend/pages/img/photos/img7.jpg" alt="">
                    </img>
                </div>
                <div class="col-md-9 col-sm-9">
                  <p class="margin-bottom-10">Вы вносите основные параметры вашей посылки, а  Postscanner подбирает  все возможные варианты экспресс-доставки по России от более чем 40 ведущих служб экспресс-доставки. 
Используя результаты поиска вы можете выбрать лучшее предложение по соотношению цена/ качество / скорость доставки и заказать обратный звонок от службы экспресс-доставки, либо вызвать курьера.</p>
                </div>
              </div>
              <div class="tab-pane row fade" id="tab-2">
                <div class="col-md-9 col-sm-9">
                  <p>В большинстве случаев люди предпочитают обратиться либо в Почту России, либо в компанию с мировым именем. Однако практика показывает, что зачастую стоимость услуг даже среди мировых лидеров может отличаться в несколько раз, а услуги локальных служб экспресс-доставки ничем не хуже но обходятся значительно дешевле.Что бы подобрать оптимальный вариант экспресс-доставки по России необходимо потратить массу времени. Postscanner позволит решить эту проблему за несколько секунд. Поиск с Postscanner – это быстро, просто и бесплатно. </p>
                </div>
                <div class="col-md-3 col-sm-3">
                    <img class="img-responsive" src="./assets/frontend/pages/img/photos/img10.jpg" alt="">
                  <!-- <a href="assets/temp/photos/img10.jpg" class="fancybox-button" title="Image Title" data-rel="fancybox-button"> -->
                  </a>
                </div>
              </div>
              
            </div>
          </div>
          <!-- END TABS -->
        
          <!-- TESTIMONIALS -->
          <div class="col-md-5 testimonials-v1">
            <div id="myCarousel" class="carousel slide">
              <!-- Carousel items -->
              <div class="carousel-inner">

                <div class="item">
                  <blockquote><p>Спасибо <a style="color:#64aed9!important ;" href="/">postscanner.ru</a>! Благодаря сайту узнал про акцию одного из
операторов на посылки по России, в итоге стоимость доставки подарка
другу оказалась почти в два раза дешевле, чем планировал. Теперь буду
следить за вашими новостями!</p></blockquote>
                  <div class="carousel-info">
                    <img class="pull-left" src="./assets/frontend/pages/img/people/img2-small.jpg" alt="">
                    <div class="pull-left">
                      <span class="testimonials-name">Михаил</span>
                      <span class="testimonials-post">Москва</span>
                    </div>
                  </div>
                </div>
                
                <div class="item">
                  <blockquote><p>Нашла много выгодных предложений, поэтому доставка груза по работе
стала более экономной. Что приятно, тут же можно не только рассчитать
доставку, но и отследить посылку. При этом пользоваться сайтом удобно
и все операции происходят быстро и точно. Словом, рекомендую!</p></blockquote>
                  <div class="carousel-info">
                    <img class="pull-left" src="./assets/frontend/pages/img/people/img5-small.jpg" alt="">
                    <div class="pull-left">
                      <span class="testimonials-name">Светлана</span>
                      <span class="testimonials-post">Казань</span>
                    </div>
                  </div>
                </div>
                
                <div class="item">
                  <blockquote><p>Впервые появилась необходимость отправить документы, решил изучить
предложения и рассчитать доставку почтой. Ваш сайт стал настоящей
находкой, я быстро и совершенно бесплатно выяснил нужную мне
информацию и нашел выгодное предложение по отправке почты в своем
городе. Спасибо за добротный и удобный сервис!</p></blockquote>
                  <div class="carousel-info">
                    <img class="pull-left" src="./assets/frontend/pages/img/people/img9-large.jpg" alt="">
                    <div class="pull-left">
                      <span class="testimonials-name">Евгений Анатольевич</span>
                      <span class="testimonials-post">Самара</span>
                    </div>
                  </div>
                </div>
                
                <div class="item">
                  <blockquote><p>Оказывается, почтовые отправления может доставить не только «Почта
России», есть много компаний, которые предлагают лучшие условия и при
этом низкие цены. Стоимость посылки с помощью менее раскрученного
оператора обошлась мне почти на 700 рублей дешевле, чем обычно.
Благодарю <a style="color:#64aed9!important ;" href="/">postscanner.ru</a> за информацию!</p></blockquote>
                  <div class="carousel-info">
                    <img class="pull-left" src="./assets/frontend/pages/img/people/img7-large.jpg" alt="">
                    <div class="pull-left">
                      <span class="testimonials-name">Марина</span>
                      <span class="testimonials-post"> Санкт-Петербург</span>
                    </div>
                  </div>
                </div>
                
                <div class="item">
                  <blockquote><p>Отличный сервис! Теперь можно отправить груз или документы по выгодной
цене, а еще рассчитать стоимость доставки и выяснить, сколько стоит
посылка у разных компаний на одном сайте. Очень удобный ресурс,
помогает экономить время и деньги.</p></blockquote>
                  <div class="carousel-info">
                    <img class="pull-left" src="./assets/frontend/pages/img/people/img3-small.jpg" alt="">
                    <div class="pull-left">
                      <span class="testimonials-name">Елена</span>
                      <span class="testimonials-post">Краснодарский край</span>
                    </div>
                  </div>
                </div>
                
                <div class="item">
                  <blockquote><p>Сильно переживал, что посылка в Москву не прибудет к определенному
сроку. Выяснил, что можно отследить посылку и за несколько секунд
узнал на сайте, где сейчас находится отправление. Спасибо за помощь!</p></blockquote>
                  <div class="carousel-info">
                    <img class="pull-left" src="./assets/frontend/pages/img/people/img8-large.jpg" alt="">
                    <div class="pull-left">
                      <span class="testimonials-name">Петр</span>
                      <span class="testimonials-post">Ростов-на-Дону</span>
                    </div>
                  </div>
                </div>
                

                
                
                
                
                <div class="item">
                  <blockquote><p>Отличная идея. Смог найти намного более интересные опции по доставке чем обычно. А главное просто, быстро и бесплатно. Теперь получится существенно сэкономить на доставке!</p></blockquote>
                  <div class="carousel-info">
                    <img class="pull-left" src="./assets/frontend/pages/img/people/img4-small.jpg" alt="">
                    <div class="pull-left">
                      <span class="testimonials-name">Александр Кочетков</span>
                      <span class="testimonials-post">Москва</span>
                    </div>
                  </div>
                </div>
				
                <div class="active item">
                  <blockquote><p>Спасибо postscanner что помог мне сэкономить 3000р. Я отправил посылку родителям не за 4000 как привык а всего за 1000 рублей, и без потери в скорости и сервисе. Postscanner супер сервис! Очень помог!</p></blockquote>
                  <div class="carousel-info">
                    <img class="pull-left" src="./assets/frontend/pages/img/people/img6-large.jpg" alt="">
                    <div class="pull-left">
                      <span class="testimonials-name">Дмитрий Парамонов</span>
                      <span class="testimonials-post">Оренбург</span>
                    </div>
                  </div>
                </div>
				
                <div class="item">
                  <blockquote><p>Спасибо Postscanner за сэкономленные деньги. Отправила документы в 3 раза дешевле чем обычно. Очень актуальный сервис!</p></blockquote>
                  <div class="carousel-info">
                    <img class="pull-left" src="./assets/frontend/pages/img/people/img1-small.jpg" alt="">
                    <div class="pull-left">
                      <span class="testimonials-name">Ирина Зарецкая</span>
                      <span class="testimonials-post">Москва</span>
                    </div>
                  </div>
                </div>
								
              </div>

              <!-- Carousel nav -->
              <a class="left-btn" href="#myCarousel" data-slide="prev"></a>
              <a class="right-btn" href="#myCarousel" data-slide="next"></a>
            </div>
          </div>
          <!-- END TESTIMONIALS -->
        </div>                
        <!-- END TABS AND TESTIMONIALS -->

        <!-- BEGIN STEPS -->
        <div class="row margin-bottom-40 front-steps-wrapper front-steps-count-3">
          <div class="col-md-4 col-sm-4 front-step-col">
            <div class="front-step front-step1">
              <h2>Запрос</h2>
              <p>Вы вносите основные параметры посылки: место отправления, место назначения, габаритные размеры и вес посылки, а так же страховую стоимость.</p>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 front-step-col">
            <div class="front-step front-step2">
              <h2>Обработка</h2>
              <p>Postscanner собирает предложения от более чем 40 служб экспресс-доставки.</p>
			  <br />
            </div>
          </div>
          <div class="col-md-4 col-sm-4 front-step-col">
            <div class="front-step front-step3">
              <h2>Результат</h2>
              <p>Вы получаете лучшие предложения по доставке вашей посылки в форме удобной таблицы, с указанием стоимости, сроков и описанием условий доставки.</p>
            </div>
          </div>
        </div>
        <!-- END STEPS -->

        <!-- BEGIN CLIENTS -->
        <div class="row margin-bottom-40 our-clients">
          <div class="col-md-3">
            <h2><a href="#">Компании</a></h2>
            <p>Мы анализируем сайты и базы данных более чем 40 транспортных компаний:</p>
          </div>
          <div class="col-md-9">
            <div class="owl-carousel owl-carousel6-brands">
              <!-- <div class="client-item">
                <a href="#">
                  <img src="./assets/frontend/pages/img/clients/client_1_gray.png" class="img-responsive" alt="">
                  <img src="./assets/frontend/pages/img/clients/client_1.png" class="color-img img-responsive" alt="">
                </a>
              </div>
              <div class="client-item">
                <a href="#">
                  <img src="./assets/frontend/pages/img/clients/client_2_gray.png" class="img-responsive" alt="">
                  <img src="./assets/frontend/pages/img/clients/client_2.png" class="color-img img-responsive" alt="">
                </a>
              </div>
              <div class="client-item">
                <a href="#">
                  <img src="./assets/frontend/pages/img/clients/client_3_gray.png" class="img-responsive" alt="">
                  <img src="./assets/frontend/pages/img/clients/client_3.png" class="color-img img-responsive" alt="">
                </a>
              </div>
              <div class="client-item">
                <a href="#">
                  <img src="./assets/frontend/pages/img/clients/client_4_gray.png" class="img-responsive" alt="">
                  <img src="./assets/frontend/pages/img/clients/client_4.png" class="color-img img-responsive" alt="">
                </a>
              </div>
              <div class="client-item">
                <a href="#">
                  <img src="./assets/frontend/pages/img/clients/client_5_gray.png" class="img-responsive" alt="">
                  <img src="./assets/frontend/pages/img/clients/client_5.png" class="color-img img-responsive" alt="">
                </a>
              </div>
              <div class="client-item">
                <a href="#">
                  <img src="./assets/frontend/pages/img/clients/client_6_gray.png" class="img-responsive" alt="">
                  <img src="./assets/frontend/pages/img/clients/client_6.png" class="color-img img-responsive" alt="">
                </a>
              </div>
              <div class="client-item">
                <a href="#">
                  <img src="./assets/frontend/pages/img/clients/client_7_gray.png" class="img-responsive" alt="">
                  <img src="./assets/frontend/pages/img/clients/client_7.png" class="color-img img-responsive" alt="">
                </a>
              </div>
              <div class="client-item">
                <a href="#">
                  <img src="./assets/frontend/pages/img/clients/client_8_gray.png" class="img-responsive" alt="">
                  <img src="./assets/frontend/pages/img/clients/client_8.png" class="color-img img-responsive" alt="">
                </a>
              </div> -->
              <?php require('generate_footer.php') ?>
            </div>
          </div>          
        </div>
        <!-- END CLIENTS -->
      </div>
    </div>

    

    <?php require('footer.php') ?>

    <!-- Load javascripts at bottom, this will reduce page load time -->
    <!-- BEGIN CORE PLUGINS (REQUIRED FOR ALL PAGES) -->
    <!--[if lt IE 9]>
    <script src="./assets/global/plugins/respond.min.js"></script>
    <![endif]--> 
    <script src="./assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
    <script src="./assets/global/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
    <script src="./assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>      
    <script src="./assets/frontend/layout/scripts/back-to-top.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->

    <!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
    <script src="./assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
    <script src="./assets/global/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.min.js" type="text/javascript"></script><!-- slider for products -->

    




<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="./assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="./assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="./assets/global/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script type="text/javascript" src="./assets/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>
<script type="text/javascript" src="./assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="./assets/global/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="./assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="./assets/admin/layout2/scripts/layout.js" type="text/javascript"></script>
<script src="./assets/admin/layout2/scripts/demo.js" type="text/javascript"></script>
<script src="./assets/admin/pages/scripts/table-advanced.js"></script>


<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="../../assets/global/plugins/jquery-notific8/jquery.notific8.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script src="../../assets/admin/pages/scripts/ui-notific8.js"></script>
<script src="../../assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../../assets/admin/layout2/scripts/layout.js" type="text/javascript"></script>
<script src="../../assets/admin/layout2/scripts/demo.js" type="text/javascript"></script>




<script src="./assets/frontend/layout/scripts/layout.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            Layout.init();    
            Layout.initOWL();
           // RevosliderInit.initRevoSlider();
            Layout.initTwitter();
//            Metronic.init();
//            Demo.init();
            //TableAdvanced.init();
			$('.white_link').popover();
            if($.browser.mozilla)
            {
              $('#sendRequest').css({'margin-left':'60px'});
            }
            if ($(document).width()<550)
            {
                //alert($(document).width());
                $('#dbg_test,.filter .filter_text').remove();
            }
            initSelect2();
            if ($(document).width()<950)
            {
                $('.filter div.filter_line').css({'text-align':'center'});
                $('.filter a.white_link, .filter input,#sendRequest').width('70%');
                $('.filter div.select2-container').width('100%');
                $('.filter div.select2-container a').width('90%');
                $('#sendRequest').css({'margin-left':'0px'});
                $('#sendRequest').css({'margin-top':'15px'});
            }
            // $('.main_filter_form').show(100);
            var select2Inited = false;
            function initSelect2() {
                if (select2Inited) {
                    return false;
                }
                select2Inited = true;
                $("#fromCity").select2({
                    placeholder: "Город отправления",
                    minimumInputLength: 1,
                    ajax: {
                        url: "get_city.php",
                        dataType: 'json',
                        data: function (term, page) {
                            return {
                                q: term
                            };
                        },
                        results: function (data, page) {
                        //alert(data.length);
                            return {results: data};
                            return {results: JSON.parse(data)};
                        }
                    },
                });
                $("#toCity").select2({
                    placeholder: "Город назначения",
                    minimumInputLength: 1,
                    ajax: {
                        url: "get_city.php",
                        dataType: 'json',
                        data: function (term, page) {
                            return {
                                q: term
                            };
                        },
                        results: function (data, page) {
                        //alert(data.length);
                            return {results: data};
                            return {results: JSON.parse(data)};
                        }
                    },
                });
                return true;
            }
			//UINotific8.init();
            /*
                looking for select2 initialization of #fromCity and #toCity? now in revo-slider-init.js
            */
            //Layout.initFixHeaderWithPreHeader(); /* Switch On Header Fixing (only if you have pre-header) */
            //Layout.initNavScrolling(); 
        });
    </script>
    <!-- END PAGE LEVEL JAVASCRIPTS -->
        <script type="text/javascript" src="js/loading.js"></script>
        <script type="text/javascript" src="js/submits.js"></script>
        <script type="text/javascript" src="js/size-manager.js"></script>
        <script src="select2/select2.js"></script>
    <script src="select2/select2_locale_ru.js"></script>

	


    <script>
    $(function(){
        $('.send_zak_form').click(function (){
            fromCity = $("#fromCity").select2("data")["text"];
    		toCity = $("#toCity").select2("data")["text"];
    		weight = document.getElementById("weight").value;
            var width = document.getElementById("width").value, height = document.getElementById("height").value, length = document.getElementById("length").value;
            var volume = parseInt(height) * parseInt(width) * parseInt(length) * 1.0 / 1000000;
            volume=length+'x'+width+'x'+height;
            var value = document.getElementById("value").value;
            var dataShip="from=" + fromCity + "&to=" + toCity + "&weight=" + weight + "&volume=" + volume + "&svalue=" + value;
            var zakdata='';
            var valid=true;
            $("#zak-form input").each(function()
            {
                var inpValue=$(this).val().trim();
                if (inpValue=='')
                    valid=false;
                zakdata=zakdata+$(this).attr('name')+'='+inpValue+'&';
            })
            if (!valid)
            {
                $('#sendZak').popover('show');
                setTimeout("$('#sendZak').popover('hide');", 4000)
                return false;
                
            }
            
            
            
            zakdata=zakdata+dataShip+'&comment='+$('#inputComment').val();
            $('.preloader_zak').removeClass('hidden');
            $.ajax({
			type : "POST",
			url : "ajax/send_zak.php",
			data : zakdata,
			
			success : function(response) {
				$('#tallModal').modal('hide');
                $('#smallModal').modal('show');
                setTimeout(closeSmallModal,4000)
                //$('.res_send_zak').html('Ваша заявка отправлена. В ближайшее время с вами свяжется менеджер.');
                $('.preloader_zak').addClass('hidden');
                
			},
            error : function() {
                alert("Произошла ошибка");
                //refreshInterface();
            }
		});
            
        });
        function closeSmallModal()
        {
            $('#smallModal').modal('hide');
        }
    })
    
    </script>
<style>
div.modal
{
    top:4%;
}
div.modal-dialog
{
    
}
</style>
<div id="smallModal" class="modal modal-wide fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Заказ доставки</h4>
      </div>
      <div class="modal-body">
        <div class=" description">Ваша заявка отправлена. В ближайшее время с вами свяжется менеджер.</div>
        </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
         
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->	
	
<div id="tallModal" class="modal modal-wide fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Заказ доставки</h4>
      </div>
      <div class="modal-body">
        <div class="zak-description"></div>
        <form id="zak-form" class="form-horizontal">
        
            <div class="form-group">
                <!--<label for="inputEmail" class="col-xs-2 control-label">Имя:</label>-->
                <div class="col-xs-10">
                  <input type="text" name="usrname" class="form-control" id="inputEmail" placeholder="Имя">
                </div>
             </div>
            <div class="form-group">
                <!--<label for="inputEmail" class="col-xs-2 control-label">Телефон:</label>-->
                <div class="col-xs-10">
                  <input type="email" name="phone" class="form-control" id="inputEmail" placeholder="телефон">
                </div>
             </div>
            <div class="form-group">
                <!--<label for="inputEmail" class="col-xs-2 control-label">Email:</label>-->
                <div class="col-xs-10">
                  <input type="text" name="email" class="form-control" id="inputEmail" placeholder="email">
                </div>
             </div>
            <div class="form-group">
                <!--<label for="inputComment" class="col-xs-2 control-label">Комментарий:</label>-->
                <div class="col-xs-10">
                  <textarea name="comment" class="form-control" placeholder="Комментарий" id='inputComment'></textarea>
                </div>
             </div>
            <input type="hidden" name="compname"/>
            <input type="hidden" name="srok"/>
            <input type="hidden" name="price"/>
            <input type="hidden" name="condition"/>
            <input type="hidden" name="comail"/>
        </form>
        <div style="color: grey;">*стоимость доставки предварительная, финальная стоимость подлежит согласованию с оператором.</div>
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        <button data-trigger='manual'  data-content="Заполнены не все обязательные поля, либо заполнены некорректно"  data-original-title="Ошибка" type="button" class="send_zak_form btn btn-primary" id="sendZak">Отправить</button>
        
        <div class="res_send_zak"></div>
        <span class="preloader hidden preloader_zak"></span>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->	

<!-- Yandex.Metrika informer -->
<a href="https://metrika.yandex.ru/stat/?id=27119789&amp;from=informer"
target="_blank" rel="nofollow"><img src="//bs.yandex.ru/informer/27119789/3_1_FFFFFFFF_EFEFEFFF_0_pageviews"
style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:27119789,lang:'ru'});return false}catch(e){}"/></a>
<!-- /Yandex.Metrika informer -->
	
<style>
.popover {
    
    font-size: 11px !important;
    }
</style>	
</body>
<!-- END BODY -->
</html>
