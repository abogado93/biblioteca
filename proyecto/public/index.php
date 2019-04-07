<?php
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
// $ROOT/application".
define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);

// Autoloader del composer
if (file_exists(ROOT . 'vendor/autoload.php')) {
    require ROOT . 'vendor/autoload.php';
}
// Configuración de la aplicación
require APP . 'config/config.php';

$app = new Application();