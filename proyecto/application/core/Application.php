<?php

use Monolog\Logger;
use \Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;

class Application
{

    private $logger;
    /**
     * @var null controlador
     */
    private $url_controller = null;

    /**
     * @var null acción por controlador
     */
    private $url_action = null;

    /**
     * @var array parámetros de la acción
     */
    private $url_params = array();

    /**
     * Inicia la aplicación.
     * Analiza la URL e invoca a su controlador correspondiente
     */
    public function __construct() {

        // Logger setup
        $this->logger = new Logger((new ReflectionClass($this))->getShortName());

        $formatter = new LineFormatter(null, null, false, true);

        $debugHandler = new StreamHandler(APP . 'logs/debug.log', Logger::DEBUG);
        $debugHandler->setFormatter($formatter);
        $this->logger->pushHandler($debugHandler);

        // process request
        $this->processRequest();
    }

    private function processRequest() {

        // Array de partes de la URL
        $this->splitUrl();

        if (!$this->url_controller) {
            $this->redirectHome();
        }

        if (file_exists( $filename = APP . 'controller/' . $this->url_controller . '.php')) {

            $controllerClass = $this->realControllerClassName();
            $controllerAction = $this->realActionName();

            // Validación del método: existe el método en el controlador?
            if (method_exists($controllerClass, $controllerAction)) {

                if (!empty($this->url_params)) {

                    // Invocar al método pasándole los parámetros enviados via URL
                    call_user_func_array(array($controllerClass, $controllerAction), $this->url_params);
                } else {

                    // Si no se enviaron parámetros, simplemente se invoca el método sin especificar ningún parámetro
                    $controllerClass->{$controllerAction}();
                }

            } else {

                $controllerClass->index();
            }

        } else {
            header('location: ' . URL . 'not_found');
            exit;
        }

    }

    /**
     * Obtener información de la URL
     */
    private function splitUrl() {

        if (isset($_GET['url'])) {

            // split URL
            $url = trim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            // Mapeo URL -> controlador -> accion
            $this->url_controller = isset($url[0]) ? $url[0] : null;
            $this->url_action = isset($url[1]) ? $url[1] : null;

            unset($url[0], $url[1]);

            // Guardamos los parametros enviados vía URL
            $this->url_params = array_values($url);
        }
    }

    private function realControllerClassName() {

        $parts = explode("_", $this->url_controller);

        $mClass = "";

        foreach ($parts as $part) {
            $mClass .= ucfirst($part);
        }

        $mClass = preg_replace("/[^a-zA-Z0-9]+/", "", $mClass);

        return new $mClass();
    }

    private function realActionName() {

        $this->url_action = preg_replace("/[^a-zA-Z0-9]+/", "", $this->url_action);

        return $this->url_action;
    }

    private function redirectHome() {

        $this->logger->debug("Redirecting home...");
        $page = new Home();
        $page->index();

        exit;
    }
}
