
<div class="main-content">
    <div class="main-content-inner">

        <div class="page-content">

            <!-- PAGE HEADER -->
            <div class="page-header">
                <h1>
                    Lista de Prestamos
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Alta, baja y modificaciones de prestamos
                        <button id="add-user" class="btn btn-success pull-right" onclick="window.location='<?php echo URL . $data->getRegisterURL()?>'"><span class="glyphicon glyphicon-plus"></span> Agregar  </button>
                    </small>
                </h1>
            </div>
            <!-- PAGE HEADER FIN -->
            <div class="row">
                <div class="col-xs-12 col-lg-12">
                    <div class="table-responsive">
                        <!-- PAGE CONTENT BEGINS -->
                        <table class="table table-bordered table-condensed table-hover table-responsive table-striped">
                            <thead>
                            <tr>
                                <th>ID Prestamo</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                                <th>Persona</th>
                                <th>Libro</th>
                                <th>Devolucion</th>
                                <th>Dias de prestamo</th>
                                <th>Cantidad</th>
                                <th>Pagos</th>
                                <th>&nbsp </th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php

                            if ($data->getProperty('paginator_wrapper')->getRowCount() > 0) {
                                foreach ($data->getProperty('paginator_wrapper')->getRows() as $prestamo) { ?>
                                    <tr>
                                        <td class="text-center"><?php echo $prestamo->getId() ?></td>
                                        <td><?php echo $prestamo->getPrestamo_fecha() ?></td>
                                        <td><?php echo $prestamo->getPrestamo_estado() ?></td>
                                        <td><?php echo $prestamo->getPrestamo_persona() ?></td>
                                        <td><?php echo $prestamo->getPrestamo_libro_id()?></td>
                                        <td><?php echo $prestamo->getPrestamo_devolucion() ?></td>
                                        <td><?php echo $prestamo->getPrestamo_dias() ?></td>
                                         <td><?php echo $prestamo->getPrestamo_cantidad() ?></td>
                                        <td><?php echo $prestamo->getPrestamo_pago()?></td>
                                        <td class="text-center"><a class="btn btn-sm btn-warning" href="<?= URL . $data->getEditURL() . htmlspecialchars($prestamo->getId(), ENT_QUOTES, 'UTF-8'); ?>"><span class="glyphicon glyphicon-pencil"></span> Modificar/Eliminar</a></td>
                                    </tr>

                                    <?php
                                }
                            } else { ?>
                                <tr>
                                    <td colspan="9" class="text-center">
                                        <span class="text-danger">No hay registros</span>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <?php
                        echo '<div class="text-center">';
                        echo $data->getProperty('paginator_wrapper')->getPaginator()->showPage();
                        echo '</div>';
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $("#c_prestamos").addClass('active open');
        $("#i_list_prestamos").addClass('active');
    });
</script>
