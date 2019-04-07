<?php
/**
 * Created by PhpStorm.
 * User: crojas
 * Date: 2/13/18
 * Time: 15:27
 */

class Usuarios extends Controller
{

    public function __construct() {
        parent::__construct(new ReflectionClass($this));
    }

    public function index() {
        Session::checkSession();
        $this->renderView("usuarios/index.php");
    }

    public function list(?string ... $params) {

        Session::checkSession();

        $this->logger->debug("Intentando obtener lista de usuarios");

        try {

            $selectedPage = (isset($_GET['p']) && !empty($_GET['p'])) ? $_GET['p'] : 1;

            $filter = null;

            $paginatorWrapper = UsuarioDao::getAllPaginated($filter, $selectedPage, UsuarioDao::ROWS_PER_PAGE);
            $this->customProperties->addProperty('paginator_wrapper', $paginatorWrapper);

            $this->renderView($this->customProperties->getListViewURL(), $this->customProperties);

        } catch (PDOException | RowNotFoundException $e) {

            $this->logger->error("No se pudo obtener la lista de usuarios. Motivo: " . $e->getMessage());
            $this->renderErrorView();
        }
    }

    public function new() {

        Session::checkSession();
        $formSignature = Util::generateToken();

        Session::write("users_add_fs", $formSignature);

        try {

            $this->customProperties->addProperty('users_add_fs', $formSignature);

            $this->renderView($this->customProperties->getRegisterViewURL(), $this->customProperties);

        } catch (PDOException $e) {

            $this->logger->error("No se pudo obtener la lista de tipos de documentos. Motivo: " . $e->getMessage());
            $this->renderErrorView();
        }
    }

    public function add() {

        Session::checkSession();

        if (Session::read('users_add_fs') !== $_POST['users_add_fs']) {
            $this->returnResponse(RequestStatus::NOT_AUTHORIZED);
        }

        try {

            $builder = new UsuarioBuilder($_POST['usuario']);
            $builder->nombres = $_POST['nombres'];
            $builder->apellidos = $_POST['apellidos'];
            $builder->password = PasswordUtil::createHash($_POST['pass1']);
            $builder->bloqueado = false;

            UsuarioDao::register($builder->build());

            $this->returnResponse(RequestStatus::OK, "Usuario registrado correctamente.");

        } catch (PDOException $e) {

            if ($e->getCode() == 23505) {
                $this->logger->error("Ya existe un cliente con la dirección de email ingresada.");
                $this->returnResponse(RequestStatus::DATABASE_ERROR, "Ya existe un cliente con la dirección de email ingresada.");
            }

            $this->logger->error("No se pudo registrar el usuario. Motivo: " . $e->getMessage());
            $this->returnResponse(RequestStatus::DATABASE_ERROR, "No se pudo realizar el registro del usuario. Por favor, intente de nuevo.");

        } catch (Exception $e) {

            $this->logger->error("No se pudo registrar el usuario. Motivo: " . $e->getMessage());
            $this->returnResponse(RequestStatus::DATABASE_ERROR, "El proceso de registro no pudo ser completado. Por favor, intente de nuevo.");
        }
    }

    public function remove() {

        $uBuilder = new UsuarioBuilder("");
        $uBuilder->id = $_POST['user_id'];

        try {

            UsuarioDao::blockUser($uBuilder->build());
            $this->returnResponse(RequestStatus::OK);

        } catch (Exception $e) {

            $this->logger->debug(RequestStatus::DATABASE_ERROR, "No se pudo realizar el bloqueo del usuario. Motivo: " . $e->getMessage());
            $this->returnResponse(RequestStatus::DATABASE_ERROR, "No se pudo realizar el bloqueo del usuario. Por favor, intente de nuevo.");
        }

    }

    public function modify() {

        if (Session::read('users_edit_fs') !== $_POST['users_edit_fs']) {
            $this->returnResponse(RequestStatus::NOT_AUTHORIZED);
        }

        $id = $_POST['user_id'];

        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $usuario = $_POST['usuario'];
        $blocked = isset($_POST['user_blocked']);

        $uBuilder = new UsuarioBuilder($usuario);

        $uBuilder->id = $id;
        $uBuilder->bloqueado = $blocked;
        $uBuilder->nombres = $nombres;
        $uBuilder->apellidos = $apellidos;

        try {

            UsuarioDao::update($uBuilder->build());
            $this->returnResponse(RequestStatus::OK);

        } catch (PDOException $e) {

            $this->logger->error("No se pudo actualizar el registro del usuario. Motivo: " . $e->getMessage());
            $this->logger->debug($e->getCode());
            if ($e->getCode() == 23505) {
                $this->returnResponse(RequestStatus::DUPLICATE_KEY, "El identificador ingresado ya está asignado a otro usuario. Por favor, modifique.");
            }

            $this->returnResponse(RequestStatus::DATABASE_ERROR, "No se pudo actualizar el registro del usuario. Por favor, intente de nuevo.");
        }
    }

    public function edit($id) {

        Session::checkSession();
        $formSignature = Util::generateToken();

        Session::write("users_edit_fs", $formSignature);

        try {

            $usuario = UsuarioDao::getById($id);

            $data = [
                'user_to_edit' => $usuario,
                'users_edit_fs' => $formSignature
            ];

            $this->customProperties
                ->addProperty('user_to_edit', $usuario)
                ->addProperty('users_edit_fs', $formSignature);


            $this->renderView($this->customProperties->getEditViewURL(), $this->customProperties);

        } catch (RowNotFoundException $e) {

            $this->logger->error("El usuario a editar no existe: " . $id);
            $this->returnResponse(RequestStatus::ROW_NOT_FOUND, "El usuario no fue encontrado.");
        }


    }

    public function query(?string ... $filters)
    {
        // TODO: Implement query() method.
    }
}