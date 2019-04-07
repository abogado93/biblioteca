<?php
/**
 * Created by PhpStorm.
 * User: crojas
 * Date: 2/19/18
 * Time: 13:49
 */

Class Roles {

    const MASTER = 'master';
    const ADMINISTRATOR = 'admin';
    const REPORTER = 'reporter';

}

final class RBAC
{

    private static $permissionFilePath = '/roles_permissions.json';

    private function __construct(){}

    /**
     * @param string $controller
     * @param string $method
     * @param string $userRole
     * @param RBACDelegate $delegate
     */
    public static function checkUserRolePermission(string $controller, string $method, $userRole, RBACDelegate $delegate) : void {

        $json_permissions = file_get_contents(dirname(__FILE__) . self::$permissionFilePath);

        $permissions = json_decode($json_permissions, true);

        if (!isset($permissions[$controller][$method][$userRole]) || ($permissions[$controller][$method][$userRole] === false)) {
            $delegate->failFriendly();
        }
    }
}