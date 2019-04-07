<?php
/**
 * Created by PhpStorm.
 * User: crojas
 * Date: 2/9/18
 * Time: 16:06
 */
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
// $ROOT/application".
define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);

// Autoloader del composer
if (file_exists(ROOT . 'vendor/autoload.php')) {
    require ROOT . 'vendor/autoload.php';
}

// Configuración de la aplicación
//require APP . 'config/config.php';
define('ENVIRONMENT', 'development');
define('DSN', 'pgsql:host=localhost;port=5432;dbname=proyecto;');
define('DB_USER', 'postgres');
define('DB_PASSWORD', 'postgres');


// Ejemplo comando
//vendor/bin/phpunit --bootstrap ./tests/bootstrap.php ./tests/CategoriaUbicacionDatoTest.php

