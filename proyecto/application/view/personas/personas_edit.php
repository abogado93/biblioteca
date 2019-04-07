<?php

$persona = $data->getProperty('persona');
?>

<div class="main-content">

    <div class="main-content-inner">

        <div class="page-content">

            <!-- PAGE HEADER -->
            <div class="page-header">
                <h1>
                    PERSONAS
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Modifique los campos de la persona
                    </small>
                </h1>
            </div>
            <!-- PAGE HEADER FIN -->
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <div id="error"></div>
                    <form id="frm-persona" accept-charset="utf-8" autocomplete="off" method="post" enctype="multipart/form-data">
                        <fieldset>

                            <input type="hidden" id= "id" name="id" value="<?php echo $persona->getId()?>">

                              <div class="col-lg-12">
                                    <label for="nombre">Nombre<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre de la persona" value="<?php echo $persona->getPersona_nombre()?>">
                                    </div>
                                </div>
                                  <br>
                                <div class="col-lg-12">
                                    <label for="apellido">Apellido</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellido de la persona" value="<?php echo $persona->getPersona_apellido()?>">
                                    </div>
                                </div>
                                  <br>
                            
                                
                                <div class="col-lg-12">
                                    <label for="cedula">Cedula<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <input type="number" class="form-control" name="cedula" id="cedula" placeholder="Cedula" value="<?php echo $persona->getPersona_cedula()?>">
                                    </div>
                                </div>
                           
  									<br>
                                <div class="col-lg-12">
                                    <label for="telefono">Telefono</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></div>
                                        <input type="text" class="form-control" name="telefono" id="telefono"  placeholder="Telefono" value="<?php echo $persona->getPersona_telefono()?>">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <label for="direccion">Dirección</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></div>
                                        <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Dirección"  value="<?php echo $persona->getPersona_direccion()?>">
                                    </div>
                                </div>
                           
  									<br>
                            
                               <div class="col-lg-12">
                                    <label for="sexo">Sexo</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <input type="text" class="form-control" name="sexo" id="sexo" placeholder="Sexo"  value="<?php echo $persona->getPersona_sexo()?>">
                                    </div>
                                </div>
                           
  									<br>
                           <div class="col-lg-12">
                                    <label for="fecha">Fecha de nacimiento</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                                        <input type="date" class="form-control" name="fecha" id="fecha" placeholder="fecha de nacimiento"  value="<?php echo $persona->getPersona_fecha()?>">
                                    </div>
                                </div>
                           
  									<br>

                          

                            <div class="row">
                                <div class="col-xs-12"><span class="text-danger">(*) Campos requeridos</span></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-md-4 col-lg-4">
                                    <button id="btn-modify" class="btn btn-sm btn-block btn-success" data-loading-text="<span class='glyphicon glyphicon-asterisk rotate'></span> Modificando persona"><span class="fa fa-plus-circle"></span> Modificar </button>
                                </div>

                                <div class="col-xs-4 col-md-4 col-lg-4">
                                    <button id="btn-delete" class="btn btn-sm btn-block btn-warning" data-loading-text="<span class='glyphicon glyphicon-asterisk rotate'></span> Eliminando persona"><span class="fa fa-minus-circle"></span> Eliminar </button>
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
<script src="<?php echo URL?>js/controller/personas.js"></script>
<script>
    $(function() {
        $("#c_personas").addClass('active open');
        $("#i_list_personas").addClass('active');

        $("#btn-modify").click(function() {

            $(this).button('loading');
            modify();

            return false;
        });

        $("#btn-delete").click(function () {

            $(this).button('loading');

            removePersona();

            return false;
        });
    });
</script>
