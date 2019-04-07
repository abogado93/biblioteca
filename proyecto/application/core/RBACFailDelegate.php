<?php
/**
 * Created by PhpStorm.
 * User: crojas
 * Date: 2/19/18
 * Time: 16:26
 */

class RBACFailDelegate implements RBACDelegate
{

    public function failFriendly() {
        header('location: ' . URL . 'not_authorized');
        exit;
    }
}