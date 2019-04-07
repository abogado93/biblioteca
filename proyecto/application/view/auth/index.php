<?php
/**
 * Created by PhpStorm.
 * User: crojas
 * Date: 2/12/18
 * Time: 14:40
 */
Session::start();
$signature = Util::generateToken();
Session::write("signature", $signature);

$token = null;

if(isset($_GET['token']) && !empty($_GET['token'])) {
    $token = new ActivationToken($_GET['token']);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta charset="utf-8">
    <meta name="author" content="Christian Rojas">
    <meta name="description" content="Facturacion">
    <meta name="revisit-after" content="15 days">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard de promociones</title>
    <link rel="stylesheet" href="<?php echo URL?>assets/css/bootstrap.min.css" />
    <style type="text/css">
        .title {
            color: rgba(0,0,0,0.6);
            text-shadow: 2px 2px 3px rgba(255,255,255,0.1);
        }
        img.cropped {
            position: absolute;
            margin: auto;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <h1 class="text-center title">Acceso a Facturación</h1>
    </div>
    <div class="row">
        <!-- columna izquierda -->
        <div class="col-md-12 col-lg-12">
            <div id="error"></div>
            <form accept-charset="utf-8" autocomplete="off" method="post" enctype="multipart/form-data">
                <fieldset>
                    <h3>Por favor, complete los siguientes datos para ingresar</h3>
                    <hr class="colorgraph">
                    <div id="error">
                        <?php if($token !== null && !$token->isValid()) {
                            echo '<div class="alert alert-danger alert-dismissable" style="text-align:center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>&iexcl;Atenci&oacute;n!</strong> ' . $token->getErrorMsg() . '</div>';
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                            <input type="text" name="usuario" id="usuario" class="form-control input-lg" placeholder="Usuario" required autofocus title="Ingrese su nombre de usuario">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-log-in"></span></span>
                            <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Contrase&ntilde;a" required title="Por favor, ingrese su contrase&ntilde;a">
                        </div>
                    </div>
                    <hr class="colorgraph">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <input type="hidden" name="fs" id="fs" value="<?php echo $signature?>">
                            <button class="btn btn-lg btn-info btn-block" id="btn-login" data-loading-text="<span class='glyphicon glyphicon-asterisk rotate'></span> Comprobando usuario y contrase&ntilde;a"><span class="glyphicon glyphicon-flash"></span> Ingresar</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <!-- fin columna izquierda -->

        <!-- COLUMNA DERECHA
        <div class="col-md-7 col-lg-7" style="min-height: 470px;">
            <img src="dashboard/assets/img/logo.png" class="img-rounded img-responsive cropped">
        </div>
        <!-- fin columna derecha -->
    </div>
</div>

<script src="<?php echo URL?>js/jquery-1.11.2.min.js"></script>
<script src="<?php echo URL?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo URL?>js/util.js"></script>
<script src="<?php echo URL?>js/controller/login.js"></script>

<script>
    $(function() {

        <?php
        if(Session::keyExists("error")) {
            echo 'setMensaje(' . "'" . Session::dump() . ');';
        }
        ?>

        $("#btn-login").click(function() {
            $(this).button('loading');
            login();
            return false;
        });
    });
</script>
</body>
</html>