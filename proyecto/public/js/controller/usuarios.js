/**
 * Created by crojas on 2/15/18.
 */

let rules = {
    button_id : "btn-add",
    error_element_id : "error",
    message_type : "danger",

    required_fields : [
        {
            id : "nombres",
            message : "Debe ingresar un nombre."
        },
        {
            id : "apellidos",
            message : "Debe ingresar un apellido."
        },
        {
            id : "usuario",
            message : "Debe ingresar un un identificador para el usuario.",
        },
        {
            id : "pass1",
            message : "Debe ingresar una contraseña."
        },
        {
            id : "pass2",
            message : "Las contraseñas deben ser iguales.",
            equalsTo: "pass1"
        }
    ]
};


function add() {

    if (!FormValidator.validate(rules)) return false;

    $.ajax({
        url: ROOT_FOLDER + "usuarios/add/",
        type: 'POST',
        data: $("form#frm-user-add").serialize(),
        dataType: "json"
    })
        .done(function(data, textStatus, jqXHR) {

            if(data.status === RequestStatus.OK) {

                swal(
                    {
                        title: 'Mensaje',
                        text: '¡Usuario registrado correctamente!',
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Aceptar',
                        closeOnConfirm: true
                    },
                    function(isConfirm) {
                        window.location = ROOT_FOLDER + "usuarios/list";
                    }
                );

            } else {

                showCustomMessage(data.response, 'danger');
                $("form#frm-user-add").trigger('reset');
            }

        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            showCustomMessage(errorThrown, "danger");
            $("form#frm-user-add").trigger('reset');
        })
}

function modify() {

    let rules = {
        button_id : "btn-modify",
        error_element_id : "error",
        message_type : "danger",

        required_fields : [
            {
                id : "user_id",
                message : "El identificador del usuario no es válido. Por favor, recargá la página y volvé a intentar."
            },
            {
                id : "nombres",
                message : "Debe ingresar un nombre."
            },
            {
                id : "apellidos",
                message : "Debe ingresar un apellido."
            },
            {
                id : "usuario",
                message : "Debe ingresar un identificador para el usuario.",
            }
        ]
    };

    if (!FormValidator.validate(rules)) return false;

    $.ajax({
        url: ROOT_FOLDER + "usuarios/modify/",
        type: 'POST',
        data: $("form#frm-user-edit").serialize(),
        dataType: "json"
    })
        .done(function(data, textStatus, jqXHR) {

            if(data.status === RequestStatus.OK) {

                swal(
                    {
                        title: 'Mensaje',
                        text: '¡Usuario modificado correctamente!',
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Aceptar',
                        closeOnConfirm: true
                    },
                    function(isConfirm) {
                        window.location = ROOT_FOLDER + "usuarios/list";
                    }
                );

            } else {

                showCustomMessage(data.response, 'danger');
                resetButton('btn-modify');
            }

        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            showCustomMessage(errorThrown, "danger");
            $("#frm-user-edit").trigger('reset');
        })
}

function confirmUserBlocking() {

    swal(
        {
            title: 'Atención!',
            text: 'Estás a punto de bloquear un usuario. ¿Querés continuar?',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonColor: "#DD6B55",
            confirmButtonText: 'Si, estoy seguro',
            closeOnConfirm: true
        },
        function(isConfirm) {

            if(isConfirm) {

                blockUser();

            } else {
                resetButton('btn-delete');
            }
        }
    );
}

function blockUser() {

    let rules = {
        button_id : "btn-modify",
        error_element_id : "error",
        message_type : "danger",

        required_fields : [
            {
                id : "user_id",
                message : "El identificador del usuario no es válido. Por favor, recargá la página y volvé a intentar."
            }
        ]
    };

    if (!FormValidator.validate(rules)) return false;

    console.log("form validator passed!");

    $.ajax({
        url: ROOT_FOLDER + "usuarios/remove/",
        type: 'POST',
        data: $("#frm-user-edit").serialize(),
        dataType: "json"
    })
        .done(function(data, textStatus, jqXHR) {

            if(data.status === RequestStatus.OK) {

                setTimeout(function() {
                    swal(
                        {
                            title: 'Mensaje',
                            text: '¡Usuario bloqueado correctamente!',
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Aceptar',
                            closeOnConfirm: true
                        },
                        function (isConfirm) {
                            window.location = ROOT_FOLDER + "usuarios/list";
                        }
                    );
                }, 1000);

            } else {

                showCustomMessage(data.response, 'danger');
                $("form#frm-user-add").trigger('reset');
            }

        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            showCustomMessage(errorThrown, "danger");
        })
}

function showCustomMessage(msg, alerttype) {

    $("#error").html('<div class=\"alert alert-' + alerttype + ' alert-dismissable\" style=\"text-align:center\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><strong>&iexcl;Atenci&oacute;n!</strong> ' + msg + '</div>');

    $(".alert").fadeOut(10000);

    setTimeout(function(){ $("#btn-add").button('reset'); }, 100);
}