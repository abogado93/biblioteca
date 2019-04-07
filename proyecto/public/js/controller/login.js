function login() {
    if(trim($("#usuario").val()) == "") {
        setMensaje('Por favor, ingrese un nombre de usuario');
        return false;
    }

    if(trim($("#password").val()) == "") {
        setMensaje('Por favor, ingrese la contrase&ntilde;a');
        return;
    }

    $.ajax({
        url: ROOT_FOLDER + "auth/login",
        type: 'POST',
        data: $("form").serialize(),
        dataType: "json"
    })
        .done(function(data) {

            console.log("data: " + data);

            if(data.status == RequestStatus.OK) {

                window.location = ROOT_FOLDER + data.response;

            } else {
                setMensaje(data.response);
            }

        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
            setMensaje(errorThrown);
        })
}

function setMensaje(msg) {
    if(!msg) {
        $("#error").html('<div class=\"alert alert-danger alert-dismissable\" style=\"text-align:center\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><strong>Atenci&oacute;n!</strong>  Por favor, complete los campos obligatorios</div>');
        closeAlert();
    } else {
        $("#error").html('<div class=\"alert alert-danger alert-dismissable\" style=\"text-align:center\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><strong>&iexcl;Atenci&oacute;n!</strong> ' + msg + '</div>');
        closeAlert();
    }

    setTimeout(function(){ $("#btn-login").button('reset'); }, 100);
}

function trim (s) {
    return s.replace(/^\s+/g,'').replace(/\s+$/g,'');
}

function closeAlert() {
    $(".alert").fadeOut(10000);
}