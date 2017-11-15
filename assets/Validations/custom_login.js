
/*
Author : Agaile
13/09/2016
Custom login validation script
*/

var Login = function () {

    var runLoginValidator = function () {
        var form = $('#loginform');
        var errorHandler = $('.errorHandler', form);
        form.validate({
            rules: {
                username: {
                    minlength: 2,
                    required: true
                },
                password: {
                    minlength: 6,
                    maxlength: 15,
                    required: true
                }
            },
            submitHandler: function (form) {
                errorHandler.hide();
                form.submit();
            },
            invalidHandler: function (event, validator) { //display error alert on form submit
                errorHandler.show();             
            }
        });
    };
    return {
        //main function to initiate template pages
        init: function () {
            runLoginValidator();
        }
    };
}();