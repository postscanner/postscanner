var UINotific8 = function () {

    return {
        //main function to initiate the module
        init: function () {

            
                    $('#notific8_price').click(function(event) {
                        var settings = {
                                theme: 'teal', //$('#notific8_theme').val(),
                                sticky: true, //$('#notific8_sticky').is(':checked'),
                                horizontalEdge: 'top', //$('#notific8_pos_hor').val(),
                                verticalEdge: 'right', //$('#notific8_pos_ver').val(),
//								heading: 'Поле стоимость'//added
							},
                            $button = $(this);
/* set life time of the notification for not sticky mode                        
                        if (!settings.sticky) {
                            settings.life = $('#notific8_life').val();
                        }
*/
                        $.notific8('zindex', 11500);
                        $.notific8('В поле "СТОИМОСТЬ" введите страховую стоимость посылки', settings);
                        
                        $button.attr('disabled', 'disabled');
                        
                        setTimeout(function() {
                            $button.removeAttr('disabled');
                        }, 1000);

                    });

					
                    $('#notific8_from').click(function(event) {
                        var settings = {
                                theme: 'teal', //$('#notific8_theme').val(),
                                sticky: true, //$('#notific8_sticky').is(':checked'),
                                horizontalEdge: 'top', //$('#notific8_pos_hor').val(),
                                verticalEdge: 'right', //$('#notific8_pos_ver').val(),
							},
                            $button = $(this);
                        
                        $.notific8('zindex', 11500);
                        $.notific8('В поле "ОТКУДА" начните вводить название города отправления и выберите нужный из списка', settings);
                        
                        $button.attr('disabled', 'disabled');
                        
                        setTimeout(function() {
                            $button.removeAttr('disabled');
                        }, 1000);

                    });

                    $('#notific8_to').click(function(event) {
                        var settings = {
                                theme: 'teal', //$('#notific8_theme').val(),
                                sticky: true, //$('#notific8_sticky').is(':checked'),
                                horizontalEdge: 'top', //$('#notific8_pos_hor').val(),
                                verticalEdge: 'right', //$('#notific8_pos_ver').val(),
							},
                            $button = $(this);

                        $.notific8('zindex', 11500);
                        $.notific8('В поле "КУДА" начните вводить название города назначения и выберите нужный из списка', settings);
                        
                        $button.attr('disabled', 'disabled');
                        
                        setTimeout(function() {
                            $button.removeAttr('disabled');
                        }, 1000);

                    });


                    $('#notific8_weight').click(function(event) {
                        var settings = {
                                theme: 'teal', //$('#notific8_theme').val(),
                                sticky: true, //$('#notific8_sticky').is(':checked'),
                                horizontalEdge: 'top', //$('#notific8_pos_hor').val(),
                                verticalEdge: 'right', //$('#notific8_pos_ver').val(),
							},
                            $button = $(this);

                        $.notific8('zindex', 11500);
                        $.notific8('В поле "ВЕС" введите ориентировочную массу посылки в килограммах', settings);
                        
                        $button.attr('disabled', 'disabled');
                        
                        setTimeout(function() {
                            $button.removeAttr('disabled');
                        }, 1000);

                    });
					
                    $('#notific8_size_1').click(function(event) {
                        var settings = {
                                theme: 'teal', //$('#notific8_theme').val(),
                                sticky: true, //$('#notific8_sticky').is(':checked'),
                                horizontalEdge: 'top', //$('#notific8_pos_hor').val(),
                                verticalEdge: 'right', //$('#notific8_pos_ver').val(),
							},
                            $button = $(this);

                        $.notific8('zindex', 11500);
                        $.notific8('В полях "ДЛИНА", "ШИРИНА" и "ВЫСОТА" введите размеры посылки в сантиметрах', settings);
                        
                        $button.attr('disabled', 'disabled');
                        
                        setTimeout(function() {
                            $button.removeAttr('disabled');
                        }, 1000);

                    });
                    $('#notific8_size_2').click(function(event) {
                        var settings = {
                                theme: 'teal', //$('#notific8_theme').val(),
                                sticky: true, //$('#notific8_sticky').is(':checked'),
                                horizontalEdge: 'top', //$('#notific8_pos_hor').val(),
                                verticalEdge: 'right', //$('#notific8_pos_ver').val(),
							},
                            $button = $(this);

                        $.notific8('zindex', 11500);
                        $.notific8('В полях "ДЛИНА", "ШИРИНА" и "ВЫСОТА" введите размеры посылки в сантиметрах', settings);
                        
                        $button.attr('disabled', 'disabled');
                        
                        setTimeout(function() {
                            $button.removeAttr('disabled');
                        }, 1000);

                    });
                    $('#notific8_size_3').click(function(event) {
                        var settings = {
                                theme: 'teal', //$('#notific8_theme').val(),
                                sticky: true, //$('#notific8_sticky').is(':checked'),
                                horizontalEdge: 'top', //$('#notific8_pos_hor').val(),
                                verticalEdge: 'right', //$('#notific8_pos_ver').val(),
							},
                            $button = $(this);

                        $.notific8('zindex', 11500);
                        $.notific8('В полях "ДЛИНА", "ШИРИНА" и "ВЫСОТА" введите размеры посылки в сантиметрах', settings);
                        
                        $button.attr('disabled', 'disabled');
                        
                        setTimeout(function() {
                            $button.removeAttr('disabled');
                        }, 1000);

                    });
					
			},
        alert: function (message) {
            var settings = {
                    theme: 'ruby', //$('#notific8_theme').val(),
                    sticky: true, //$('#notific8_sticky').is(':checked'),
                    horizontalEdge: 'top', //$('#notific8_pos_hor').val(),
                    verticalEdge: 'right', //$('#notific8_pos_ver').val(),
                },
                $button = $(this);

            $.notific8('zindex', 11500);
            $.notific8(message, settings);
        },
        removeAll: function () {
            $('.jquery-notific8-notification').remove()
        }

    };

}();