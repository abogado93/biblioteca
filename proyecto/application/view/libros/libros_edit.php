<?php


$libro = $data->getProperty('libro');
?>

<div class="main-content">

    <div class="main-content-inner">

        <div class="page-content">

            <!-- PAGE HEADER -->
            <div class="page-header">
                <h1>
                    LIBROS
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Modifique los campos del libro
                    </small>
                </h1>
            </div>
            <!-- PAGE HEADER FIN -->
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <div id="error"></div>
                    <form id="frm-libro" accept-charset="utf-8" autocomplete="off" method="post" enctype="multipart/form-data">
                        <fieldset>

                            <input type="hidden" id= "id" name="id" value="<?php echo $libro->getId()?>">

                           
                                 <div class="col-lg-12">
                                    <label for="nombre">Nombre del libro<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre del libro" value="<?php echo $libro->getLibro_nombre()?>">
                                    </div>
                                </div>
                                  <br>
                                <div class="col-lg-12">
                                    <label for="fecha">Fecha</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                                        <input type="date" class="form-control" name="fecha" id="fecha" placeholder="Fecha"  value="<?php echo $libro->getLibro_fecha()?>">
                                    </div>
                                </div>

                          
  <br>
                            
                                <div class="col-lg-12">
                                    <label for="estado">Estado del libro</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <input type="text" class="form-control" name="estado" id="estado" placeholder="Estado del libro" value="<?php echo $libro->getLibro_estado()?>">
                                    </div>
                                </div>
  <br>
                                <div class="col-lg-12">
                                    <label for="tipo">Tipo de libro</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <input type="text" class="form-control" name="tipo" id="tipo" placeholder="Tipo de libro" value="<?php echo $libro->getLibro_tipo()?>">
                                    </div>
                                </div>
                           
  <br>
                            

                                <div class="col-lg-12">
                                    <label for="precio">Precio del libro<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <input type="number" class="form-control" name="precio" id="precio"  placeholder="Precio del libro" value="<?php echo $libro->getLibro_precio()?>">
                                    </div>
                                </div>
  <br>
                                <div class="col-lg-12">
                                    <label for="existencia">En Existencia</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <input type="number" class="form-control" name="existencia" id="existencia" placeholder="Existencia"  value="<?php echo $libro->getLibro_existencia()?>">
                                    </div>
                                </div>
                            
                              <br>

                           <div class="col-lg-12">
                                    <label for="cantidad">Cantidad<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <input type="number" class="form-control" name="cantidad" id="cantidad" placeholder="Cantidad"  value="<?php echo $libro->getLibro_cantidad()?>">
                                    </div>
                                </div>

                            
  <br>
                            <div class="row">
                                <div class="col-xs-12"><span class="text-danger">(*) Campos requeridos</span></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-md-4 col-lg-4">
                                    <button id="btn-modify" class="btn btn-sm btn-block btn-success" data-loading-text="<span class='glyphicon glyphicon-asterisk rotate'></span> Modificando libro"><span class="fa fa-plus-circle"></span> Modificar </button>
                                </div>

                                <div class="col-xs-4 col-md-4 col-lg-4">
                                    <button id="btn-delete" class="btn btn-sm btn-block btn-warning" data-loading-text="<span class='glyphicon glyphicon-asterisk rotate'></span> Eliminando libro"><span class="fa fa-minus-circle"></span> Eliminar </button>
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
<script src="<?php echo URL?>js/controller/libros.js"></script>
<script>
    $(function() {
        $("#c_libros").addClass('active open');
        $("#i_list_libros").addClass('active');

        $("#btn-modify").click(function() {

            $(this).button('loading');
            modify();

            return false;
        });

        $("#btn-delete").click(function () {

            $(this).button('loading');

            removeLibro();

            return false;
        });
    });
</script>
