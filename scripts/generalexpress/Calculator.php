
<!DOCTYPE html>
<html>




	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Калькулятор доставки грузов и документов | Экспресс-доставка от General Express </title>
		<meta name="description" content="Курьерская служба доставки General Express предлагает полный комплекс услуг по экспресс-доставке корреспонденции, документов, подарков, а также ценных грузов по Москве, Петербургу и регионам. Калькулятор доставки грузов и документов. Телефоны: +7 (495) 975-72-60, +7 (812) 309-86-38.">
		<meta name="Keywords" content="Тарифный калькулятор">
		
		<link rel="shortcut icon" href="/express-dostavka/favicon.ico" type="image/x-icon" />
		<link rel="stylesheet" type="text/css" href="./css/main.css">
		<link rel="stylesheet" type="text/css" href="./css/print.css">
		<link rel="stylesheet" type="text/css" href="./css/device.css">
		<script src="/scripts/jquery-2.0.3.min.js" type="text/javascript"></script>
		<script src="/scripts/jquery.maskedinput.min.js" type="text/javascript"></script>		
		<script src="/scripts/main.js" type="text/javascript"></script>
		<script src="/scripts/mnu.js" type="text/javascript"></script>

		
			<?php include"./inc/header.inc"; ?> 
			<?php include"./inc/mnu.inc"; ?>

			<!-- левая панель-->
			<?php include"./inc/left.inc"; ?>


		<div id="page">
			<div id="page_calc">

		<h1>Калькулятор доставки грузов и документов</h1>
		<div id="calculator_express-dostavka"></div>
		<div class="settings" id="calculator_express-dostavka_main"></div>
		<div class="settings" id="calculator_express-dostavka_main2"></div>
		<div class="settings" id="calculator_express-dostavka_main3"></div>		
		<div class="settings" id="calculator_express-dostavka_main4"></div>	
		<div class="settings" id="calculator_express-dostavka_main5"></div>	
		<div class="settings" id="calculator_express-dostavka_main6"></div>								
		<div id="calculator_result"></div>
		<div id="calculator_order"></div>
		<div id="calculator_confirm"></div>
		<div id = "noprint" style = "text-align: center;">
				<button onclick= "print();" style = "
					display:inline-block;
					line-height: 30px;
					color: #cb4926;

					text-align: center;
					font-size: 100%;
					font-family: Arial;		
					font-weight: normal;

					border-width: 2px;
					border-style: solid;
					border-color: #e5e6e6;

					-webkit-border-radius: 2px;
					-moz-border-radius: 2px;
					border-radius: 2px;			
					
					background: #ffffff; /* Old browsers */
					background: -moz-linear-gradient(top,  #ffffff 0%, #f5f6f7 100%); /* FF3.6+ */
					background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffff), color-stop(100%,#f5f6f7)); /* Chrome,Safari4+ */
					background: -webkit-linear-gradient(top,  #ffffff 0%,#f5f6f7 100%); /* Chrome10+,Safari5.1+ */
					background: -o-linear-gradient(top,  #ffffff 0%,#f5f6f7 100%); /* Opera 11.10+ */
					background: -ms-linear-gradient(top,  #ffffff 0%,#f5f6f7 100%); /* IE10+ */
					background: linear-gradient(to bottom,  #ffffff 0%,#f5f6f7 100%); /* W3C */
					filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#f5f6f7',GradientType=0 ); /* IE6-9 */
					
					cursor: pointer;
					z-index: 100;
				" >
					Распечатать
					</button>
					</div>
			</div>
		</div>
		<div id = "noprint">
			<!-- правая панель-->
<?php include"./inc/right.inc"; ?>
		
		
		<!-- футер-->
<?php include"./inc/footer.inc"; ?>
</div>
	</body>
</html>