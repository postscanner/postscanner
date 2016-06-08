// JavaScript Document

function StaticLoad(type, page) {		
//	alert(page);
//	var page='type=settings6&order-goods-weight=0&order-goods-size-width=0&order-goods-size-length=0&order-goods-size-height=0&order-type-goods=goods&order-type=order-urgent&order-city=Moscow&order-address-fence=in&order-address-delivery=in&order-time=2';
	var element='';
	switch(type) {
		case 'view':
			element="#calculator_express-dostavka";
			$('.settings').hide();
			$('.settings').html('');
//			alert(page);						
		break;
		case 'settings':
			element="#calculator_express-dostavka_main";
			$('.settings').hide();
			$('.settings').html('');				
//			alert(page);								
		break;
		case 'settings2':
			element="#calculator_express-dostavka_main2";
			$('#calculator_express-dostavka_main3').hide();
			$('#calculator_express-dostavka_main3').html('');

			$('#calculator_express-dostavka_main4').hide();
			$('#calculator_express-dostavka_main4').html('');

			$('#calculator_express-dostavka_main5').hide();
			$('#calculator_express-dostavka_main5').html('');

			$('#calculator_express-dostavka_main6').hide();
			$('#calculator_express-dostavka_main6').html('');			
//			alert(page);			
		break;
		case 'settings3':
			element="#calculator_express-dostavka_main3";
			$('#calculator_express-dostavka_main4').hide();
			$('#calculator_express-dostavka_main4').html('');

			$('#calculator_express-dostavka_main5').hide();
			$('#calculator_express-dostavka_main5').html('');

			$('#calculator_express-dostavka_main6').hide();
			$('#calculator_express-dostavka_main6').html('');						
//1			alert(page);
		break;
		case 'settings4':
			element="#calculator_express-dostavka_main4";
			$('#calculator_express-dostavka_main5').hide();
			$('#calculator_express-dostavka_main5').html('');			
			$('#calculator_express-dostavka_main6').hide();
			$('#calculator_express-dostavka_main6').html('');			
//1			alert(page);						
		break;
		case 'settings5':
			element="#calculator_express-dostavka_main5";
			$('#calculator_express-dostavka_main6').hide();
			$('#calculator_express-dostavka_main6').html('');
//1			alert(page);
		break;
		case 'settings6':
			element="#calculator_express-dostavka_main6";
//1			alert(page);
		break;
	}
	//alert(page);
	$.ajax
	({
		type: "GET",
//		url: "/express-dostavka/calculator/main.php",
		url: "/main.php",
		data: page,
		cache: false,
		dataType: "json",
        success: function(data) {
				$(element).html(data.calculator);
				if(data.calculator!=null) $(element).addClass('block');
				$(element).fadeIn( "slow" );
				//alert(data.calculator);
		}
	});	
}
function StaticLoadSettings(page) {		
//	alert(page);
	$.ajax
	({
		type: "GET",
//		url: "/express-dostavka/calculator/main.php",
		url: "/main.php",
		data: page,
		cache: false,
		dataType: "json",
        success: function(data) {
				$("#calcualtor_express-dostavka_main").html(data.settings);
				if(data.settings!=null) $("#calcualtor_express-dostavka_main").addClass('block');
				//alert(data.social);
		}
	});	
}

function StaticLoadCalc(page) {		
//	alert(page);
	$.ajax
	({
		type: "GET",
//		url: "/express-dostavka/calculator/main.php",
		url: "/main.php",
		data: page,
		cache: false,
		dataType: "json",
        success: function(data) {
				$("#calculator_result").html(data.result);
				if(data.result!=null) $("#calculator_result").addClass('block');
				//alert(data.social);
		}
	});	
}
function StaticLoadOrder(page) {		
//	alert(page);
	$.ajax
	({
		type: "GET",
//		url: "/express-dostavka/calculator/main.php",
		url: "/main.php",
		data: page,
		cache: false,
		dataType: "json",
        success: function(data) {
				$("#calculator_order").html(data.order);
				if(data.order!=null) $("#calculator_order").addClass('block');
				//alert(data.social);
		}
	});	
}
function StaticLoadConfirm(page) {		
//	alert(page);
	$.ajax
	({
		type: "GET",
//		url: "/express-dostavka/calculator/main.php",
		url: "/main.php",
		data: page,
		cache: false,
		dataType: "json",
        success: function(data) {
				$("#calculator_confirm").html(data.confirm_order);
				if(data.confirm_order!=null) $("#calculator_confirm").addClass('block');
				//alert(data.social);
		}
	});	
}

$(document).ready(function() {
	$("#PopUp").hide();
	var page='type=view';
	StaticLoad('view',page);
});

$(function () {
    $(document).on('click', '#calculate-credit', function () {
		$("#calculator_settings").show();
		$("#calculator_credit").show();
		$("#calculator_result").show();
		$("#calculator_order").hide();
		$("#calculator_confirm").hide();		
		var calc = $(".calc").serialize();
		StaticLoadCalc('type=calc&'+calc);		
	});
});

$(function () {
    $(document).on('click', '#order-credit', function () {
		$("#calculator_credit").hide();
		$("#calculator_settings").hide();
		$("#calculator_result").hide();
		$("#calculator_order").show();
		$("#calculator_confirm").hide();		
		var calc = $(".calc").serialize();
		StaticLoadOrder('type=order&'+calc);		
	});
});
$(function () {
    $(document).on('click', '#back-order', function () {
		$("#calculator_credit").hide();
		$("#calculator_settings").hide();
		$("#calculator_result").hide();
		$("#calculator_order").show();
		$("#calculator_confirm").hide();		
	});
});
$(function () {
    $(document).on('click', '#confirm-order', function () {
		$("#calculator_credit").hide();
		$("#calculator_settings").hide();
		$("#calculator_result").hide();
		$("#calculator_order").hide();
		$("#calculator_confirm").show();
		var calc = $(".calc").serialize();
		StaticLoadConfirm('type=confirm&'+calc);		
	});
});



$(function () {
    $(document).on('click', '.tab-calc', function () {
		//$("#calculator_express-dostavka_main").show();
		var calc = $(".tab-calc").serialize();
		//alert(calc);
		StaticLoad('settings','type=settings&'+calc);		
		//alert(calc);
	});
});

$(function () {
    $(document).on('click', '.tab-calc-settings', function () {
		//$("#calculator_express-dostavka_main").show();
		var calc = $(".tab-calc-settings").serialize();
		//alert(calc);
		StaticLoad('settings2','type=settings2&'+calc);		
		//alert(calc);
	});
});

$(function () {
    $(document).on('click', '.tab-calc-settings2', function () {
		//$("#calculator_express-dostavka_main3").show();
		var calc = $(".tab-calc-settings2").serialize();
		//alert(calc);
		StaticLoad('settings3','type=settings3&'+calc);		
		//alert(calc);
	});
});

$(function () {
    $(document).on('click', '.tab-calc-settings3', function () {
		//$("#calculator_express-dostavka_main4").show();
		var calc = $(".tab-calc-settings3").serialize();
		//alert(calc);
		StaticLoad('settings4','type=settings4&'+calc);		
		//alert(calc);
	});
});

$(function () {
    $(document).on('click', '.tab-calc-settings4', function () {
		//$("#calculator_express-dostavka_main4").show();
		var calc = $(".tab-calc-settings4").serialize();
		//alert(calc);
		StaticLoad('settings5','type=settings5&'+calc);		
		//alert(calc);
	});
});

$(function () {
    $(document).on('click', '#result', function () {
		//$("#calculator_express-dostavka_main4").show();
		var calc = $(".tab-calc-settings5").serialize();
		//alert(calc);
		StaticLoad('settings6','type=settings6&'+calc);		
		//alert(calc);
	});
});