<?php


class Devoluciones extends Controller
{
    public function __construct() {
        parent::__construct(new ReflectionClass($this));
    }

    public function index() {

        Session::checkSession();

        $this->renderView('devoluciones/index.php');
    }


    // Listar registros. Si params == NULL, lista todos, sino lista de acuerdo al filtro.
    public function list(?string ... $params) {

        Session::checkSession();

        $this->logger->debug("Intentando obtener lista de devoluciones");

        try {

            $selectedPage = (isset($_GET['p']) && !empty($_GET['p'])) ? Owasp::sanitize($_GET['p'], 1) : 1;
            $this->customProperties->addProperty('paginator_wrapper', DevolucionDao::getAllPaginated([], $selectedPage, DevolucionDao::ROWS_PER_PAGE));

            $this->logger->debug($this->customProperties->getListViewURL());

            $this->renderView($this->customProperties->getListViewURL(), $this->customProperties);

        } catch (PDOException $ex) {

            $this->logger->error("Ocurrió un error al intentar obtener los registros de la devolucion.");
            $this->renderView( $this->customProperties->getListViewURL(), null);
        }
    }

    public function query(?string ... $filters) {

        Session::checkSession();

        $this->logger->debug("Intentando obtener registros por filtro...");

        if ($filters == null) $this->returnResponse(RequestStatus::OK);

        try {

            $devoluciones = DevolucionDao::getAllByFilter($filters[0]);

            $this->logger->debug('devoluciones', $devoluciones);

            $this->returnResponse(RequestStatus::OK, $devoluciones);

        } catch (PDOException $e) {

            $this->logger->error("No se pudo obtener la lista de devoluciones. Motivo: " . $e->getMessage());
            $this->returnResponse(RequestStatus::DATABASE_ERROR, "Ocurrió un error al intentar obtener la lista de devoluciones. Por favor, intente de nuevo.");
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

            $this->customProperties->addProperty('devolucion', DevolucionDao::getById($id));
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
            $this->logger->debug("Intentando registrar una nueva devolucion...");

            $builder = new DevolucionBuilder(null);

            $builder->devolucion_fecha = $_POST['fecha'];
            $builder->devolucion_devolucion = $_POST['devuelto'];
            $builder->devolucion_persona = $_POST['persona'];
            $builder->devolucion_estado = $_POST['estado'];
            $builder->devolucion_libro_id = $_POST['libro'];
          
          

            $devolucion = $builder->build();

            DevolucionDao::register($devolucion);

            $this->returnResponse(RequestStatus::OK, URL . $this->customProperties->getListURL());

        } catch (PDOException | RowNotFoundException $ex) {

            if ($ex->getCode() == 23505) {
                $this->logger->error("Ocurrió un error al intentar registrar una nueva devolucion. Motivo: " + $ex->getMessage());
                $this->returnResponse(RequestStatus::DUPLICATE_KEY);
            }

            $this->logger->error("Ocurrió un error al intentar registrar una nueva devolucion. Motivo: " + $ex->getMessage());
            $this->returnResponse(RequestStatus::DATABASE_ERROR, $ex->getMessage());
        }
    }

    // Elimina un registro
    public function remove() {
        Session::checkSession();

        $this->logger->debug("Intentado eliminar una devolucion");

        $id = $_POST['id'];

        try {

            DevolucionDao::removeById($id);
            $this->returnResponse(RequestStatus::OK);

        } catch (PDOException $ex) {

            $this->logger->error($ex->getMessage());
            $this->returnResponse(RequestStatus::DATABASE_ERROR, $ex->getMessage());

        }
    }

    // Modifica un registro
    public function modify() {
        Session::checkSession();

        $this->logger->debug("Intentado modificar una devolucion");

        $builder = new DevolucionBuilder($_POST['id']);
        $builder->devolucion_fecha = $_POST['fecha'];
        $builder->devolucion_devolucion = $_POST['devuelto'];
        $builder->devolucion_persona = $_POST['persona'];
        $builder->devolucion_estado = $_POST['estado'];
        $builder->devolucion_libro_id = $_POST['libro'];
        

        try {

            DevolucionDao::update($builder->build());
            $this->returnResponse(RequestStatus::OK);

        } catch (PDOException $ex) {

            $this->logger->error($ex->getMessage());
            $this->returnResponse(RequestStatus::DATABASE_ERROR, $ex->getMessage());
        }
    }
}