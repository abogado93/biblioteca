<?php

/**
 * Created by PhpStorm.
 * User: crojas
 * Date: 6/17/17
 * Time: 23:48
 */

class SessionHandlerException extends Exception {}
class ExpiredSessionException extends SessionHandlerException {}

class Session
{
    const LOGIN_URL = URL . "auth";

    public static function checkSession() {
        self::_init();

        if(!isset($_SESSION["logged"]) || $_SESSION["logged"] !== true) {
            self::redirect(self::LOGIN_URL);
        }

        self::_age();
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public static function write($key, $value) {

        if (!session_id())
            self::_init();

        $_SESSION[$key] = $value;
        self::_age();
        return $value;
    }

    /**
     * @param $key
     * @param bool $child
     * @return null
     */
    public static function read($key, $child = false) {

        if (!session_id())
            self::_init();

        if (isset($_SESSION[$key])) {
            self::_age();

            if (false == $child) {

                return $_SESSION[$key];

            } else {

                if (isset($_SESSION[$key][$child])) {

                    return $_SESSION[$key][$child];
                }
            }
        }
        return null;
    }

    public static function keyExists($key) {
        return isset($_SESSION[$key]);
    }

    /**
     * @param $key
     */
    public static function delete($key) : void {

        self::_init();
        unset($_SESSION[$key]);
        self::_age();
    }

    public static function dump() {
        self::_init();
        echo nl2br(print_r($_SESSION));
    }
    /**
     * Inicia o resume una sesion.
     *
     * @see Session::_init()
     * @return boolean true: ok, false: boom!
     */
    public static function start() {
        // this function is extraneous
        return self::_init();
    }

    /**
     * @return void
     * Redirect: Cuando se quiere modificar valores en una sesión expirada
     */
    private static function _age() {
        $last = isset($_SESSION['LAST_ACTIVE']) ? $_SESSION['LAST_ACTIVE'] : false ;

        if (false !== $last && (time() - $last > SESSION_MAX_INACTIVITY_TIME))  {
            self::destroy();

            self::redirect(self::LOGIN_URL);
        }

        $_SESSION['LAST_ACTIVE'] = time();
    }

    /**
     * @return array asociativo de los parámetros de la sesión
     */
    public static function params() {
        $r = [];
        if ('' !== session_id()) {
            $r = session_get_cookie_params();
        }
        return $r;
    }

    /**
     * Cierra la sesión actual y libera el archivo de sesión
     */
    public static function close() {

        if ('' !== session_id()) {
            session_write_close();
        }

        return true;
    }

    /**
     * Elimina los datos y la sesión actual
     *
     * @return void
     */
    public static function destroy() {
        if ( '' !== session_id() ) {
            $_SESSION = array();

            // If it's desired to kill the session, also delete the session cookie.
            // Note: This will destroy the session, and not just the session data!
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }

            session_unset();
            session_destroy();
        }
    }

    public static function sessionExists() {

        self::_init();

        if(isset($_SESSION["logged"]) && $_SESSION["logged"] === true) {
            return true;
        }

        return false;
    }

    public static function logout() {
        self::destroy();
        self::close();
        self::redirect(self::LOGIN_URL);
    }

    /**
     * Inicializa o resume una sesión
     */
    private static function _init() : bool {

        if (!session_id() )  {
            session_start();
            return session_regenerate_id();
        }

        return false;
    }

    private static function redirect($url) {

        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

            die (json_encode(["status" => RequestStatus::SESSION_EXPIRED]));

        } else {
            header("location: {$url}");
            exit;
        }
    }
}