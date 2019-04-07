<?php

/**
 * Created by PhpStorm.
 * User: crojas
 * Date: 2/7/18
 * Time: 10:35
 */
class AjaxResponse
{
    /**
     * @var string
     */
    public $status;

    /**
     * @var object
     */
    public $response;

    /**
     * ApiResponse constructor.
     * @param string $status
     * @param object $response
     */
    public function __construct($status, $response = null)
    {
        $this->status = $status;
        $this->response = $response;
    }
}