/**
 * Created by crojas on 2/15/18.
 */

let FormValidator = {

    params : null,

    validate: function (params) {
        this.params = params;

        let errors = [];

        params.required_fields.forEach( function (field) {

            let mFieldElem = $("#" + field.id);
            let mFieldElemValue = this.trim(mFieldElem.val());

            mFieldElem.closest('.form-group').removeClass('has-error');

            if (mFieldElem == null) {

                errors.push(field);

            } else {

                // first, check if it's not empty
                if (mFieldElemValue === "") {

                    errors.push(field);

                } else {

                    // seek for "type" property
                    if (field.hasOwnProperty('type')) {

                        switch (field.type) {

                            case "email" :

                                if (!FormValidator.validateEmail(mFieldElemValue)) {
                                    errors.push(field);
                                }

                                break;

                            case "password" :

                                if (!FormValidator.validatePassword()) {
                                    errors.push(field);
                                }

                                break;

                            // ...

                            default :
                                break;

                        }
                    }

                    // seek for "equalsTo" property
                    if (field.hasOwnProperty('equalsTo')) {

                        let mSecondPropertyValue = FormValidator.trim($("#" + field.equalsTo).val());

                        if (mFieldElemValue !== mSecondPropertyValue) {
                            errors.push(field);
                        }
                    }
                }
            }
        });

        if (errors.length > 0) {

            this.showMessage(errors);
            return false;
        }

        return true;
    },

    showMessage : function (errors) {

        let errorElement = $("#" + this.params.error_element_id);
        let messages = '<ul>';

        errors.forEach(function (field) {

            let mFieldElement = $("#" + field.id);
            mFieldElement.closest('.form-group').addClass('has-error');

            messages += '<li>' + field.message + '</li>';
        });

        messages += '</ul>';

        errorElement.html('');
        errorElement.append('<div class=\"alert alert-' + this.params.message_type + ' alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button> ' + messages + '</div>');

        this.closeAlert();
        this.resetButton();
    },

    resetButton : function () {

        let button_id = this.params.button_id;
        setTimeout(function(){ $("#" + button_id).button('reset'); }, 100);
    },

    closeAlert : function () {
            $(".alert").fadeOut(10000);
    },

    validateEmail : function (address) {


        let regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

        return regex.test(address);
    },

    trim(s) {
        return s.replace(/^\s+/g,'').replace(/\s+$/g,'');
    }
};