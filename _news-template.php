<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Head BEGIN -->
<head>
  <meta charset="utf-8">
  <title>Новости | Агрегатор экспресс-доставки Postscanner</title>

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
  <link href="../../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="../../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Global styles END --> 
   
  <!-- Page level plugin styles START -->
  <link href="../../assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
  <!-- Page level plugin styles END -->

  <!-- Theme styles START -->
  <link href="../../assets/global/css/components.css" rel="stylesheet">
  <link href="../../assets/frontend/layout/css/style.css" rel="stylesheet">
  <link href="../../assets/frontend/layout/css/style-responsive.css" rel="stylesheet">
  <link href="../../assets/frontend/layout/css/themes/blue.css" rel="stylesheet" id="style-color">
  <link href="../../assets/frontend/layout/css/custom.css" rel="stylesheet">
  <!-- Theme styles END -->
</head>
<!-- Head END -->

<!-- Body BEGIN -->
<body class="corporate">
    <?php require('header.php') ?>

    <div class="main">
      <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.php">Главная</a></li>
            <li class="active">Новости</li>
        </ul>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->
          <div class="col-md-12 col-sm-12">
          <?php if ($user->isNewsManager()) {?>
            <a type="button" class="btn btn-primary pull-right" href="news_add.php">Добавить новость</a>
          <?php } ?>
            <h1>Новости</h1>
			<br />
			<br />
            <div class="content-page">
              <div class="row">
                <!-- BEGIN LEFT SIDEBAR -->    
                <div class="col-md-9 col-sm-9 blog-posts">        
                <?php 
                foreach ($all_news as $news) {
                    $link = '?id='.$news->id;
                    $picture = '/img/news/'.$news->id;
                    $usePicture = file_exists($_SERVER['DOCUMENT_ROOT'].$picture);
                ?>
                          <div class="row">
                            <?php if ($usePicture) {?>
                                <div class="col-md-4 col-sm-4">
                                  <!-- BEGIN CAROUSEL -->            
                                  <div class="front-carousel">
                                    <div class="carousel slide" id="myCarousel">
                                      <!-- Carousel items -->
                                      <div class="carousel-inner">
                                        <div class="item active">
                                          <a data-slide="prev" href="<?php echo $link ?>">
                                            <img alt="" src="<?php echo $picture ?>">
                                          </a>
                                        </div>
                                      </div>
                                    </div>                
                                  </div>
                                  <!-- END CAROUSEL -->             
                                </div>
                            <?php } ?>
                            <div class="<?php echo $usePicture ? 'col-md-8 col-sm-8' : 'col-md-12 col-sm-12' ?>">
                              <h2><a href="<?php echo $link ?>"><?php echo $news->title ?> </a></h2>
                              <ul class="blog-info">
                                <li><i class="fa fa-calendar"></i> <?php echo $news->date ?></li>
                                <li><i class="fa fa-tags"></i> <?php echo $news->tags ?></li>
                              </ul>
                              <p><?php echo $news->content ?></p>
                              <a href="<?php echo $link ?>" class="more">Читать полностью <i class="icon-angle-right"></i></a>
                              
                              <?php if ($user->isNewsManager()) {?>
                              <form class="submit-form" action="" method="post">
                                <input type="hidden" name="delete_id" value="<?php echo $news->id ?>">
                                <input type="submit" class="btn btn-primary pull-right" value="Удалить новость">
                              </form>
                              <?php } ?>
                            </div>
                            
                          </div>
                          <hr class="blog-post-sep">
                <?php }?>
                  
                  <ul class="pagination">
                    <li><a href="<?php echo '?page='.($page > 1 ? $page - 1 : 1)?>">Предыдущая</a></li>
                    <?php 
                        for ($i = 1; $i <= $total_pages; ++$i) { 
                            print_r('<li '.($i == $page ? 'class="active"' : '').'><a href="?page='.$i.'">'.$i.'</a></li>');
                        } 
                    ?>
                    <li><a href="<?php echo '?page='.($page < $total_pages ? $page + 1 : $total_pages)?>">Следующая</a></li>
                  </ul>               
                </div>
<!-- END LEFT SIDEBAR -->

                <!-- BEGIN RIGHT SIDEBAR -->            
                <div class="col-md-3 col-sm-3 blog-sidebar">
                  <div class="form-info">
                    <h2><em>Свяжитесь</em> с нами</h2>
                    <p>Если у Вас возникли вопросы по данной теме или предложения по улучшению нашего сервиса, мы всегда будем рады услышать Ваш отзыв. Пожалуйста, воспользуйтесь контактной формой для отправки сообщения!</p>
					<a href="/contacts/">
                    <button type="button" class="btn btn-default">Связаться с Postscanner</button>
					</a>
				  </div>
                </div>
                <!-- END RIGHT SIDEBAR -->            
              </div>
            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
      </div>
    </div>

    <?php require('footer.php') ?>

    <!-- Load javascripts at bottom, this will reduce page load time -->
    <!-- BEGIN CORE PLUGINS (REQUIRED FOR ALL PAGES) -->
    <!--[if lt IE 9]>
    <script src="../../assets/global/plugins/respond.min.js"></script>
    <![endif]-->
    <script src="../../assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
    <script src="../../assets/global/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
    <script src="../../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>      
    <script src="../../assets/frontend/layout/scripts/back-to-top.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->

    <!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
    <script src="../../assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->

    <script src="../../assets/frontend/layout/scripts/layout.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            Layout.init();
            Layout.initTwitter();
        });
        
        $('.submit-form input[type="submit"]').click(function () {
            return confirm('Вы уверены, что хотите удалить новость?');
        })
    </script>
    <!-- END PAGE LEVEL JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
