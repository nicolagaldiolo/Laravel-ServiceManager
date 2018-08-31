
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//== Class Definition
var HostingManager = function($) {

    var general = function(){
        $('#m_inputmask_7').change(function(i){
            console.log(i);
        });

        $('.m_select2_4').select2();

        $('#m_datepicker_1').datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            format: "dd-mm-yyyy"
        });

        $('.cp_colorpicker').colorpicker({
            format: 'hex'
        });
    }

    return {
        init: function() {
            general();
        },
    };
}(jQuery);

//== Class Initialization
jQuery(document).ready(function() {
    HostingManager.init();
});
