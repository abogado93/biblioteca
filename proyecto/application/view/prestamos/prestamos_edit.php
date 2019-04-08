<?php

$prestamo = $data->getProperty('prestamo');
?>

<div class="main-content">

    <div class="main-content-inner">

        <div class="page-content">

            <!-- PAGE HEADER -->
            <div class="page-header">
                <h1>
                    PRESTAMOS
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Modifique los campos del prestamo
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

                            <input type="hidden" id= "id" name="id" value="<?php echo $prestamo->getId()?>">

                            
                                <div class="col-lg-12">
                                    <label for="fecha">Fecha del prestamo <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                                        <input type="date" class="form-control" name="fecha" id="fecha" placeholder="Fecha" value="<?php echo $prestamo->getPrestamo_fecha()?>">
                                    </div>
                                </div>
                                  <br>
                                <div class="col-lg-12">
                                    <label for="estado">Estado del Prestamo</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <input type="text" class="form-control" name="estado" id="estado" placeholder="Estado"  value="<?php echo $prestamo->getPrestamo_estado()?>">
                                    </div>
                                </div>
								  <br>

                            
                                <div class="col-lg-12">
                                    <label for="persona">Persona</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <input type="text" class="form-control" name="persona" id="persona" placeholder="Persona del prestamo" value="<?php echo $prestamo->getPrestamo_persona()?>">
                                    </div>
                                </div>
											  <br>
                                <div class="col-lg-12">
                                    <label for="libro">Libro solicitado<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <input type="text" class="form-control" name="libro" id="libro" placeholder="Libro solicitado" value="<?php echo $prestamo->getPrestamo_libro_id()?>">
                                    </div>
                                </div>
                             <br>
                            

                                <div class="col-lg-12">
                                    <label for="devolucion">Devolucion</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                                        <input type="date" class="form-control" name="devolucion" id="devolucion"  placeholder="fecha devolucion" value="<?php echo $prestamo->getPrestamo_devolucion()?>">
                                    </div>
                                </div>
								  <br>
                                <div class="col-lg-12">
                                    <label for="dias">Dias de prestamo</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <input type="text" class="form-control" name="dias" id="dias" placeholder="Dias de prestamo"  value="<?php echo $prestamo->getPrestamo_dias()?>">
                                    </div>
                                </div>
                             <br>
                          <div class="col-lg-12">
                                    <label for="cantidad">Cantidad<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <input type="text" class="form-control" name="cantidad" id="cantidad" placeholder="Cantidad"  value="<?php echo $prestamo->getPrestamo_cantidad()?>">
                                    </div>
                            </div>
											  <br>
											  <div class="col-lg-12">
                                    <label for="pago">Pagos<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <input type="text" class="form-control" name="pago" id="pago" placeholder="Pago"  value="<?php echo $prestamo->getPrestamo_pago()?>">
                                    </div>
                            </div>
											  <br>
                            <div class="row">
                                <div class="col-xs-12"><span class="text-danger">(*) Campos requeridos</span></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-md-4 col-lg-4">
                                    <button id="btn-modify" class="btn btn-sm btn-block btn-success" data-loading-text="<span class='glyphicon glyphicon-asterisk rotate'></span> Modificando prestamo"><span class="fa fa-plus-circle"></span> Modificar </button>
                                </div>

                                <div class="col-xs-4 col-md-4 col-lg-4">
                                    <button id="btn-delete" class="btn btn-sm btn-block btn-warning" data-loading-text="<span class='glyphicon glyphicon-asterisk rotate'></span> Eliminando prestamo"><span class="fa fa-minus-circle"></span> Eliminar </button>
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
<script src="<?php echo URL?>js/controller/prestamos.js"></script>
<script>
    $(function() {
        $("#c_prestamos").addClass('active open');
        $("#i_list_prestamos").addClass('active');

        $("#btn-modify").click(function() {

            $(this).button('loading');
            modify();

            return false;
        });

        $("#btn-delete").click(function () {

            $(this).button('loading');

            removePrestamos();

            return false;
        });
    });
</script>
