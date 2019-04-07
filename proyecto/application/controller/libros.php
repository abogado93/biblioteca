<?php

class Libros extends Controller
{
    public function __construct() {
        parent::__construct(new ReflectionClass($this));
    }

    public function index() {

        Session::checkSession();

        $this->renderView('libros/index.php');
    }


    // Listar registros. Si params == NULL, lista todos, sino lista de acuerdo al filtro.
    public function list(?string ... $params) {

        Session::checkSession();

        $this->logger->debug("Intentando obtener lista de libros");

        try {

            $selectedPage = (isset($_GET['p']) && !empty($_GET['p'])) ? Owasp::sanitize($_GET['p'], 1) : 1;
            $this->customProperties->addProperty('paginator_wrapper', LibroDao::getAllPaginated([], $selectedPage, LibroDao::ROWS_PER_PAGE));

            $this->logger->debug($this->customProperties->getListViewURL());

            $this->renderView($this->customProperties->getListViewURL(), $this->customProperties);

        } catch (PDOException $ex) {

            $this->logger->error("Ocurrió un error al intentar obtener los registros de los libros.");
            $this->renderView( $this->customProperties->getListViewURL(), null);
        }
    }

    public function query(?string ... $filters) {

        Session::checkSession();

        $this->logger->debug("Intentando obtener registros por filtro...");

        if ($filters == null) $this->returnResponse(RequestStatus::OK);

        try {

            $libros = LibroDao::getAllByFilter($filters[0]);

            $this->logger->debug('libros', $libros);

            $this->returnResponse(RequestStatus::OK, $libros);

        } catch (PDOException $e) {

            $this->logger->error("No se pudo obtener la lista de libros. Motivo: " . $e->getMessage());
            $this->returnResponse(RequestStatus::DATABASE_ERROR, "Ocurrió un error al intentar obtener la lista de libros. Por favor, intente de nuevo.");
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

            $this->customProperties->addProperty('libro', LibroDao::getById($id));
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
            $this->logger->debug("Intentando registrar un nuevo libro...");

            $builder = new LibroBuilder(null);

            $builder->libro_nombre = $_POST['nombre'];
            $builder->libro_fecha = $_POST['fecha'];
            $builder->libro_tipo = $_POST['tipo'];
            $builder->libro_estado = $_POST['estado'];
            $builder->libro_precio = $_POST['precio'];
            $builder->libro_existencia = $_POST['existencia'];
            $builder->libro_cantidad = $_POST['cantidad'];
           

            $libro = $builder->build();

            LibroDao::register($libro);

            $this->returnResponse(RequestStatus::OK, URL . $this->customProperties->getListURL());

        } catch (PDOException | RowNotFoundException $ex) {

            if ($ex->getCode() == 23505) {
                $this->logger->error("Ocurrió un error al intentar registrar un nuevo libro. Motivo: " + $ex->getMessage());
                $this->returnResponse(RequestStatus::DUPLICATE_KEY);
            }

            $this->logger->error("Ocurrió un error al intentar registrar un nuevo libro. Motivo: " + $ex->getMessage());
            $this->returnResponse(RequestStatus::DATABASE_ERROR, $ex->getMessage());
        }
    }

    // Elimina un registro
    public function remove() {
        Session::checkSession();

        $this->logger->debug("Intentado eliminar un libro");

        $id = $_POST['id'];

        try {

            LibroDao::removeById($id);
            $this->returnResponse(RequestStatus::OK);

        } catch (PDOException $ex) {

            $this->logger->error($ex->getMessage());
            $this->returnResponse(RequestStatus::DATABASE_ERROR, $ex->getMessage());

        }
    }

    // Modifica un registro
    public function modify() {
        Session::checkSession();

        $this->logger->debug("Intentado modificar un libro");

        $builder = new LibroBuilder($_POST['id']);
        $builder->libro_nombre = $_POST['nombre'];
        $builder->libro_fecha = $_POST['fecha'];
        $builder->libro_tipo = $_POST['tipo'];
        $builder->libro_estado = $_POST['estado'];
        $builder->libro_precio = $_POST['precio'];
        $builder->libro_existencia = $_POST['existencia'];
        $builder->libro_cantidad = $_POST['cantidad'];

        try {

           LibroDao::update($builder->build());
            $this->returnResponse(RequestStatus::OK);

        } catch (PDOException $ex) {

            $this->logger->error($ex->getMessage());
            $this->returnResponse(RequestStatus::DATABASE_ERROR, $ex->getMessage());
        }
    }
}