var RevosliderInit = function () {
    
    function fillXsData() {
        
        var title = $('#revolutionul .slide_title');
        var subtitle = $('#revolutionul .slide_subtitle');
        var desc = $('#revolutionul .slide_desc');
        subtitle.data('y', title.data('y') + title.height());
        
        $(desc[0]).data('y', subtitle.data('y') + subtitle.height() + 15); 
        
        for (var i = 1; i < desc.length; ++i) {
            var prev = $(desc[i - 1]);
            var cur = $(desc[i]);
            cur.data('y', prev.data('y') + prev.height());
        }  
        
        
        var x = $('#revolutionul>li>.revo-slider-xs-start, #revolutionul>li>.revo-slider-xs-start~div');
        
        $(x[0]).data('y', $(desc[desc.length - 1]).data('y') + $(desc[desc.length - 1]).height() + 15);
        
        var gap = 15;
        for (var i = 1; i < x.length; ++i) {
            var prev = $(x[i - 1]);
            var cur = $(x[i]);
            cur.data('x', '0');
            cur.data('y', prev.data('y') + prev.height() + gap);
        }
        return $(x[x.length - 1]).data('y') + $(x[x.length - 1]).height() + 55;
    }
    function initSlider() {
        /*
            note that data-width-lg and the same attributes 
            are not part of revo-slider plugin
        */
        var sz = SizeManager.getSize();
        var sizes = SizeManager.sizes;
        initSelect2();
        var adapriveDataProperties = [ 'x', 'y', 'width', 'height'];
        $.each($(".fullwidthabnner .caption, .fullwidthabnner"), function (i, el) {
            adapriveDataProperties.forEach(function (prop, j, arr) {
                if ($(el).data(prop + '-' + sz) !== undefined) {
                    $(el).data(prop, $(el).data(prop + '-' + sz));            
                } else if ($(el).data(prop + '-default') !== undefined) {
                    $(el).data(prop, $(el).data(prop + '-default'));                     
                } else {
                    var found = false;
                    for (var i = sizes.indexOf(sz) + 1; i < sizes.length && !found; ++i) {
                        if ($(el).data(prop + '-' + sizes[i]) !== undefined) {
                            $(el).data(prop, $(el).data(prop + '-' + sizes[i]));   
                            found = true;
                        }
                    }
                    for (var i = sizes.indexOf(sz) - 1; i >= 0 && !found; --i) {
                        if ($(el).data(prop + '-' + sizes[i]) !== undefined) {
                            $(el).data(prop, $(el).data(prop + '-' + sizes[i]));   
                            found = true;
                        }                    
                    }
                }
            });
        });
        if (sz == 'xs') {
            var height = fillXsData();
            $('.fullwidthabnner').data('height', height);
        }
        jQuery('.fullwidthabnner').show().revolution({ 
                          delay:2000,
                          startheight: $('.fullwidthabnner').data('height'),
                          startwidth: $('.fullwidthabnner').data('width'),
                          /*startheight: 417,
                          startwidth: 1150,*/

                          hideThumbs:10,

                          thumbWidth:100,                         // Thumb With and Height and Amount (only if navigation Tyope set to thumb !)
                          thumbHeight:50,
                          thumbAmount:5,

                          navigationType:"none",                // bullet, thumb, none
                          navigationArrows:"none",                // nexttobullets, solo (old name verticalcentered), none

                          navigationStyle:"round",                // round,square,navbar,round-old,square-old,navbar-old, or any from the list in the docu (choose between 50+ different item), custom

                          navigationHAlign:"center",              // Vertical Align top,center,bottom
                          navigationVAlign:"bottom",              // Horizontal Align left,center,right
                          navigationHOffset:0,
                          navigationVOffset:20,

                          soloArrowLeftHalign:"left",
                          soloArrowLeftValign:"center",
                          soloArrowLeftHOffset:20,
                          soloArrowLeftVOffset:0,

                          soloArrowRightHalign:"right",
                          soloArrowRightValign:"center",
                          soloArrowRightHOffset:20,
                          soloArrowRightVOffset:0,

                          touchenabled:"off",                      // Enable Swipe Function : on/off
                          onHoverStop:"off",                       // Stop Banner Timet at Hover on Slide on/off

                          stopAtSlide:-1,
                          stopAfterLoops:-1,

                          hideCaptionAtLimit:0,         // It Defines if a caption should be shown under a Screen Resolution ( Basod on The Width of Browser)
                          hideAllCaptionAtLilmit:0,       // Hide all The Captions if Width of Browser is less then this value
                          hideSliderAtLimit:0,          // Hide the whole slider, and stop also functions if Width of Browser is less than this value

                          shadow:1,                               //0 = no Shadow, 1,2,3 = 3 Different Art of Shadows  (No Shadow in Fullwidth Version !)
                          fullWidth:"off",                          // Turns On or Off the Fullwidth Image Centering in FullWidth Modus
                      });
    }
    
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
    return {
        initRevoSlider: function () {
                initSlider();
                jQuery(window).resize(function () {
                    initSlider();
                });
        }
    };   
    

}();