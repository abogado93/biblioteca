let rules = {
    button_id : "btn-add",
    error_element_id : "error",
    message_type : "danger",

    required_fields : [
        {
            id : "descripcion",
            message : "Ingrese una descripcion."
        }
    ]
};

function add() {

    if (!FormValidator.validate(rules)) return false;

    let data = $("#frm-tipo").serializeArray();

    $.ajax({
        url: ROOT_FOLDER + "tipos/add/",
        type: 'POST',
        data : data,
        dataType: "json"
    })
        .done(function(data) {

            if(data.status === RequestStatus.OK) {
                swal(
                    {
                        title: 'Mensaje',
                        text: '¡tipo de libro registrado correctamente!',
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Aceptar',
                        closeOnConfirm: true
                    },
                    function (isConfirm) {
                        window.location = data.response;
                    }
                );
            } else if (data.status === RequestStatus.DUPLICATE_KEY) {
                setMensaje(data.response);
            } else {

                setMensaje(data.response);
                resetButton("btn-add");
            }

        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
            setMensaje(errorThrown);
        })
}

function modify() {

    if (!FormValidator.validate(rules)){
        resetButton("btn-modify");
        return false;
    }


    let data = $("#frm-tipo").serializeArray();

    $.ajax({
        url: ROOT_FOLDER + "tipos/modify/",
        type: 'POST',
        data: data,
        dataType: "json"
    })
        .done(function(data) {
            console.log("data: " + data);
            if(data.status === RequestStatus.OK) {
                swal(
                    {
                        title: 'Mensaje',
                        text: '¡tipo de Libro actualizado correctamente!',
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Aceptar',
                        closeOnConfirm: true
                    },
                    function(isConfirm) {
                        window.location = ROOT_FOLDER + "tipos/list";
                    }
                );

            } else {

                setMensaje(data.response);
                resetButton("btn-modify");
            }

        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
            setMensaje(errorThrown);
        })
}

function remove() {

    if(trim($("#id").val()) == "") {
        setMensaje('¡Idenfitificador no válido!');
        return false;
    }

    $.ajax({
        url: ROOT_FOLDER + "tipos/remove/",
        type: 'POST',
        data: $("#frm-tipo").serialize(),
        dataType: "json"
    })
        .done(function(data) {
            console.log("data: " + data);
            if(data.status === RequestStatus.OK) {

                setTimeout(function() {

                    swal({
                        title: "Mensaje",
                        text: "¡tipo de Libro eliminado correctamente!!",
                        type: "success",
                        showConfirmButton: true

                    }, function() {
                        window.location =ROOT_FOLDER + "tipos/list";
                    });

                }, 500);

            } else {
                if(data.status === RequestStatus.DATABASE_ERROR) {
                    setMensaje("No se puede eliminar tabla porque tiene referencia a otras tablas");
                }  else {
                    setMensaje(data.response);
                }
                resetButton("btn-delete");
            }

        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
            setMensaje(errorThrown);
        })
}

function removeTipo() {

    swal(
        {
            title: 'Atención!',
            text: 'Estás a punto de eliminar un tipo de libro. ¿Querés continuar?',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonColor: "#DD6B55",
            confirmButtonText: 'Si, estoy seguro',
            closeOnConfirm: true
        },
        function(isConfirm) {

            if(isConfirm) {

                console.log("removing tipo de libro...");

                remove();

            } else {
                resetButton('btn-delete');
            }
        }
    );

}

function setMensaje(msg)
{
    if(!msg)
    {
        $("#error").html('<div class=\"alert alert-danger alert-dismissable\" style=\"text-align:center\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><strong>Atenci&oacute;n!</strong>  Por favor, complete los campos obligatorios</div>');
        closeAlert();
    } else {
        $("#error").html('<div class=\"alert alert-danger alert-dismissable\" style=\"text-align:center\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><strong>&iexcl;Atenci&oacute;n!</strong> ' + msg + '</div>');
        closeAlert();
    }
}

function closeAlert()
{
    $(".alert").fadeOut(10000);
}