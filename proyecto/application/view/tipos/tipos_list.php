
<div class="main-content">
    <div class="main-content-inner">

        <div class="page-content">

            <!-- PAGE HEADER -->
            <div class="page-header">
                <h1>
                    Lista de tipos de libros
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Alta, baja y modificaciones de tipo de libros
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
                                <th>ID Tipo</th>
                                <th>Descripcion</th>
                                
                               
                                <th>&nbsp</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php

                            if ($data->getProperty('paginator_wrapper')->getRowCount() > 0) {
                                foreach ($data->getProperty('paginator_wrapper')->getRows() as $tipo) { ?>
                                    <tr>
                                        <td class="text-center"><?php echo $tipo->getId() ?></td>
                                        <td><?php echo $tipo->getTipo_descripcion() ?></td>
                                    
                                        
                                        <td class="text-center"><a class="btn btn-sm btn-warning" href="<?= URL . $data->getEditURL() . htmlspecialchars($tipo->getId(), ENT_QUOTES, 'UTF-8'); ?>"><span class="glyphicon glyphicon-pencil"></span> Modificar/Eliminar</a></td>
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
        $("#c_tipos").addClass('active open');
        $("#i_list_tipos").addClass('active');
    });
</script>
