<?php 
    require_once("scripts/database.php");
    require_once("user.php");
    $db = new MySql("localhost", "ps", "psmysql01", "agregator");
    $db->connect();
    
    $user = new User();
    
    if (!$user->isNewsManager()) {
        header('Location: index.php');
    }
?>

<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.2.0
Version: 3.3.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest (the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Head BEGIN -->
<head>
  <meta charset="utf-8">
  <title>Postscanner | Публикация новостей</title>

  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <meta content="Metronic Shop UI description" name="description">
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
  <!-- Global styles END --> 
   
  <!-- Page level plugin styles START -->
  <link href="./assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
  <link href="./assets/global/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.css" rel="stylesheet">
  <link href="./assets/global/plugins/slider-revolution-slider/rs-plugin/css/settings.css" rel="stylesheet">
  <!-- Page level plugin styles END -->

  <!-- Theme styles START -->
  <link href="./assets/global/css/components.css" rel="stylesheet">
  <link href="./assets/frontend/layout/css/style.css" rel="stylesheet">
  <link href="./assets/frontend/pages/css/style-revolution-slider.css" rel="stylesheet"><!-- metronic revo slider styles -->
  <link href="./assets/frontend/layout/css/style-responsive.css" rel="stylesheet">
  <link href="./assets/frontend/layout/css/themes/blue.css" rel="stylesheet" id="style-color">
  <link href="./assets/frontend/layout/css/custom.css" rel="stylesheet">
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

<link href="./assets/global/css/components.css" rel="stylesheet" type="text/css"/>
<link href="./assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>






</head>
<!-- Head END -->

<!-- Body BEGIN -->
<body class="corporate">

    <?php require('header.php'); ?>

    <!-- BEGIN SLIDER -->
    <!-- END SLIDER -->

    <div class="main">
      <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row margin-bottom-20">

                        <div class="space20">
                        </div>
                        <!-- BEGIN FORM-->
                        <form enctype="multipart/form-data" action="news.php" method="post">
                            <h3 class="form-section">Добавить новость на сайт</h3>
                            <div class="form-group">
                                <input type="text" name="title" class="form-control" placeholder="Тема">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="tags" placeholder="Теги">
                            </div>
							
                            <div class="form-group">
							<h4 class="form-section">Загрузить миниатюру записи</h4>
							<input type="file" name="imgfile">
							</div>

                            <div class="form-group">
                                <textarea class="form-control" rows="8" name="content" placeholder="Текст новости"></textarea>
                            </div>
                            <button type="submit" class="btn blue">Опубликовать</button>
                        </form>
                        <!-- END FORM-->
                </div>
            </div>
        </div>
      </div>
    </div>

    
    <?php require('footer.php') ?>

<!--    <div style="position: fixed; bottom:0; left:0; right: 0;"> 
    </div>
-->
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

    <!-- BEGIN RevolutionSlider -->
  
    <script src="./assets/global/plugins/slider-revolution-slider/rs-plugin/js/jquery.themepunch.plugins.min.js" type="text/javascript"></script>
    <script src="./assets/global/plugins/slider-revolution-slider/rs-plugin/js/jquery.themepunch.revolution.min.js" type="text/javascript"></script> 
    <script src="./assets/global/plugins/slider-revolution-slider/rs-plugin/js/jquery.themepunch.tools.min.js" type="text/javascript"></script> 
    <script src="./assets/frontend/pages/scripts/revo-slider-init.js" type="text/javascript"></script>
    <!-- END RevolutionSlider -->




<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="./assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="./assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="./assets/global/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script type="text/javascript" src="./assets/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>
<script type="text/javascript" src="./assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="./assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="./assets/admin/layout2/scripts/layout.js" type="text/javascript"></script>
<script src="./assets/admin/layout2/scripts/demo.js" type="text/javascript"></script>
<script src="./assets/admin/pages/scripts/table-advanced.js"></script>









    <script src="./assets/frontend/layout/scripts/layout.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            Layout.init();    
            Layout.initOWL();
            RevosliderInit.initRevoSlider();
            Layout.initTwitter();
//            Metronic.init();
//            Demo.init();
            TableAdvanced.init();
            /*
                looking for select2 initialization of #fromCity and #toCity? now in revo-slider-init.js
            */
            //Layout.initFixHeaderWithPreHeader(); /* Switch On Header Fixing (only if you have pre-header) */
            //Layout.initNavScrolling(); 
        });
    </script>
    <!-- END PAGE LEVEL JAVASCRIPTS -->
		<script type="text/javascript" src="js/scripts.js"></script>
		<script type="text/javascript" src="js/size-manager.js"></script>
        <script src="select2/select2.js"></script>
    <script src="select2/select2_locale_ru.js"></script>

</body>
<!-- END BODY -->
</html>
