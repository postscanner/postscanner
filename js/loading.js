var Loading = function() {
    var suffix = '2718281828';
    var loading_id = "loading_" + suffix;
    return {
        init: function () {
            if (!jQuery) {
                return;
            }
            if ($('#loading_' + suffix).length > 0) {
                return;
            }
            $('body').prepend('<div id="' + loading_id + '" style="display: none">\
                                    <div class="page-spinner-bar" ng-spinner-bar="">\
                                        <div class="bounce1"></div>\
                                        <div class="bounce2"></div>\
                                        <div class="bounce3"></div>\
                                    </div>\
                                    <div class="blackout" style="height: 100%; width: 100%; z-index: 1000; display: block; position: fixed; background: rgb(0,0,0); opacity: 0.5;">\
                                    </div>\
                                </div>');
        },
        show: function () {
            $('#' + loading_id).find(".blackout").css('opacity', 0);
            $('#' + loading_id).show();
            $('#' + loading_id).find(".blackout").fadeTo("flow", 0.5);
        
        },
        hide: function () {
            $('#' + loading_id).hide();        
        }
    };
}();

$(document).ready(function () {
    Loading.init();
});