
<div class="main-content">

    <div class="main-content-inner">

        <div class="page-content">

            <!-- PAGE HEADER -->
            <div class="page-header">
                <h1>
                    Alta de Libros
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Ingrese los campos requeridos para registar el nuevo libro
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

                            
                               <div class="col-lg-12">
                                    <label for="nombre">Nombre del libro<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <input type="text"  class="form-control" name="nombre" id="nombre" placeholder="Nombre del libro"></input>
                                    </div>
                                </div>
  <br>
                                <div class="col-lg-12">
                                    <label for="fecha">Fecha de registro</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                                        <input type="date"  class="form-control" name="fecha" id="fecha" placeholder="Fecha"></input>
                                    </div>
                                </div>
                             <br>

                                <div class="col-lg-12">
                                    <label for="tipo">Tipo de libro</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <input type="text"  class="form-control" name="tipo" id="tipo" placeholder="Tipo del libro" ></input>
                                    </div>
                                </div>
                                  <br>
                                <div class="col-lg-12">
                                    <label for="estado">Estado</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <input type="text"  class="form-control" name="estado" id="estado" placeholder="Estado del libro" ></input>
                                    </div>
                                </div>
                        

                             <br>

                                <div class="col-lg-12">
                                    <label for="precio">Precio<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <input type="number"  class="form-control" name="precio" id="precio" placeholder="Precio"></input>
                                    </div>
                                </div>
                                  <br>
                                <div class="col-lg-12">
                                    <label for="existencia">Existencia</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <input type="number"  class="form-control" name="existencia" id="existencia" placeholder="Existencia"></input>
                                    </div>
                                </div>
                           
  <br>
                            

                              <div class="col-lg-12">
                                    <label for="cantidad">Cantidad<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <input type="number"  class="form-control" name="cantidad" id="cantidad" placeholder="Cantidad"></input>
                                    </div>
                                </div>
                           
                            <br>
                            <div class="row">
                                <div class="col-xs-12"><span class="text-danger">(*) Campos requeridos</span></div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-6 col-xs-6 col-md-6">
                                    <button id="btn-add" class="btn btn-sm btn-block btn-success" data-loading-text="<span class='glyphicon glyphicon-asterisk rotate'></span> Registrando libros"><span class="fa fa-plus-circle"></span> Registrar</button>
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
<script src="<?php echo URL?>js/controller/libros.js"></script>

<script>
    $(function() {
        $("#c_libros").addClass('active open');//menu
        $("#i_new_libros").addClass('active');

        $("#btn-add").click(function() {

            console.log("click");

            $(this).button('loading');
            add();
            return false;
        });

    });
</script>

