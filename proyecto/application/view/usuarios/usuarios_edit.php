<?php
/**
 * Created by PhpStorm.
 * User: crojas
 * Date: 2/13/18
 * Time: 15:54
 *
 * @var $data ControllerCustomProperties
 * @var $usuario Usuario
 */

$usuario = $data->getProperty('user_to_edit');
$signature = $data->getProperty('users_edit_fs');
?>
<div class="main-content">

    <div class="main-content-inner">

        <div class="page-content">

            <!-- PAGE HEADER -->
            <div class="page-header">
                <h1>
                    Modificación de usuarios
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Realice los cambios necesarios a los datos del usuario
                    </small>
                </h1>
            </div>
            <!-- PAGE HEADER FIN -->
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <div id="error"></div>
                    <form id="frm-user-edit" accept-charset="utf-8" autocomplete="off" method="post" enctype="multipart/form-data">
                        <fieldset>

                            <div class="row">

                                <div class="col-lg-4 col-xs-12">
                                    <div class="form-group">
                                        <label for="usuario">Usuario <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                                            <input type="text" class="form-control" name="usuario" id="usuario" placeholder="usuario" autocomplete="username" value="<?=$usuario->getUsuario()?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-xs-12">
                                    <div class="form-group">
                                        <label for="nombres">Nombres <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><span class="fa fa-user"></span></div>
                                            <input type="text" class="form-control" name="nombres" id="nombres" autocomplete="family-name" value="<?=$usuario->getNombres()?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-xs-12">
                                    <div class="form-group">
                                        <label for="apellidos">Apellidos <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><span class="fa fa-user"></span></div>
                                            <input type="text" class="form-control" name="apellidos" id="apellidos" autocomplete="family-name" value="<?=$usuario->getApellidos()?>">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-xs-12">&nbsp;</div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12"><span class="text-danger">(*) Campos requeridos</span></div>
                            </div>

                            <div class="row">

                                <div class="col-lg-4 col-xs-12">

                                    <input type="hidden" name="users_edit_fs" id="fs" value="<?=$signature?>">
                                    <input type="hidden" name="user_id" id="user_id" value="<?=$usuario->getId()?>">

                                    <button id="btn-modify" class="btn btn-lg btn-block btn-success" data-loading-text="<span class='glyphicon glyphicon-asterisk rotate'></span> Modificando usuario..."><span class="fa fa-plus-circle"></span> Modificar usuario</button>
                                </div>

                                <div class="col-lg-4 col-xs-12">

                                    <button id="btn-block-user" class="btn btn-lg btn-block btn-warning" data-loading-text="<span class='glyphicon glyphicon-asterisk rotate'></span> Bloqueando usuario...">Bloquear usuario</button>
                                </div>

                                <div class="col-lg-4 col-xs-12">
                                    <button id="cancel" onclick="window.location='<?php echo URL . $data->getListURL()?>';return false;" class="btn btn-lg btn-block  btn-danger"><span class="fa fa-plus-circle"></span> Cancelar</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>

</div><!-- /.main-content -->
<script src="<?php echo URL?>js/util.js"></script>
<script src="<?php echo URL?>js/libs/sweet-alert/sweet-alert.min.js"></script>
<script src="<?php echo URL?>js/libs/form_validator/FormValidator.js"></script>
<script src="<?php echo URL?>js/controller/usuarios.js"></script>
<script src="<?php echo URL?>assets/js/bootstrap3-typeahead.js"></script>
<script>

    $(function () {

        $("form").submit(function(e){
            e.preventDefault();
        });

        $("#btn-modify").click(function() {
            $(this).button('loading');
            modify();
            return false;
        });

        $("#btn-block-user").click(function() {
            $(this).button('loading');
            confirmUserBlocking();
            return false;
        });

        $("#c_users").addClass('active open');
        $("#i_add_user").addClass('active');
    });
</script>