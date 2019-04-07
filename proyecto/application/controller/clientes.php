<?php

/**
 * Created by PhpStorm.
 * User: crojas
 * Date: 1/9/18
 * Time: 10:00
 */

class Clientes extends Controller
{
    public function __construct() {
        parent::__construct(new ReflectionClass($this));
    }

    public function index() {

        Session::checkSession();

        $this->renderView('comercios/index.php');
    }


    // Listar registros. Si params == NULL, lista todos, sino lista de acuerdo al filtro.
    public function list(?string ... $params) {

        Session::checkSession();

        $this->logger->debug("Intentando obtener lista de clientes");

        try {

            $selectedPage = (isset($_GET['p']) && !empty($_GET['p'])) ? Owasp::sanitize($_GET['p'], 1) : 1;
            $this->customProperties->addProperty('paginator_wrapper', ClienteDao::getAllPaginated([], $selectedPage, ClienteDao::ROWS_PER_PAGE));

            $this->logger->debug($this->customProperties->getListViewURL());

            $this->renderView($this->customProperties->getListViewURL(), $this->customProperties);

        } catch (PDOException $ex) {

            $this->logger->error("Ocurrió un error al intentar obtener los registros de comercios.");
            $this->renderView( $this->customProperties->getListViewURL(), null);
        }
    }

    public function query(?string ... $filters) {

        Session::checkSession();

        $this->logger->debug("Intentando obtener registros por filtro...");

        if ($filters == null) $this->returnResponse(RequestStatus::OK);

        try {

            $clientes = ClienteDao::getAllByFilter($filters[0]);

            $this->logger->debug('clientes', $clientes);

            $this->returnResponse(RequestStatus::OK, $clientes);

        } catch (PDOException $e) {

            $this->logger->error("No se pudo obtener la lista de comercios. Motivo: " . $e->getMessage());
            $this->returnResponse(RequestStatus::DATABASE_ERROR, "Ocurrió un error al intentar obtener la lista de comercios. Por favor, intente de nuevo.");
        }
    }

    // Muestra el formulario de registro
    public function new() {

        Session::checkSession();
        $this->renderView($this->customProperties->getRegisterViewURL(), $this->customProperties);
    }

    public function edit($id) {
        Session::checkSession();

        try {

            $this->customProperties->addProperty('cliente', ClienteDao::getById($id));
            $this->renderView($this->customProperties->getEditViewURL(), $this->customProperties);

        } catch (PDOException $ex) {

            $this->logger->error($ex->getMessage());
            $this->renderView($this->customProperties->getEditViewURL(), null);
        }
    }


    // Añade un nuevo registro
    public function add() {

        Session::checkSession();

        try {
            $this->logger->debug("Intentando registrar un nuevo comercio...");

            $builder = new ClienteBuilder(null);

            $builder->ruc = $_POST['ruc'];
            $builder->nombreFantasia = $_POST['nombre-fantasia'];
            $builder->razonSocial = $_POST['razon-social'];
            $builder->email = $_POST['email'];
            $builder->telefono = $_POST['telefono'];
            $builder->direccion = $_POST['direccion'];
            $builder->observaciones = $_POST['observaciones'];
            $builder->usuarioAlta = UsuarioDao::getById(Session::read('user'));

            $cliente = $builder->build();

            ClienteDao::register($cliente);

            $this->returnResponse(RequestStatus::OK, URL . $this->customProperties->getListURL());

        } catch (PDOException | RowNotFoundException $ex) {

            if ($ex->getCode() == 23505) {
                $this->logger->error("Ocurrió un error al intentar registrar un nuevo cliente. Motivo: " + $ex->getMessage());
                $this->returnResponse(RequestStatus::DUPLICATE_KEY);
            }

            $this->logger->error("Ocurrió un error al intentar registrar un nuevo cliente. Motivo: " + $ex->getMessage());
            $this->returnResponse(RequestStatus::DATABASE_ERROR, $ex->getMessage());
        }
    }

    // Elimina un registro
    public function remove() {
        Session::checkSession();

        $this->logger->debug("Intentado eliminar un comercio");

        $id = $_POST['id'];

        try {

            ClienteDao::removeById($id);
            $this->returnResponse(RequestStatus::OK);

        } catch (PDOException $ex) {

            $this->logger->error($ex->getMessage());
            $this->returnResponse(RequestStatus::DATABASE_ERROR, $ex->getMessage());

        }
    }

    // Modifica un registro
    public function modify() {
        Session::checkSession();

        $this->logger->debug("Intentado modificar un cliente");

        $builder = new ClienteBuilder($_POST['id']);
        $builder->ruc = $_POST['ruc'];
        $builder->nombreFantasia = $_POST['nombre-fantasia'];
        $builder->razonSocial = $_POST['razon-social'];
        $builder->email = $_POST['email'];
        $builder->telefono = $_POST['telefono'];
        $builder->direccion = $_POST['direccion'];
        $builder->observaciones = $_POST['observaciones'];

        try {

            ClienteDao::update($builder->build());
            $this->returnResponse(RequestStatus::OK);

        } catch (PDOException $ex) {

            $this->logger->error($ex->getMessage());
            $this->returnResponse(RequestStatus::DATABASE_ERROR, $ex->getMessage());
        }
    }
}