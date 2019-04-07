<?php

$tipo = $data->getProperty('tipo');
?>

<div class="main-content">

    <div class="main-content-inner">

        <div class="page-content">

            <!-- PAGE HEADER -->
            <div class="page-header">
                <h1>
                    Tipos de libros
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Modifique los campos de tipo de libro
                    </small>
                </h1>
            </div>
            <!-- PAGE HEADER FIN -->
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <div id="error"></div>
                    <form id="frm-tipo" accept-charset="utf-8" autocomplete="off" method="post" enctype="multipart/form-data">
                        <fieldset>

                            <input type="hidden" id= "id" name="id" value="<?php echo $tipo->getId()?>">

                              <div class="col-lg-12">
                                    <label for="descripcion">Descripcion de Tipo<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                                        <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripcion del tipo de libro" value="<?php echo $tipo->getTipo_descripcion()?>">
                                    </div>
                                </div>
                                  <br>
                           
                         
                            <div class="row">
                                <div class="col-xs-12"><span class="text-danger">(*) Campos requeridos</span></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-md-4 col-lg-4">
                                    <button id="btn-modify" class="btn btn-sm btn-block btn-success" data-loading-text="<span class='glyphicon glyphicon-asterisk rotate'></span> Modificando tipo de libro"><span class="fa fa-plus-circle"></span> Modificar </button>
                                </div>

                                <div class="col-xs-4 col-md-4 col-lg-4">
                                    <button id="btn-delete" class="btn btn-sm btn-block btn-warning" data-loading-text="<span class='glyphicon glyphicon-asterisk rotate'></span> Eliminando tipo de libro"><span class="fa fa-minus-circle"></span> Eliminar </button>
                                </div>

                                <div class="col-xs-4 col-md-4 col-lg-4">
                                    <button id="cancel" onclick="window.location='<?php echo URL . $data->getListURL()?>';return false;" class="btn btn-sm btn-block  btn-danger"><span class="fa fa-times-circle"></span> Cancelar</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                    <!-- PAGE CONTENT ENDS -->
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo URL?>js/libs/sweet-alert/sweet-alert.min.js"></script>
<script src="<?php echo URL?>js/util.js"></script>
<script src="<?php echo URL?>js/libs/form_validator/FormValidator.js"></script>
<script src="<?php echo URL?>js/controller/tipos.js"></script>
<script>
    $(function() {
        $("#c_tipos").addClass('active open');
        $("#i_list_tipos").addClass('active');

        $("#btn-modify").click(function() {

            $(this).button('loading');
            modify();

            return false;
        });

        $("#btn-delete").click(function () {

            $(this).button('loading');

            removeTipo();

            return false;
        });
    });
</script>
