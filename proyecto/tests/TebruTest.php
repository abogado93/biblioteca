<?php
/**
 * Created by PhpStorm.
 * User: crojas
 * Date: 1/31/19
 * Time: 17:51
 */

use PHPUnit\Framework\TestCase;
use Tebru\Gson\Gson;

class TebruTest extends TestCase {

    private $gson;

    public function __construct() {
        parent::__construct();

        $this->gson = Gson::builder()->build();
    }

    public function testConvertObjectToJsonStringWithTebru() {

        $response = new AjaxResponse("OK", "hola mundo");
        $jsonElement = $this->gson->toJsonElement($response);

        echo json_encode($jsonElement);

        echo "\r\n\r\n";
    }

}