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

    //== Public Functions
    return {
        // public functions
        init: function() {
            handleForms();
        }
    };
}(jQuery);

//== Class Initialization
jQuery(document).ready(function() {
    HostingManager.init();
});
