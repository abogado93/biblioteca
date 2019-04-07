

<div class="main-content">

    <div class="main-content-inner">

        <div class="page-content">

            <!-- PAGE HEADER -->
            <div class="page-header">
                <h1>
                    Alta de Prestamos
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Ingrese los campos requeridos para registar el nuevo prestamo
                    </small>
                </h1>
            </div>
            <!-- PAGE HEADER FIN -->
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <div id="error"></div>
                    <form id="frm-prestamo" accept-charset="utf-8" autocomplete="off" method="post" enctype="multipart/form-data">
                        <fieldset>

                            
                                   <div class="col-lg-12">
                                    <label for="fecha">Fecha del prestamo <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                                        <input type="date" class="form-control" name="fecha" id="fecha" placeholder="Fecha">
                                    </div>
                                </div>
                                  <br>
                                <div class="col-lg-12">
                                    <label for="estado">Estado del Prestamo</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <input type="text" class="form-control" name="estado" id="estado" placeholder="Estado" >
                                    </div>
                                </div>
								  <br>

                          
                                <div class="col-lg-12">
                                    <label for="persona">Persona</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <input type="text" class="form-control" name="persona" id="persona" placeholder="Persona del prestamo">
                                    </div>
                                </div>
											  <br>
                               
                               <div class="col-lg-12">
                                    <label for="libro">Libro solicitado<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <input type="text" class="form-control" name="libro" id="libro" placeholder="Libro solicitado" >
                                    </div>
                                </div>
                             <br>
                               
                                <div class="col-lg-12">
                                    <label for="devolucion">Devolucion</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                                    </div>
                                </div>
								  <br>
                                <div class="col-lg-12">
                                    <label for="dias">Dias de prestamo</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <input type="text" class="form-control" name="dias" id="dias" placeholder="Dias de prestamo">
                                    </div>
                                </div>
                             <br>
                          <div class="col-lg-12">
                                    <label for="cantidad">Cantidad<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <input type="text" class="form-control" name="cantidad" id="cantidad" placeholder="Cantidad">
                                    </div>
                            </div>
											  <br>
                            <div class="row">
                                <div class="col-xs-12"><span class="text-danger">(*) Campos requeridos</span></div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-6 col-xs-6 col-md-6">
                                    <button id="btn-add" class="btn btn-sm btn-block btn-success" data-loading-text="<span class='glyphicon glyphicon-asterisk rotate'></span> Registrando prestamo"><span class="fa fa-plus-circle"></span> Registrar</button>
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
<script src="<?php echo URL?>js/controller/prestamos.js"></script>

<script>
    $(function() {
        $("#c_prestamos").addClass('active open');//menu
        $("#i_new_prestamos").addClass('active');

        $("#btn-add").click(function() {

            console.log("click");

            $(this).button('loading');
            add();
            return false;
        });

    });
</script>

