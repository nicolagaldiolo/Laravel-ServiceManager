
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('bootstrap-colorpicker');


//== Class Definition
var HostingManager = function($) {

    var handleForms = function(){

        $.validator.addClassRules({
            password: {
                required: true,
                minlength: 6
            }
        });

        $.validator.addClassRules({
            password_confirm: {
                equalTo: '[name="password"]'
            }
        });

        $('.formValidate').validate();
    }

    var general = function(){
        $('#mycp').colorpicker();
    }

    //== Public Functions
    return {
        // public functions
        init: function() {
            handleForms();
            general();
        }
    };
}(jQuery);

//== Class Initialization
jQuery(document).ready(function() {
    HostingManager.init();
});
