<?php
/**
 * Created by PhpStorm.
 * User: crojas
 * Date: 2/13/18
 * Time: 15:08ç
 *
 * @var $data ControllerCustomProperties
 */
?>

<!-- MAIN CONTAINER INIT -->
<div class="main-content">

    <div class="main-content-inner">

        <div class="page-content">

            <!-- PAGE HEADER -->
            <div class="page-header">
                <h1>
                    Lista de usuarios
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Alta, baja y modificaciones de usuarios
                    </small>
                </h1>
            </div>
            <!-- PAGE HEADER FIN -->

            <div class="row">
                <div class="col-xs-12">
                    <button id="add-user" class="btn btn-success pull-right" onclick="window.location='<?php echo URL . "usuarios/new"?>'"><span class="glyphicon glyphicon-user"></span> Agregar usuario</button>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <table class="table table-bordered table-condensed table-hover table-responsive table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">Nro</th>
                            <th>Nombres y apellidos </th>
                            <th>Fecha alta</th>
                            <th>Activo</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php

                        if($data != null) {
                            /** @var $user Usuario */
                            foreach($data->getProperty('paginator_wrapper')->getRows() as $user) { ?>
                                <tr>
                                    <td class="text-center"><?php echo $user->getId()?></td>
                                    <td><?php echo $user->getNombres() . ", " . $user->getApellidos()?></td>
                                    <td><?php echo $user->getTsAlta()?></td>
                                    <td class="text-center"><?php echo $user->getUsuarioStatus()?></td>
                                    <td class="text-center"><a class="btn btn-sm btn-warning" href="<?php echo URL . $data->getEditURL() . $user->getId()?>"><span class="glyphicon glyphicon-search"></span> Modificar/Eliminar</a></td>
                                </tr>
                            <?php		}
                        } else { ?>
                            <tr>
                                <td colspan="6">
                                    <span class="text-danger">No hay usuarios registrados</span>
                                </td>
                            </tr>
                        <?php 	} ?>
                        </tbody>
                    </table>
                    <?php
                        echo '<div class="text-center">';
                        echo $data->getProperty('paginator_wrapper')->getPaginator()->showPage();
                        echo '</div>';
                    ?>
                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>

</div><!-- /.main-content -->
<script>
    $(function () {
        $("#c_users").addClass('active open');
        $("#i_users").addClass('active');
    })
</script>