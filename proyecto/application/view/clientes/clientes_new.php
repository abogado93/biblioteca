<?php
/**
 * Created by PhpStorm.
 * User: crojas
 * Date: 7/16/17
 * Time: 19:05
 *
 * @var $data ControllerCustomProperties
 */
?>

<div class="main-content">

    <div class="main-content-inner">

        <div class="page-content">

            <!-- PAGE HEADER -->
            <div class="page-header">
                <h1>
                    Alta de clientes
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Ingrese los campos requeridos para registar el nuevo cliente
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

                            <div class="form-group">
                                <div class="col-lg-6 col-sm-6">
                                    <label for="ruc">Ruc <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></div>
                                        <input type="text" class="form-control" name="ruc" id="ruc" placeholder="Ruc">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label for="email">Email</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
                                        <input type="email"  class="form-control" name="email" id="email" placeholder="Email"></input>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-6 col-sm-6">
                                    <label for="nombre-fantasia">Nombre de Fantasia</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-copyright-mark"></span></div>
                                        <input type="text"  class="form-control" name="nombre-fantasia" id="nombre-fantasia" placeholder="Nombre de Fantasia"  maxlength="200"></input>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <label for="razon-social">Razón Social</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-registration-mark"></span></div>
                                        <input type="text"  class="form-control" name="razon-social" id="razon-social" placeholder="Razón Social"  maxlength="200"></input>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="col-lg-3 col-sm-3">
                                    <label for="telefono">Telefono</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></div>
                                        <input type="text"  class="form-control" name="telefono" id="telefono" placeholder="Telefono"></input>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <label for="direccion">Direccion</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></div>
                                        <input type="text"  class="form-control" name="direccion" id="direccion" placeholder="Direccion"></input>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="col-lg-12 col-sm-12">
                                    <label for="observaciones">Observaciones</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                        <textarea rows="3" type="text"  class="form-control" name="observaciones" id="observaciones" placeholder="Observaciones"  maxlength="200"></textarea>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-xs-12"><span class="text-danger">(*) Campos requeridos</span></div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-6 col-xs-6 col-md-6">
                                    <button id="btn-add" class="btn btn-sm btn-block btn-success" data-loading-text="<span class='glyphicon glyphicon-asterisk rotate'></span> Registrando comercio"><span class="fa fa-plus-circle"></span> Registrar</button>
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
<script src="<?php echo URL?>js/controller/clientes.js"></script>

<script>
    $(function() {
        $("#c_clientes").addClass('active open');//menu
        $("#i_new_clientes").addClass('active');

        $("#btn-add").click(function() {

            console.log("click");

            $(this).button('loading');
            add();
            return false;
        });

    });
</script>

