<!DOCTYPE html>
<html lang="en">
    
<!-- Head BEGIN -->
<head>
  <meta charset="utf-8">
  <title>Самая выгодная доставка | Postscanner | почтовые отправления </title>
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
  <!-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">  -->
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
<!-- Head ENDS -->

<!-- Body BEGINS -->
<body class="corporate">
    <div id="loading" style="display: none">
        <div class="page-spinner-bar" ng-spinner-bar="">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
        <div style="height: 100%; width: 100%; z-index: 2000; display: block; position: fixed; background: url(http://www.vacansoleil.it/static/images/newvcloader.gif) no-repeat 50% 50%;"></div> 
        <div class="blackout" style="height: 100%; width: 100%; z-index: 1000; display: block; position: fixed; background: rgb(0,0,0); opacity: 0.5;">
        </div>
    </div>
    
    <!-- HEADER STARTS HERE -->
    <div class="container-fluid" id="calculate">   
        <div class="row">
            <?php require('header.php'); ?>
            <img src="img/design_new/post_line.jpg" class="img-responsive" width="100%" height="7px" />
        </div>
    </div>    
    <!-- HEADER ENDS HERE -->
    
    <!-- MAIN FORM BEGINS -->
    <div class="main_frame">    
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 block-padded">
            <img src="img/design_new/stamp1.png" width="300px" class="img-responsive center-block" />
        </div>
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 block-padded-bottom text-center">
            <h1><span class="post_color">Найти самую выгодную доставку!</span></h1>
            <div class="design_new_main_form">
                <div class="row block-padded-sides block-padded-bottom block-padded-top">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <h4 class="text-left">Куда</h4>
                        <div class="toCity" id="toCity"></div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <h4 class="text-left" >Откуда</h4>
                        <div class="fromCity" id="fromCity" tabindex='0'></div>
                    </div>
                </div>
                <div class="row block-padded-sides block-padded-bottom">          
                    <div class="col-xs-12 col-sm-3 col-md-3"> 
                        <h4 class="text-left">Вес посылки</h4>
                        <input type="text" class="form-control input-lg" required placeholder="кг" id="weight" name="Weight" />
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3">
                        <h4 class="text-left">Длина</h4>
                        <input type="text" class="form-control input-lg" placeholder="cм" id="length" name="length" />
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3">
                        <h4 class="text-left">Ширина</h4> 
                        <input type="text" class="form-control input-lg" placeholder="cм" id="width" name="width" />
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3">
                        <h4 class="text-left">Высота</h4>
                        <input type="text" class="form-control input-lg" placeholder="cм" id="height" name="height" />
                    </div>       
                </div>
                <div class="row block-padded-bottom block-padded-sides"> 
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <h4 class="text-left">Страховая стоимость</h4>
                        <input type="text" class="form-control input-lg" placeholder="руб" id="value" name="value" />
                    </div>           
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <h4 class="text-left">&nbsp;</h4>
                        <a data-trigger='manual' data-content="Заполнены не все поля, либо заполнены некорректно" data-original-title="Ошибка" id="sendRequest" href="#" class="btn btn-default btn-lg btn-block">ПОИСК</a>
                    </div>
                </div>
            </div>  
        </div> <!-- RIGHT COLUMN OF MAIN_FRAME ENDS -->  
    </div> 
    <!-- MAIN FORM ENDS -->
    
    <img src="img/design_new/post_line.jpg" class="img-responsive" width="100%" height="7px" />

<div class="container-fluid">
    
    <!-- REGISTRATION BLOCK BEGINS -->
    <div class="row">
        <div class="block_registration block-padded text-center">
        <h1 class="post_color">Хотите стать нашим постоянным клиентом?</h1>
        <h3 class="post_color block-padded-bottom">Вы сможете пользоваться всеми преимуществами нашего сервиса!</h3>
            <a href="#" class="btn btn-default btn-lg">Зарегистрироваться</a>
        </div>
    </div>
    <!-- REGISTRATION BLOCK ENDS -->
    
    <!-- POSTSCANNER ALGORYTHM DESCRIPTION STARTS -->
    <div class="row">
        <div class="block_how_it_works block-padded">
            <div class="white_based center-block text-center">
                <h1>Как работает Postscanner?</h1>
                <h3 class="block-padded-bottom">Всего три шага!</h3>
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-4 block-padded-bottom">
                        <h4>Запрос</h4>
                        <p>Вы вносите основные параметры посылки: место отправления, место назначения, габаритные размеры и вес посылки, а так же страховую стоимость.</p>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 block-padded-bottom">
                        <h4>Обработка</h4>
                        <p>Postscanner собирает предложения от более чем 40 служб экспресс-доставки.</p>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 block-padded-bottom">
                        <h4>Результат</h4>
                        <p>Вы получаете лучшие предложения по доставке вашей посылки в форме удобной таблицы, с указанием стоимости, сроков и описанием условий доставки.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- POSTSCANNER ALGORYTHM DESCRIPTION ENDS -->
    
    <!-- POSTSCANNER VIDEO BEGINS -->
    <div class="row" id="anchor_video">
        <div class="block_video block-padded block-padded-bottom text-center">
        <h1>Как пользоваться сервисом Postscanner?</h1>
        <h3 class="block-padded-bottom">Мы создали видео для вашего удобства!</h3>
            <div class="col-xs-12 col-sm-12 col-md-12 block-padded-bottom text-center">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe width="420" height="236" src="https://www.youtube.com/embed/fidiItkLAss" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- POSTSCANNER VIDEO ENDS -->
    
    <!-- FEEDBACK CAROUSEL BEGINS -->
    <div class="row" id="anchor_feedback">
        <div class="block_feedback block-padded text-center">
            <div class="white_based center-block">
                <h1>Что о нас говорят?</h1>
                <h3 class="block-padded-bottom">Отзывы наших довольных клиентов!</h3>
                  <div class='row'>
                    <div class='col-md-12'>
                      <div class="carousel slide" data-ride="carousel" id="quote-carousel">
                        <!-- Bottom Carousel Indicators -->
                        <ol class="carousel-indicators">
                          <li data-target="#quote-carousel" data-slide-to="0" class="active"></li>
                          <li data-target="#quote-carousel" data-slide-to="1"></li>
                          <li data-target="#quote-carousel" data-slide-to="2"></li>
                          <li data-target="#quote-carousel" data-slide-to="3"></li>
                        </ol>

                        <!-- Carousel Slides / Quotes -->
                        <div class="carousel-inner">
                          <!-- Quote 1 -->
                          <div class="item active">
                            <blockquote>
                              <div class="row">
                                <div class="col-sm-3 text-center">
                                  <img class="img-circle" src="img/design_new/feedback_Elena.jpg" style="width: 100px;height:100px;">
                                </div>
                                <div class="col-sm-9">
                                  <p>Отличный сервис! Теперь можно отправить груз или документы по выгодной цене, а еще рассчитать стоимость доставки и выяснить, сколько стоит посылка у разных компаний на одном сайте. Очень удобный ресурс, помогает экономить время и деньги.</p>
                                  <small>Елена. Краснодарский Край</small>
                                </div>
                              </div>
                            </blockquote>
                          </div>
                          <!-- Quote 2 -->
                          <div class="item">
                            <blockquote>
                              <div class="row">
                                <div class="col-sm-3 text-center">
                                  <img class="img-circle" src="img/design_new/feedback_Petr.jpg" style="width: 100px;height:100px;">
                                </div>
                                <div class="col-sm-9">
                                  <p>Сильно переживал, что посылка в Москву не прибудет к определенному сроку. Выяснил, что можно отследить посылку и за несколько секунд узнал на сайте, где сейчас находится отправление. Спасибо за помощь!</p>
                                  <small>Петр. Ростов-на-Дону</small>
                                </div>
                              </div>
                            </blockquote>
                          </div>
                          <!-- Quote 3 -->
                          <div class="item">
                            <blockquote>
                              <div class="row">
                                <div class="col-sm-3 text-center">
                                  <img class="img-circle" src="img/design_new/feedback_Alexandr.jpg" style="width: 100px;height:100px;">
                                </div>
                                <div class="col-sm-9">
                                  <p>Отличная идея. Смог найти намного более интересные опции по доставке чем обычно. А главное просто, быстро и бесплатно. Теперь получится существенно сэкономить на доставке!</p>
                                  <small>Александр Кочетков. Москва</small>
                                </div>
                              </div>
                            </blockquote>
                          </div>
                          <!-- Quote 4 -->
                          <div class="item">
                            <blockquote>
                              <div class="row">
                                <div class="col-sm-3 text-center">
                                  <img class="img-circle" src="img/design_new/feedback_Dmitriy.jpg" style="width: 100px;height:100px;">
                                </div>
                                <div class="col-sm-9">
                                  <p>Спасибо postscanner что помог мне сэкономить 3000р. Я отправил посылку родителям не за 4000 как привык а всего за 1000 рублей, и без потери в скорости и сервисе. Postscanner супер сервис! Очень помог!</p>
                                  <small>Дмитрий Парамонов. Оренбург</small>
                                </div>
                              </div>
                            </blockquote>
                          </div>
                        </div>

                        <!-- Carousel Buttons Next/Prev -->
                        <a data-slide="prev" href="#quote-carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>
                        <a data-slide="next" href="#quote-carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a>
                      </div>                          
                    </div>
                  </div>
                </div>
            </div>
        </div>
        <!-- FEEDBACK CAROUSEL ENDS -->
    
        <!-- ACCORDION QUESTIONS BEGINS  -->
        <div class="row">
            <div class="block_faq block-padded text-center">
                <h1>У вас остались вопросы?</h1>
                <h3 class="block-padded-bottom">Найдите ваш вопрос в списке или задайте свой!</h3>
                    <div class="col-xs-12 col-sm-12 col-md-12 block-padded-bottom">
                        <div class="panel-group text-left" id="accordion">
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title post_color">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                Чем Postscanner полезен людям?</a>
                              </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse in">
                              <div class="panel-body">Postscanner поможет вам за несколько секунд найти наиболее оптимальный вариант экспресс-доставки посылки по России, что позволит отправить документы, груз или письмо и при этом существенно сэкономить. Бесплатный поиск с Postscanner – это быстро, просто и удобно!</div>
                            </div>
                          </div>
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title post_color">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                Чем Postscanner полезен почтовым операторам?</a>
                              </h4>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse">
                              <div class="panel-body">Postscanner предоставляет возможность рассказать о новых сервисах, направлениях почтовых отправлений и актуальных акциях по доставке посылок. Делайте ваши лучшие предложения по экспресс-доставке посылок на Postscanner и вместе мы поможем людям стать ближе.</div>
                            </div>
                          </div>
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title post_color">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                Postscanner для веб-сервисов</a>
                              </h4>
                            </div>
                            <div id="collapse3" class="panel-collapse collapse">
                              <div class="panel-body">Виджет от Postscanner поможет предоставить вашим клиентам различные условия экспресс-доставки по России. В результате доставка посылок становится более выгодной, что позволяет клиентам сделать выбор в вашу пользу.</div>
                            </div>
                          </div>
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title post_color">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                                В чем преимущество сервиса Postscanner?</a>
                              </h4>
                            </div>
                            <div id="collapse4" class="panel-collapse collapse">
                              <div class="panel-body">В большинстве случаев люди предпочитают обратиться либо в Почту России, либо в компанию с мировым именем. Однако практика показывает, что зачастую стоимость услуг даже среди мировых лидеров может отличаться в несколько раз, а услуги локальных служб экспресс-доставки ничем не хуже но обходятся значительно дешевле.Что бы подобрать оптимальный вариант экспресс-доставки по России необходимо потратить массу времени. Postscanner позволит решить эту проблему за несколько секунд. Поиск с Postscanner – это быстро, просто и бесплатно.</div>
                            </div>
                          </div>
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title post_color">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                                О работе сервиса Postscanner в двух словах</a>
                              </h4>
                            </div>
                            <div id="collapse5" class="panel-collapse collapse">
                              <div class="panel-body">Вы вносите основные параметры вашей посылки, а Postscanner подбирает все возможные варианты экспресс-доставки по России от более чем 40 ведущих служб экспресс-доставки. Используя результаты поиска вы можете выбрать лучшее предложение по соотношению цена/ качество / скорость доставки и заказать обратный звонок от службы экспресс-доставки, либо вызвать курьера.</div>
                            </div>
                          </div>
                        </div>
                    </div>
            </div>
        </div>
        <!-- ACCORDION QUESTIONS ENDS  -->
    
        <!-- DECOR POST LINE BEGINS  -->
        <div class="row block-padded-bottom">    
            <img src="img/design_new/post_line.jpg" class="img-responsive" width="100%" height="7px" />
        </div>
        <!-- DECOR POST LINE ENDS  -->
    
        <!-- FORM_QUESTIONS BEGINS  --> 
        <div class="row" id="anchor_question">
            <div class="block_questions">
                <div class="col-md-4 col-md-offset-4 block-padded-bottom">
                <h1 class="block-padded-bottom text-center">Напишите нам</h1>
                    <form class="form-horizontal text-left" method="post" name="form_question">
                      <div class="form-group">
                          <div class="col-sm-12">
                            <label for="form_question_name">Имя</label> 
                                <input type="text" class="form-control" id="form_question_name" placeholder="" />
                            </div>
                      </div>
                      <div class="form-group">
                          <div class="col-sm-12">
                            <label for="form_question_email">Email</label>
                                <input type="email" class="form-control" id="form_question_email" placeholder="" />
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="col-sm-12">
                            <label for="form_question_question">Ваш комментарий</label>
                              <textarea class="form-control" name="form_question_textarea" placeholder=""></textarea>
                          </div>
                      </div>
                      <button type="submit" class="btn btn-default btn-lg center-block">Отправить</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- FORM_QUESTIONS ENDS  -->
    
        <!-- CALCULATION BEGINS  -->
        <div class="row">
            <div class="block_calculate block-padded block-padded-bottom text-center">
            <h1>Хотите знать стоимость доставки Вашего груза?</h1>
                <h3 class="block-padded-bottom">Вам просто надо указать параметры груза!</h3>    
                    <a href="#calculate" class="btn btn-default btn-lg">Рассчитать</a>
            </div>
        </div>
        <!-- CALCULATION ENDS  -->
    
        <!-- PARTNERS BEGIN  -->
        <div class="row">
            <div class="block_partners_frame our-clients block-padded block-padded-sides text-center">
            <h1>Кто наши партнеры?</h1>
                <h3 class="block-padded-bottom">Мы работаем с более чем 40 перевозчиками!</h3>
                <div class="col-md-8 col-md-offset-2 block-padded-bottom">
                    <div class="owl-carousel owl-carousel6-brands">
                        <?php require('generate_footer.php') ?>
                    </div>
                </div>
            </div>
        <!-- PARTNERS END -->
            
    </div>
</div>

<!-- FOOTER STARTS HERE -->    
    <?php require('footer.php') ?>
<!-- FOOTER ENDS HERE -->
    
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
              $('#sendRequest').css({'margin-left':'0px'});
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
                $('#sendRequest').css({'margin-top':'0px'});
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
    <script>
    // When the DOM is ready, run this function
    $(document).ready(function() {
      //Set the carousel options
      $('#quote-carousel').carousel({
        pause: true,
        interval: 7000,
      });
    });
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


	
<style>
.popover {
    
    font-size: 11px !important;
    }
</style>
    
    
</body>
<!-- END BODY -->
</html>
