var SizeManager = function () {
    return {
        sizes: [ 'xs', 'sm', 'md', 'lg' ],
        getSize: function() {
            var width = $(window).width();
            if (width >= 1200) {
                return 'lg';
            }
            if (width >= 992) {
                return 'md';
            }
            if (width >= 850) {
                return 'sm';
            }
            return 'xs';
        },
        is_Xs: function () {
            return this.getSize() == 'xs';
        }
        
    }
}();