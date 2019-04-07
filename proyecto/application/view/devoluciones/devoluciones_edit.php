<?php


$devolucion = $data->getProperty('devolucion');
?>

<div class="main-content">

    <div class="main-content-inner">

        <div class="page-content">

            <!-- PAGE HEADER -->
            <div class="page-header">
                <h1>
                    DEVOLUCIONES
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Modifique los campos de la devolucion
                    </small>
                </h1>
            </div>
            <!-- PAGE HEADER FIN -->
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <div id="error"></div>
                    <form id="frm-devolucion" accept-charset="utf-8" autocomplete="off" method="post" enctype="multipart/form-data">
                        <fieldset>

                            <input type="hidden" id= "id" name="id" value="<?php echo $devolucion->getId()?>">

                            
                                
                                <div class="col-lg-12">
                                    <label for="fecha">Fecha de la devolucion <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                                        <input type="date" class="form-control" name="fecha" id="fecha" placeholder="Fecha estimada de devolucion" value="<?php echo $devolucion->getDevolucion_fecha()?>">
                                    </div>
                                </div>
                                  <br>
                                <div class="col-lg-12">
                                    <label for="devuelto">Fecha<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                                        <input type="date" class="form-control" name="devuelto" id="devuelto" placeholder="fecha devuelto"  value="<?php echo $devolucion->getDevolucion_devolucion()?>">
                                    </div>
                                </div>
								  <br>

                            
                                <div class="col-lg-12">
                                    <label for="persona">Persona</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <input type="text" class="form-control" name="persona" id="persona" placeholder="Persona del prestamo" value="<?php echo $devolucion->getDevolucion_persona()?>">
                                    </div>
                                </div>
											  <br>
                                <div class="col-lg-12">
                                    <label for="libro">Libro devuelto<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <input type="text" class="form-control" name="libro" id="libro" placeholder="Libro devuelto" value="<?php echo $devolucion->getDevolucion_libro_id()?>">
                                    </div>
                                </div>
                             <br>
                            

                                <div class="col-lg-12">
                                    <label for="estado">Estado</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <input type="text" class="form-control" name="estado" id="estado"  placeholder="Estado" value="<?php echo $devolucion->getDevolucion_estado()?>">
                                    </div>
                                </div>
								  <br>
                           
                          
                            <div class="row">
                                <div class="col-xs-12"><span class="text-danger">(*) Campos requeridos</span></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-md-4 col-lg-4">
                                    <button id="btn-modify" class="btn btn-sm btn-block btn-success" data-loading-text="<span class='glyphicon glyphicon-asterisk rotate'></span> Modificando devolucion"><span class="fa fa-plus-circle"></span> Modificar </button>
                                </div>

                                <div class="col-xs-4 col-md-4 col-lg-4">
                                    <button id="btn-delete" class="btn btn-sm btn-block btn-warning" data-loading-text="<span class='glyphicon glyphicon-asterisk rotate'></span> Eliminando devolucion"><span class="fa fa-minus-circle"></span> Eliminar </button>
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
<script src="<?php echo URL?>js/controller/devoluciones.js"></script>
<script>
    $(function() {
        $("#c_devoluciones").addClass('active open');
        $("#i_list_devoluciones").addClass('active');

        $("#btn-modify").click(function() {

            $(this).button('loading');
            modify();

            return false;
        });

        $("#btn-delete").click(function () {

            $(this).button('loading');

            removeDevolucion();

            return false;
        });
    });
</script>
