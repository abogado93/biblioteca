

<div class="main-content">

    <div class="main-content-inner">

        <div class="page-content">

            <!-- PAGE HEADER -->
            <div class="page-header">
                <h1>
                    Alta de pagos
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Ingrese los campos requeridos para registar un nuevo pago
                    </small>
                </h1>
            </div>
            <!-- PAGE HEADER FIN -->
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <div id="error"></div>
                    <form id="frm-pago" accept-charset="utf-8" autocomplete="off" method="post" enctype="multipart/form-data">
                        <fieldset>

                             <div class="col-lg-12">
                                    <label for="fecha">Fecha de pago<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                                        <input type="date" class="form-control" name="fecha" id="fecha" placeholder="Fecha">
                                    </div>
                                </div>
                                  <br>
                                <div class="col-lg-12">
                                    <label for="multa">Multa</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <input type="text" class="form-control" name="multa" id="multa" placeholder="Multa del libro">
                                    </div>
                                </div>
                                  <br>
                            
                                
                                <div class="col-lg-12">
                                    <label for="monto">Monto<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <input type="number" class="form-control" name="monto" id="monto" placeholder="Monto a pagar">
                                    </div>
                                </div>
                           
  									<br>
                             
                                <div class="col-lg-12">
                                    <label for="prestamo">Prestamo nro</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <input type="text" class="form-control" name="prestamo" id="prestamo" placeholder="Prestamo libro">
                                    </div>
                                </div>
                           
  									<br>
                            
                               <div class="col-lg-12">
                                    <label for="estado">Estado</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <input type="text" class="form-control" name="estado" id="estado" placeholder="Estado"  value="<?php echo $pago->getPago_estado()?>">
                                    </div>
                                </div>
                           
  									<br>
                         
                          
                            <div class="row">
                                <div class="col-xs-12"><span class="text-danger">(*) Campos requeridos</span></div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-6 col-xs-6 col-md-6">
                                    <button id="btn-add" class="btn btn-sm btn-block btn-success" data-loading-text="<span class='glyphicon glyphicon-asterisk rotate'></span> Registrando pagos"><span class="fa fa-plus-circle"></span> Registrar</button>
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
<script src="<?php echo URL?>js/controller/pagos.js"></script>

<script>
    $(function() {
        $("#c_pagos").addClass('active open');//menu
        $("#i_new_pagos").addClass('active');

        $("#btn-add").click(function() {

            console.log("click");

            $(this).button('loading');
            add();
            return false;
        });

    });
</script>

