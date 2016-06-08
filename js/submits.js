jQuery(document).ready(function($) {
        
	$('body').on('click','.btn-zakaz', function (){
                        $('#tallModal').modal();
                        var weight = document.getElementById("weight").value;
                        var width = document.getElementById("width").value, height = document.getElementById("height").value, length = document.getElementById("length").value;
                        var volume = parseInt(height) * parseInt(width) * parseInt(length) * 1.0 / 1000000;
                        if (volume != volume) {
                            volume = 0;
                        }
                        volume=length+'x'+width+'x'+height;
                        var value = document.getElementById("value").value;
                        var toCity = $("#toCity").select2("data")["text"];
                        var fromCity = $("#fromCity").select2("data")["text"];                                                
                        //console.log('test');
                        //data-company='{$site->name}' data-comail='dmitriy.supov@gmail.com' data-conditon='$condition' data-srok='$srok' data-price='$pricecur' 
                        /*
                        <input type="hidden" name="compname"/>
                <input type="hidden" name="srok"/>
                <input type="hidden" name="price"/>
                <input type="hidden" name="condition"/>
                <input type="hidden" name="comail"/>
                        */
                      //  console.log('test');
                        $('.zak-description').html('<h4>Данные по заказу.</h4> Откуда: '+ fromCity + '. Куда: '+toCity + '. Вес: '+  weight +'кг. Размер (ДхШхВ): '+volume +'. <br>Стаховая стоимость: '+value+' руб.'+' Стоимость доставки: '+$(this).attr('data-price')+' руб. Срок: '+$(this).attr('data-srok')+'*.'+'<br>Служба доставки: '+$(this).attr('data-company')+'. <br>Тип доставки: '+$(this).attr('data-conditon')+'<br><br>')
                        $('.res_send_zak').html('');
                        $('#zak-form input[name=compname]').val($(this).attr('data-company'));
                        $('#zak-form input[name=srok]').val($(this).attr('data-srok'));
                        $('#zak-form input[name=price]').val($(this).attr('data-price'));
                        $('#zak-form input[name=condition]').val($(this).attr('data-conditon'));
                        $('#zak-form input[name=comail]').val($(this).attr('data-comail'));
                        
                        var description= ' Откуда: '+ fromCity + '.Куда: '+toCity + '. Вес: '+  weight +'кг. Размер (ДхШхВ): '+volume +'. <br>Стаховая стоимость: '+value+' руб. <br>'+'. Стоимость доставки: '+$(this).attr('data-price')+' руб. <br>Срок: '+$(this).attr('data-srok')+'*'+'<br>Служба доставки: '+$(this).attr('data-company')+'. <br>Тип доставки: '+$(this).attr('data-conditon');
                        $.ajax({
                            timeout: 20000,
                			type : "POST",
                			url : "ajax/counter.php",
                			data : "description=" + description
                		});
                        
                        
                    });	
     
	/* Tool tip */
	
	if( $.fn.tooltip() ) {
		$('[class="tooltip_hover"]').tooltip();
	}





	/* Carousel */

	// $(".carousel").jCarouselLite({
		// btnNext : ".next",
		// btnPrev : ".prev",
		// easing : "swing", 
		// vertical : true,
		// auto : 4000,
		// speed : 500,
		// visible : 3,
		// scroll : 1,
		// mouseWheel : true
	// });



	/* Contact form */	

	$("#contact").submit(function() {
		fromCity = document.getElementById("fromCity").value;
		toCity = document.getElementById("toCity").value;
		weight = document.getElementById("weight").value;
        volume = document.getElementById("volume").value;
        value = document.getElementById("value").value;
		$.ajax({
			type : "POST",
			url : "scripts/search.php",
			data : "from=" + fromCity + "&to=" + toCity + "&weight=" + weight + "&value=" + value,
			beforeSend : function() {
                Loading.show();
			},
			success : function(response) {
				alert(response);
				document.getElementById("response").innerHTML = response;
				$("#response").show();
				Loading.hide();
				$("#courses").hide();
				$("#newsletter").hide();
			}
		})
		return false;
	});

	
	


		
	/* Newsleter form */	

	$("#newsletter").submit(function() {
		$.ajax({
			type : "POST",
			url : "newsletter.php",
			dataType : "html",
			data : $(this).serialize(),
			beforeSend : function() {
				$("#loadingNews").show();
			},
			success : function(response) {
				$("#responseNews").html(response);
				$("#loadingNews").hide();
			}
		})
		return false;
	});




	/* Responsive Video */	

	//$(".video").fitVids();
	//$('input, textarea').placeholder();
	
	




	/* Slider */	
	
	// $('.bxslider').bxSlider({
	  // auto: true,
	// });
    
    
	$('#height,#width,#length,#value,#weight').keyup(function (e) {
        if (e.keyCode == '\r'.charCodeAt(0)) {
            search();
        }
    });
 

    $("#logout").click(function () {
        $.ajax({
            url: 'login.php',
            data: { action: 'logout' },
            type: 'POST',
            success: function () {
                location.reload();
            },
        });
    });
}); 

    function debug() {
        //body onload
        var fromCity = $("#fromCity").select2("data", {text: "Москва", id: "4400"});
        var toCity = $("#toCity").select2("data", {id: "4962", text: "Санкт-Петербург"});
        document.getElementById("height").value = document.getElementById("width").value
        = document.getElementById("length").value = document.getElementById("weight").value = document.getElementById("value").value = "1";
    }
    function strpos( haystack, needle, offset){	// Find position of first occurrence of a string
    	// 
    	// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    
    	var i = haystack.indexOf( needle, offset ); // returns -1
    	return i >= 0 ? i : false;
    }
    var firstModalClick=true;
    $("#sendRequest").click(search);
	function search() { 
        UINotific8.removeAll();
        try {
            var fromCity = $("#fromCity").select2("data")["text"];
        } catch (e) {
            var fromCity = "";
        }
        try {
            var toCity = $("#toCity").select2("data")["text"];
        } catch (e) {
            var toCity = '';
        }
//		fromCity = document.getElementById("from").value;
//		toCity = document.getElementById("to").value;
		var weight = document.getElementById("weight").value;
        $('.city-from').html(fromCity);
        $('.city-to').html(toCity);
        $('.weight').html(weight);
        
        var width = document.getElementById("width").value, height = document.getElementById("height").value, length = document.getElementById("length").value;
        var volume = parseInt(height) * parseInt(width) * parseInt(length) * 1.0 / 1000000;
        if (volume != volume) {
            volume = 0;
        }
        
        var value = document.getElementById("value").value;
        
        function validateForm () {
            var valid = true;
            if (fromCity == "") {
                //UINotific8.alert('Город отправления не введён');
                valid = false;
            }
            if (toCity == "") {
               // UINotific8.alert('Город назначения не введён');
                valid = false;
            }

            var onlyDigits = function (str) {
                var isSeparatorDetected = false;
                for (var i = 0; i < str.length; ++i) {
                    if (!(((str[i] == '.') || (str[i] == ',')) && !isSeparatorDetected || str[i] >= '0' && str[i] <= '9')) {
                        return false;
                    }
					if (str[i]==',') {
						str[i] = '.';
					}
                    isSeparatorDetected = isSeparatorDetected || str[i] == '.' || str[i] == ',';
                }
                return true;
            }            
            //$('#sendRequest').popover('hide');
            if (!onlyDigits(weight) ) {
                //UINotific8.alert('Вес указан некорректно');
                valid = false;
            } else if (weight.length == 0) {
			   // UINotific8.alert('Введите, пожалуйста, вес посыкли');
                valid = false;
			}
						
			
            if (!onlyDigits(length)) {
               // UINotific8.alert('Длина посылки указана некорректно');
                valid = false;
            } else if (length.length == 0) {
			    //UINotific8.alert('Введите, пожалуйста, длину посыкли');
                valid = false;
			} 
            if (!onlyDigits(width)) {
                //UINotific8.alert('Ширина посылки указана некорректно');
                valid = false;
            }  else if (width.length == 0) {
			    //UINotific8.alert('Введите, пожалуйста, ширину посыкли');
                valid = false;
			} 
            if (!onlyDigits(height)) {
                //UINotific8.alert('Высота посылки указана некорректно');
                valid = false;
            } else if (height.length == 0) {
			   // UINotific8.alert('Введите, пожалуйста, высоту посыкли');
                valid = false;
			} 
			
            if (!onlyDigits(value)) {
                //UINotific8.alert('Страховая стоимость посылки указана некорректно');
                valid = false;
            }  else if (value.length == 0) {
			    //UINotific8.alert('Введите, пожалуйста, страховую стоимость посылки');
                valid = false;
			}
			if (!valid)
            {
                $('#sendRequest').popover('show');
                setTimeout("$('#sendRequest').popover('hide');", 4000)
                
                
            }
            return valid;
        }
//        alert(volume);
        var sendButton = $("#sendRequest");
        sendButton.attr('disabled', 'disabled');        
        setTimeout(function() {
            sendButton.removeAttr('disabled');
        }, 1000);
        var queryButtonText = sendButton.html();
        
        var refreshInterface = function () {            
            sendButton.html(queryButtonText)
                        .find("i").addClass("fa-envelope-o fa margin-right-10").removeClass("fa-refresh");
            Loading.hide();
        };
        
        if (!validateForm()) {
            return false;
        }
        var dataShip="from=" + fromCity + "&to=" + toCity + "&weight=" + weight + "&volume=" + volume + "&value=" + value+ "&length=" + length+ "&width=" + width+ "&height=" + height;
		$('#response-new  .table-res tbody').html('');
        $('#response-new .comp_sel').html('<option selected="selected">Все</option>');
        var first_resp=true;
        var orgId=1;
        var ajCnt=1;
        $('.page-content .progress-bar_').removeClass('hidden');
        /*for (orgId=1; orgId<=22; orgId++)
        {
            if (orgId==15||orgId==16||orgId==20)
                continue;
        }*/
        loadData();
        function loadData()
        {
            if (orgId==15||orgId==16||orgId==20)
            {
                orgId++;
                loadData();
                return;
            }
            $.ajax({
                timeout: 20000,
    			type : "POST",
    			url : "scripts/search.php",
    			data : "from=" + fromCity + "&to=" + toCity + "&weight=" + weight + "&volume=" + volume + "&value=" + value+"&orgId="+orgId+ "&length=" + length+ "&width=" + width+ "&height=" + height,
    			beforeSend : function() {
                    //Loading.show();
                    
                    sendButton.html(queryButtonText.replace('Отправить запрос', 'Обработка запроса'))
                                .find("i").removeClass("fa-envelope").addClass("fa-refresh");
    			},
    			success : function(response) {
    			     ajCnt++;
                     orgId++;
    				//alert(response);
                    //ceiling performed on search.php
                    $('#response-new .table-res tbody').html($('#response-new .table-res tbody').html()+response);
                    if (first_resp)
                    {
                        first_resp=false;
                        $('html,body').stop().animate({ scrollTop: $('.progress-bar_').offset().top }, 1000);
                      // TableAdvanced.init();
                    }
                    var compName=$(response).find('.btn-zakaz').attr('data-company');
                    //console.log(compName);
                    if (compName!==undefined)
                        $('#response-new .comp_sel').html($('#response-new .comp_sel').html()+'<option selected="selected" value="'+compName+'">'+compName+'</option>');
                    //$('#response-new .table-res tbody').html($('#response-new .table-res tbody').html()+response);
                    $('#response').html($('#response-new').html());
                    $('#response #sample_4').attr('id','sample_3');                
                    TableAdvanced.init();              
    				/*document.getElementById("response").innerHTML = response;
    				
                    if )
                    TableAdvanced.init();
                    
    				$("#courses").hide();
    				$("#newsletter").hide();
                    $(".hide-on-request-performed").hide();*/
                    refreshInterface();
                    /*$("html,body").animate({ 
                                        scrollTop: $("#response").offset().top,
                                    }, "slow");*/
                    //$('.btn-zakaz').modal();
                    //if (firstModalClick)
                    //{
                   //     $('.btn-zakaz').last().click();
                  //      firstModalClick=false;
                  //  }
                    var width=Math.round(orgId*(100/23));
                    $('.progress-bar_').children('span').css('width',width+'%');
                    //ajCnt++;
                    if (orgId>=23)
                         $('.progress-bar_').addClass('hidden');
                    //console.log('testload');
                    if (orgId<=22)
                        loadData();
    			},
                error : function() {
                    ajCnt++;
                    orgId++;
                    if (orgId>=23)
                        $('.progress-bar_').addClass('hidden');
                    console.log('testload');
                    if (orgId<=22)
                        loadData();
                    //alert("Произошла ошибка");
                   // refreshInterface();
                }
    		});
        }
		return false;
	}