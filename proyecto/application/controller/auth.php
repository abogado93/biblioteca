<?php
/**
 * Created by PhpStorm.
 * User: crojas
 * Date: 2/12/18
 * Time: 13:30
 */

final class Auth extends Controller
{

    public function __construct() {
        parent::__construct(new ReflectionClass($this));
    }

    public function index() {
        require_once APP . 'view/auth/index.php';
    }

    public function login() : void {

        if (Session::read('signature') == $_POST['fs']) {

            $this->logger->debug("Intentando autenticacion...");

            $usuario = Owasp::sanitize($_POST['usuario'], Owasp::SQL);
            $passwordSent = Owasp::sanitize($_POST['password'], Owasp::SQL);

            try {

                $user = UsuarioDao::getByUserIdentifier($usuario);

                if (PasswordUtil::validatePassword($passwordSent, $user->getPassword())) {

                    Session::write("logged", true);
                    Session::write("name", $user->getNombres());
                    Session::write("user", $user->getId());

                    $this->returnResponse(RequestStatus::OK, "home");

                } else {

                    $this->returnResponse(RequestStatus::NOT_AUTHORIZED, "Las credenciales no son válidas");
                }

            } catch (PDOException | RowNotFoundException $e) {

                $this->logger->error("El usuario ingresado no es válido: " . $usuario);
                $this->returnResponse(RequestStatus::NOT_AUTHORIZED, "Las credenciales no son válidas");
            }
        }
    }

    public function list(?string ... $params) {
        throw new \RuntimeException("Method not available");
    }

    public function new() {
        throw new \RuntimeException("Method not available");
    }

    public function add() {
        throw new \RuntimeException("Method not available");
    }

    public function remove() {
        throw new \RuntimeException("Method not available");
    }

    public function modify() {
        throw new \RuntimeException("Method not available");
    }

    public function edit($id) {
        throw new \RuntimeException("Method not available");
    }

    public function query(? string ... $filters) {
        throw new \RuntimeException("Method not available");
    }
}