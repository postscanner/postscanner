/* ***** Search City ***** */
/* *********************** */


/* JS File */

function CityLoad(temp01, temp02, temp03) {
	var temp1=$(temp01).val();
	var temp2=$(temp02).val();
	var temp3=$(temp03).serialize();

	if(temp1!=''&&temp1!='Город не найден.'&&temp2!=''&&temp2!='Город не найден.') {
		var calc='city1='+temp1+'&city2='+temp2;
		calc=calc+'&'+temp3+'&order-type=order-intercity';
		StaticLoad('settings4','type=settings4&'+calc);
	}
}

$(document).on('click', '#results1', function(){
	var temp=$(this).text();
	if(temp!='Города нет в списке, продолжить?!') {
		$('input#search1').val(temp);
		$('input#search1').addClass('checked');
		$("ul#results1").fadeOut();
		$('h4#results-text1').fadeOut();
	}
	else {
		$('input#search1').addClass('checked');		
		$("ul#results1").fadeOut();
		$('h4#results-text1').fadeOut();		
	}
	CityLoad('input#search1','input#search2','.tab-calc-settings3');	
});


// Start Ready
$(document).ready(function() {  

	// Icon Click Focus
	$('div.icon').click(function(){
		$('input#search1').focus();
	});
	
	// Live Search
	// On Search Submit and Get Results
	function search() {
		var query_value = $('input#search1').val();
		$('b#search-string1').html(query_value);
		if(query_value !== ''){
			var page='type=search_city&block=1&city='+query_value;
			//alert(page);
			$.ajax
			({
				type: "GET",
//				url: "/main.php",
				url: "/main.php",
				data: page,
				cache: false,
				dataType: "json",
				success: function(data){
					$("ul#results1").html(data.calculator);
				}
			});	
		}return false;    
	}

	$("input#search1").on("keyup", function(e) {
		$("input#search1").removeClass('checked');
		// Set Timeout
		clearTimeout($.data(this, 'timer'));

		// Set Search String
		var search_string = $(this).val();

		// Do Search
		if (search_string == '') {
			$("ul#results1").fadeOut();
			$('h4#results-text1').fadeOut();
		}else{
			$("ul#results1").fadeIn();
			$('h4#results-text1').fadeIn();
			$(this).data('timer', setTimeout(search, 100));
		};
	});

});



/* JS File */

$(document).on('click', '#results2', function(){
	var temp=$(this).text();
	if(temp!='Города нет в списке, продолжить?!') {	
		$('input#search2').val(temp);
		$('input#search2').addClass('checked');
		$("ul#results2").fadeOut();
		$('h4#results-text2').fadeOut();
	}
	else {
		$('input#search2').addClass('checked');		
		$("ul#results2").fadeOut();
		$('h4#results-text2').fadeOut();		
	}
	CityLoad('input#search1','input#search2','.tab-calc-settings3');
});

// Start Ready
$(document).ready(function() {  

	// Icon Click Focus
	$('div.icon').click(function(){
		$('input#search2').focus();
	});
	
	// Live Search
	// On Search Submit and Get Results
	function search() {
		var query_value = $('input#search2').val();
		$('b#search-string2').html(query_value);
		if(query_value !== ''){
			var page='type=search_city&block=2&city='+query_value;
			$.ajax
			({
				type: "GET",
				url: "/main.php",
				data: page,
				cache: false,
				dataType: "json",
				success: function(data){
					$("ul#results2").html(data.calculator);
				}
			});	
		}return false;    
	}

	$("input#search2").on("keyup", function(e) {
		$("input#search2").removeClass('checked');
		// Set Timeout
		clearTimeout($.data(this, 'timer'));

		// Set Search String
		var search_string = $(this).val();

		// Do Search
		if (search_string == '') {
			$("ul#results2").fadeOut();
			$('h4#results-text2').fadeOut();
		}else{
			$("ul#results2").fadeIn();
			$('h4#results-text2').fadeIn();
			$(this).data('timer', setTimeout(search, 100));
		};
	});

});

/* *********************** */
/* ***** Search City ***** */