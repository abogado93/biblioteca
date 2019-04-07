<?php

/**
 * Created by PhpStorm.
 * User: crojas
 * Date: 6/17/17
 * Time: 09:20
 */

class Connection {

    static private $conn = NULL;
    static private $driver_options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    private function __construct(){}

    private static function connect() {
        self::$conn = new PDO(DSN, DB_USER, DB_PASSWORD, self::$driver_options);
    }

    /**
     * @return PDO
     */
    public static function getConnection() {
        if(is_null(self::$conn)) {
            self::connect();
        }

        return self::$conn;
    }
}