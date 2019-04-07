let rules = {
    button_id : "btn-add",
    error_element_id : "error",
    message_type : "danger",

    required_fields : [
        {
            id : "fecha",
            message : "Ingrese una fecha."
        },
        {
            id : "multa",
            message : "Debe ingresar la multa."
        },
        {
            id : "monto",
            message : "Debe ingresar el monto."
        },
        {
            id : "prestamo",
            message : "Debe ingresar el prestamo."
          
        },
      
        {
            id : "estado",
            message : "Debe ingresar un estado."
        }
    ]
};

function add() {

    if (!FormValidator.validate(rules)) return false;

    let data = $("#frm-pago").serializeArray();

    $.ajax({
        url: ROOT_FOLDER + "pagos/add/",
        type: 'POST',
        data : data,
        dataType: "json"
    })
        .done(function(data) {

            if(data.status === RequestStatus.OK) {
                swal(
                    {
                        title: 'Mensaje',
                        text: 'Pago registrado correctamente!',
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


    let data = $("#frm-pago").serializeArray();

    $.ajax({
        url: ROOT_FOLDER + "pagos/modify/",
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
                        text: '¡pago actualizado correctamente!',
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Aceptar',
                        closeOnConfirm: true
                    },
                    function(isConfirm) {
                        window.location = ROOT_FOLDER + "pagos/list";
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
        url: ROOT_FOLDER + "pagos/remove/",
        type: 'POST',
        data: $("#frm-pago").serialize(),
        dataType: "json"
    })
        .done(function(data) {
            console.log("data: " + data);
            if(data.status === RequestStatus.OK) {

                setTimeout(function() {

                    swal({
                        title: "Mensaje",
                        text: "¡pago eliminado correctamente!!",
                        type: "success",
                        showConfirmButton: true

                    }, function() {
                        window.location =ROOT_FOLDER + "pagos/list";
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

function removePago() {

    swal(
        {
            title: 'Atención!',
            text: 'Estás a punto de eliminar un pago. ¿Querés continuar?',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonColor: "#DD6B55",
            confirmButtonText: 'Si, estoy seguro',
            closeOnConfirm: true
        },
        function(isConfirm) {

            if(isConfirm) {

                console.log("removing pago...");

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