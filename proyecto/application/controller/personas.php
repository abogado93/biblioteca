<?php


class Personas extends Controller
{
    public function __construct() {
        parent::__construct(new ReflectionClass($this));
    }

    public function index() {

        Session::checkSession();

        $this->renderView('personas/index.php');
    }


    // Listar registros. Si params == NULL, lista todos, sino lista de acuerdo al filtro.
    public function list(?string ... $params) {

        Session::checkSession();

        $this->logger->debug("Intentando obtener lista de personas");

        try {

            $selectedPage = (isset($_GET['p']) && !empty($_GET['p'])) ? Owasp::sanitize($_GET['p'], 1) : 1;
            $this->customProperties->addProperty('paginator_wrapper', PersonaDao::getAllPaginated([], $selectedPage, PersonaDao::ROWS_PER_PAGE));

            $this->logger->debug($this->customProperties->getListViewURL());

            $this->renderView($this->customProperties->getListViewURL(), $this->customProperties);

        } catch (PDOException $ex) {

            $this->logger->error("Ocurrió un error al intentar obtener los registros de personas.");
            $this->renderView( $this->customProperties->getListViewURL(), null);
        }
    }

    public function query(?string ... $filters) {

        Session::checkSession();

        $this->logger->debug("Intentando obtener registros por filtro...");

        if ($filters == null) $this->returnResponse(RequestStatus::OK);

        try {

            $personas = PersonaDao::getAllByFilter($filters[0]);

            $this->logger->debug('personas', $personas);

            $this->returnResponse(RequestStatus::OK, $personas);

        } catch (PDOException $e) {

            $this->logger->error("No se pudo obtener la lista de personas. Motivo: " . $e->getMessage());
            $this->returnResponse(RequestStatus::DATABASE_ERROR, "Ocurrió un error al intentar obtener la lista de personas. Por favor, intente de nuevo.");
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

            $this->customProperties->addProperty('persona', PersonaDao::getById($id));
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
            $this->logger->debug("Intentando registrar una nueva persona...");

            $builder = new PersonaBuilder(null);

            $builder->persona_nombre = $_POST['nombre'];
            $builder->persona_apellido = $_POST['apellido'];
            $builder->persona_cedula = $_POST['cedula'];
            $builder->persona_telefono = $_POST['telefono'];
            $builder->persona_direccion = $_POST['direccion'];
            $builder->persona_sexo = $_POST['sexo'];
            $builder->persona_fecha = $_POST['fecha'];
        

            $persona = $builder->build();

            PersonaDao::register($persona);

            $this->returnResponse(RequestStatus::OK, URL . $this->customProperties->getListURL());

        } catch (PDOException | RowNotFoundException $ex) {

            if ($ex->getCode() == 23505) {
                $this->logger->error("Ocurrió un error al intentar registrar una nueva persona. Motivo: " + $ex->getMessage());
                $this->returnResponse(RequestStatus::DUPLICATE_KEY);
            }

            $this->logger->error("Ocurrió un error al intentar registrar una nueva persona. Motivo: " + $ex->getMessage());
            $this->returnResponse(RequestStatus::DATABASE_ERROR, $ex->getMessage());
        }
    }

    // Elimina un registro
    public function remove() {
        Session::checkSession();

        $this->logger->debug("Intentado eliminar una persona");

        $id = $_POST['id'];

        try {

            PersonaDao::removeById($id);
            $this->returnResponse(RequestStatus::OK);

        } catch (PDOException $ex) {

            $this->logger->error($ex->getMessage());
            $this->returnResponse(RequestStatus::DATABASE_ERROR, $ex->getMessage());

        }
    }

    // Modifica un registro
    public function modify() {
        Session::checkSession();

        $this->logger->debug("Intentado modificar una persona");

        $builder = new PersonaBuilder($_POST['id']);
       $builder->persona_nombre = $_POST['nombre'];
            $builder->persona_apellido = $_POST['apellido'];
            $builder->persona_cedula = $_POST['cedula'];
            $builder->persona_telefono = $_POST['telefono'];
            $builder->persona_direccion = $_POST['direccion'];
            $builder->persona_sexo = $_POST['sexo'];
            $builder->persona_fecha = $_POST['fecha'];

        try {

            PersonaDao::update($builder->build());
            $this->returnResponse(RequestStatus::OK);

        } catch (PDOException $ex) {

            $this->logger->error($ex->getMessage());
            $this->returnResponse(RequestStatus::DATABASE_ERROR, $ex->getMessage());
        }
    }
}