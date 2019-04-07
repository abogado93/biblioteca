<?php

/**
 * Created by PhpStorm.
 * User: crojas
 * Date: 2/6/18
 * Time: 17:27
 */
interface IPaginator
{
    public static function getAllPaginated(Array $filters, $page, $rowsPerPage);
}