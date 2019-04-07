<?php

use Monolog\Logger;
use \Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Tebru\Gson\Gson;

abstract class Controller
{

    // Métodos soportados
    const INDEX = "/index/";
    const LIST = "/list/";
    const NEW = "/new/";
    const ADD = "/add/";
    const REMOVE = "/remove/";
    const MODIFY = "/modify/";
    const EDIT = "/edit/";

    protected $logger;
    protected $mapper;
    protected $gson;

    /**
     * @var ControllerCustomProperties
     */
    protected $customProperties;

    // TODO recibir reflection y setear un array con las propiedades generales del controlador (ejemplo: comercios)
    function __construct(ReflectionClass $controller) {

        $controllerFileURL = $controller->getFileName();
        $controllerFileName = basename($controllerFileURL, '.php');

        $this->logger = new Logger($controller->getShortName());

        $formatter = new LineFormatter(null, null, false, true);

        $debugHandler = new StreamHandler(APP . 'logs/debug.log', Logger::DEBUG);
        $debugHandler->setFormatter($formatter);
        $this->logger->pushHandler($debugHandler);

        $errorHandler = new StreamHandler(APP . 'logs/error.log', Logger::ERROR);
        $errorHandler->setFormatter($formatter);
        $this->logger->pushHandler($errorHandler);

        $this->mapper = new JsonMapper();
        $this->gson = Gson::builder()->build();


        $this->filterInputs($_POST);
        $this->filterInputs($_GET);

        $this->setCustomProperties($controllerFileName);
    }

    private function setCustomProperties($controllerName) {

        $this->customProperties = new ControllerCustomProperties();
        $this->customProperties->addProperty('controller_name', $controllerName);

        $this->customProperties->addProperty('index_view', $controllerName . '/' . $controllerName . '_index.php');
        $this->customProperties->addProperty('list_view', $controllerName . '/' . $controllerName . '_list.php');
        $this->customProperties->addProperty('edit_view', $controllerName . '/' . $controllerName . '_edit.php');
        $this->customProperties->addProperty('new_view', $controllerName . '/' . $controllerName . '_new.php');

        $this->customProperties->addProperty('list_url', $controllerName . Controller::LIST);
        $this->customProperties->addProperty('edit_url', $controllerName . Controller::EDIT);
        $this->customProperties->addProperty('new_url', $controllerName . Controller::NEW);
    }

    private function filterInputs(array &$datos) {
        foreach($datos as $key=>&$value) {
            if( is_array($value) ){
                $this->filterInputs($value);
            }
            else $datos[$key] = Owasp::sanitize($value, Owasp::SQL);
        }
    }

    protected function renderView($viewPath, $data = null) {

        require_once APP . 'view/templates/header.php';
        require_once APP . 'view/' . $viewPath;
        require_once APP . 'view/templates/footer.php';
    }

    protected function renderErrorView() {
        require_once APP . 'view/templates/header.php';
        require_once APP . 'view/error/index.php';
        require_once APP . 'view/templates/footer.php';
    }

    protected function returnResponse(string $status, $data = null) {

        $response = new AjaxResponse($status, $data);
        echo json_encode($this->gson->toJsonElement($response));

        exit;
    }

    // página principal
    public abstract function index();

    // lista de registros en formato html / json
    public abstract function list(?string ... $params);

    // registros en formato json
    public abstract function query(?string ... $filters);

    // formulario de registro
    public abstract function new();

    // registro en la base de datos
    public abstract function add();

    // elimina un registro de la base de datos
    public abstract function remove();

    // modifica un registro
    public abstract function modify();

    // formulario de modificación o eliminación
    public abstract function edit($id);
}
