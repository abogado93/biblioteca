

<div class="main-content">

    <div class="main-content-inner">

        <div class="page-content">

            <!-- PAGE HEADER -->
            <div class="page-header">
                <h1>
                    Alta de personas
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Ingrese los campos requeridos para registar una nueva persona
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

                            <div class="col-lg-12">
                                    <label for="nombre">Nombre<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre de la persona">
                                    </div>
                                </div>
                                  <br>
                                <div class="col-lg-12">
                                    <label for="apellido">Apellido</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellido de la persona">
                                    </div>
                                </div>
                                  <br>
                            
                                
                                <div class="col-lg-12">
                                    <label for="cedula">Cedula<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <input type="number" class="form-control" name="cedula" id="cedula" placeholder="Cedula">
                                    </div>
                                </div>
                           
  									<br>
                                <div class="col-lg-12">
                                    <label for="telefono">Telefono</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></div>
                                        <input type="text" class="form-control" name="telefono" id="telefono"  placeholder="Telefono">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <label for="direccion">Dirección</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></div>
                                        <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Dirección" >
                                    </div>
                                </div>
                           
  									<br>
                            
                               <div class="col-lg-12">
                                    <label for="sexo">Sexo</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <input type="text" class="form-control" name="sexo" id="sexo" placeholder="Sexo">
                                    </div>
                                </div>
                           
  									<br>
                           <div class="col-lg-12">
                                    <label for="fecha">Fecha de nacimiento</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                                        <input type="date" class="form-control" name="fecha" id="fecha" placeholder="fecha de nacimiento">
                                    </div>
                                </div>
                           
  									<br>

                          
                            <div class="row">
                                <div class="col-xs-12"><span class="text-danger">(*) Campos requeridos</span></div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-6 col-xs-6 col-md-6">
                                    <button id="btn-add" class="btn btn-sm btn-block btn-success" data-loading-text="<span class='glyphicon glyphicon-asterisk rotate'></span> Registrando persona"><span class="fa fa-plus-circle"></span> Registrar</button>
                                </div>

                                <div class="col-lg-6 col-xs-6 col-md-6">
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
        $("#c_personas").addClass('active open');//menu
        $("#i_new_personas").addClass('active');

        $("#btn-add").click(function() {

            console.log("click");

            $(this).button('loading');
            add();
            return false;
        });

    });
</script>

