<?php
/**
 * Created by PhpStorm.
 * User: crojas
 * Date: 6/17/17
 * Time: 23:51
 */

trait Redirection {
    /**
     * @param $url
     */
    static function redirect($url) {

        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            
            new AjaxResponse(RequestStatus::SESSION_EXPIRED);
            
        } else {
            header("location: {$url}");
            exit;   
        }
    }
}