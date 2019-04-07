<?php

class Prestamos extends Controller
{
    public function __construct() {
        parent::__construct(new ReflectionClass($this));
    }

    public function index() {

        Session::checkSession();

        $this->renderView('prestamos/index.php');
    }


    // Listar registros. Si params == NULL, lista todos, sino lista de acuerdo al filtro.
    public function list(?string ... $params) {

        Session::checkSession();

        $this->logger->debug("Intentando obtener lista de prestamos");

        try {

            $selectedPage = (isset($_GET['p']) && !empty($_GET['p'])) ? Owasp::sanitize($_GET['p'], 1) : 1;
            $this->customProperties->addProperty('paginator_wrapper', PrestamoDao::getAllPaginated([], $selectedPage, PrestamoDao::ROWS_PER_PAGE));

            $this->logger->debug($this->customProperties->getListViewURL());

            $this->renderView($this->customProperties->getListViewURL(), $this->customProperties);

        } catch (PDOException $ex) {

            $this->logger->error("Ocurrió un error al intentar obtener los registros de prestamos.");
            $this->renderView( $this->customProperties->getListViewURL(), null);
        }
    }

    public function query(?string ... $filters) {

        Session::checkSession();

        $this->logger->debug("Intentando obtener registros por filtro...");

        if ($filters == null) $this->returnResponse(RequestStatus::OK);

        try {

            $prestamos= PrestamoDao::getAllByFilter($filters[0]);

            $this->logger->debug('prestamos', $prestamos);

            $this->returnResponse(RequestStatus::OK, $prestamos);

        } catch (PDOException $e) {

            $this->logger->error("No se pudo obtener la lista de prestamos. Motivo: " . $e->getMessage());
            $this->returnResponse(RequestStatus::DATABASE_ERROR, "Ocurrió un error al intentar obtener la lista de prestamos. Por favor, intente de nuevo.");
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

            $this->customProperties->addProperty('prestamo', PrestamoDao::getById($id));
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
            $this->logger->debug("Intentando registrar un nuevo prestamo...");

            $builder = new PrestamoBuilder(null);

            $builder->prestamo_fecha = $_POST['fecha'];
            $builder->prestamo_estado = $_POST['estado'];
            $builder->prestamo_persona = $_POST['persona'];
            $builder->prestamo_libro_id = $_POST['libro'];
            $builder->prestamo_devolucion = $_POST['devolucion'];
            $builder->prestamo_dias = $_POST['dias'];
            $builder->prestamo_cantidad = $_POST['cantidad'];
			
           

            $prestamo = $builder->build();

            PrestamoDao::register($prestamo);

            $this->returnResponse(RequestStatus::OK, URL . $this->customProperties->getListURL());

        } catch (PDOException | RowNotFoundException $ex) {

            if ($ex->getCode() == 23505) {
                $this->logger->error("Ocurrió un error al intentar registrar un nuevo prestamo. Motivo: " + $ex->getMessage());
                $this->returnResponse(RequestStatus::DUPLICATE_KEY);
            }

            $this->logger->error("Ocurrió un error al intentar registrar un nuevo prestamo. Motivo: " + $ex->getMessage());
            $this->returnResponse(RequestStatus::DATABASE_ERROR, $ex->getMessage());
        }
    }

    // Elimina un registro
    public function remove() {
        Session::checkSession();

        $this->logger->debug("Intentado eliminar un prestamo");

        $id = $_POST['id'];

        try {

            PrestamoDao::removeById($id);
            $this->returnResponse(RequestStatus::OK);

        } catch (PDOException $ex) {

            $this->logger->error($ex->getMessage());
            $this->returnResponse(RequestStatus::DATABASE_ERROR, $ex->getMessage());

        }
    }

    // Modifica un registro
    public function modify() {
        Session::checkSession();

        $this->logger->debug("Intentado modificar un prestamo");

        $builder = new PrestamoBuilder($_POST['id']);
         $builder->prestamo_fecha = $_POST['fecha'];
            $builder->prestamo_estado = $_POST['estado'];
            $builder->prestamo_persona = $_POST['persona'];
            $builder->prestamo_libro_id = $_POST['libro'];
            $builder->prestamo_devolucion = $_POST['devolucion'];
            $builder->prestamo_dias = $_POST['dias'];
            $builder->prestamo_cantidad = $_POST['cantidad'];
		

        try {

            PrestamoDao::update($builder->build());
            $this->returnResponse(RequestStatus::OK);

        } catch (PDOException $ex) {

            $this->logger->error($ex->getMessage());
            $this->returnResponse(RequestStatus::DATABASE_ERROR, $ex->getMessage());
        }
    }
}