<?php
/**
 * Configuración para Error reporting
 * display_errors sólo debe estar disponible para el ambiente de desarrollo.
 */
define('ENVIRONMENT', 'development');

if (ENVIRONMENT == 'development' || ENVIRONMENT == 'dev') {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}

/**
 * Constantes relacionadas a las URLs
 */

define('URL_PUBLIC_FOLDER', 'public');
define('URL_PROTOCOL', '//');
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
define('URL_SUB_FOLDER', str_replace(URL_PUBLIC_FOLDER, '', dirname($_SERVER['SCRIPT_NAME'])));
define('URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER);

/**
 * Configuración de base de datos
 */

define('DSN', 'pgsql:host=localhost;port=5432;dbname=proyecto_test;');
define('DB_USER', 'postgres');
define('DB_PASSWORD', 'postgres');

/**
 * Configuración de sesión
 */
// máximo 30 minutos de inactividad
define('SESSION_MAX_INACTIVITY_TIME', 1800);

define('DECIMAL_PRECISION', 0);