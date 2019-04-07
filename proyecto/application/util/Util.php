<?php

/**
 * Created by PhpStorm.
 * User: crojas
 * Date: 6/18/17
 * Time: 11:40
 */

class Util
{
    public static function getRemoteAddress() {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
                        return $ip;
                    }
                }
            }
        }
    }

    public static function checkTimeDiff($from) {

        $dtFrom = DateTime::createFromFormat(DateTime::ATOM, $from);
        $dtFrom->setTimezone(new DateTimeZone('America/Asuncion'));

        $current = date('c');

        $dtLocal = DateTime::createFromFormat(DateTime::ATOM, $current, new DateTimeZone('America/Asuncion'));

        //Valor absoluto
        return  abs(strtotime($dtLocal->format(DateTime::ATOM)) - strtotime($dtFrom->format(DateTime::ATOM)));
    }

    public static function getDateTimeDiff($from) {
        return  abs(strtotime(date("Y-m-d H:i:s")) - strtotime($from));
    }

    public static function generateToken() {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            // 16 bits for "time_mid"
            mt_rand(0, 0xffff),
            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000,
            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000,
            // 48 bits for "node"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }

    public static function getCurrentTimestamp() {
        return (
            new DateTime(null, new DateTimeZone('America/Asuncion'))
        )
            ->format(DateTime::ATOM);
    }

    public static function isValidTimezoneId($timezoneId) {
        $zoneList = timezone_identifiers_list();
        return in_array($timezoneId, $zoneList);
    }
}