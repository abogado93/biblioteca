<?php
/**
 * Created by PhpStorm.
 * User: crojas
 * Date: 7/16/17
 * Time: 19:05
 *
 * @var $data ControllerCustomProperties
 */

$cliente = $data->getProperty('cliente');
?>

<div class="main-content">

    <div class="main-content-inner">

        <div class="page-content">

            <!-- PAGE HEADER -->
            <div class="page-header">
                <h1>
                    Comercios
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Modifique los campos del comercio
                    </small>
                </h1>
            </div>
            <!-- PAGE HEADER FIN -->
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <div id="error"></div>
                    <form id="frm-cliente" accept-charset="utf-8" autocomplete="off" method="post" enctype="multipart/form-data">
                        <fieldset>

                            <input type="hidden" id= "id" name="id" value="<?php echo $cliente->getId()?>">

                            <div class="form-group">
                                <div class="col-lg-6 col-sm-6">
                                    <label for="ruc">Ruc <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></div>
                                        <input type="text" class="form-control" name="ruc" id="ruc" placeholder="Ruc" value="<?php echo $cliente->getRuc()?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="email">Email</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email"  value="<?php echo $cliente->getEmail()?>">
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="col-lg-6 col-sm-6">
                                    <label for="nombre-fantasia">Nombre Fantasia </label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-copyright-mark"></span></div>
                                        <input type="text" class="form-control" name="nombre-fantasia" id="nombre-fantasia" placeholder="Nombre de Fantasia" value="<?php echo $cliente->getNombreFantasia()?>">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-sm-6">
                                    <label for="razon-social">Razón Social </label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-registration-mark"></span></div>
                                        <input type="text" class="form-control" name="razon-social" id="razon-social" placeholder="Razon Social" value="<?php echo $cliente->getRazonSocial()?>">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="col-lg-3 col-sm-3">
                                    <label for="telefono">Telefono</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></div>
                                        <input type="text" class="form-control" name="telefono" id="telefono"  placeholder="Telefono" value="<?php echo $cliente->getTelefono()?>">
                                    </div>
                                </div>

                                <div class="col-lg-9">
                                    <label for="direccion">Dirección</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></div>
                                        <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Dirección"  value="<?php echo $cliente->getDireccion()?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col-lg-12">
                                    <label for="observaciones">Observaciones</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <textarea rows="3" type="text" class="form-control" name="observaciones" id="observaciones" placeholder="Observaciones"  maxlength="200"><?php echo $cliente->getObservaciones()?></textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-xs-12"><span class="text-danger">(*) Campos requeridos</span></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-md-4 col-lg-4">
                                    <button id="btn-modify" class="btn btn-sm btn-block btn-success" data-loading-text="<span class='glyphicon glyphicon-asterisk rotate'></span> Modificando comercio"><span class="fa fa-plus-circle"></span> Modificar </button>
                                </div>

                                <div class="col-xs-4 col-md-4 col-lg-4">
                                    <button id="btn-delete" class="btn btn-sm btn-block btn-warning" data-loading-text="<span class='glyphicon glyphicon-asterisk rotate'></span> Eliminando comercio"><span class="fa fa-minus-circle"></span> Eliminar </button>
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
<script src="<?php echo URL?>js/controller/clientes.js"></script>
<script>
    $(function() {
        $("#c_clientes").addClass('active open');
        $("#i_list_clientes").addClass('active');

        $("#btn-modify").click(function() {

            $(this).button('loading');
            modify();

            return false;
        });

        $("#btn-delete").click(function () {

            $(this).button('loading');

            removeCliente();

            return false;
        });
    });
</script>
