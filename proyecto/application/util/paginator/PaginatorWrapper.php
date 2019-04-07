<?php

/**
 * Created by PhpStorm.
 * User: crojas
 * Date: 2/6/18
 * Time: 17:17
 */
class PaginatorWrapper
{

    private $paginator;
    private $rows;

    /**
     * PaginatorWrapper constructor.
     * @param $paginator
     * @param $rows
     */
    private function __construct($paginator, $rows) {
        $this->paginator = $paginator;
        $this->rows = $rows;
    }

    /**
     * @return mixed
     */
    public function getPaginator() {
        return $this->paginator;
    }

    /**
     * @return mixed
     */
    public function getRows() {
        return $this->rows;
    }

    public function getRowCount() {
        return count($this->rows);
    }

    public static function build($paginator, $rows) {
        return new self($paginator, $rows);
    }

}