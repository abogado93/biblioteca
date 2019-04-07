<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>Dashboard para gestión de Promociones</title>

    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" type="text/css" href="<?php echo URL?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo URL?>assets/font-awesome/4.6.3/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo URL?>js/libs/dt_picker/css/bootstrap-datetimepicker.min.css">

    <!-- page specific plugin styles -->

    <!-- text fonts -->
    <link rel="stylesheet" href="<?php echo URL?>assets/fonts/fonts.googleapis.com.css" />

    <!-- ace styles -->
    <link rel="stylesheet" href="<?php echo URL?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
    <link rel="stylesheet" type="text/css" href="<?php echo URL?>assets/css/custom.css">

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="<?php echo URL?>assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
    <![endif]-->

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="<?php echo URL?>assets/css/ace-ie.min.css" />
    <![endif]-->

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->
    <script src="<?php echo URL?>assets/js/ace-extra.min.js"></script>

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="<?php echo URL?>assets/js/html5shiv.min.js"></script>
    <script src="<?php echo URL?>assets/js/respond.min.js"></script>
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="<?php echo URL?>js/libs/sweet-alert/sweet-alert.css">

    <link rel="stylesheet" type="text/css" href="<?= URL?>assets/css/bootstrap-datetimepicker.min.css">


    <!-- <script type="text/javascript" src="js/libs/moment/moment.js"></script>  -->

    <!--[if !IE]> -->
    <script type='text/javascript' src="<?php echo URL?>js/jquery-3.3.1.min.js"></script>

    <!-- <![endif]-->

    <!--[if IE]>
    <script src="<?php echo URL?>assets/js/jquery.1.11.1.min.js"></script>
    <![endif]-->

    <!-- <![endif]-->

    <!--[if IE]>
    <script type="text/javascript">
        window.jQuery || document.write("<script src='<?php echo URL?>assets/js/jquery1x.min.js'>"+"<"+"/script>");
    </script>
    <![endif]-->
</head>

<body class="no-skin">

<?php require_once APP . 'view/templates/navbar.php'?>
<?php require_once APP . 'view/templates/menu.php'?>