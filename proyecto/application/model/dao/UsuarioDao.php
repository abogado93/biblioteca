<?php
/**
 * Created by PhpStorm.
 * User: crojas
 * Date: 2/12/18
 * Time: 11:25
 */

class UsuarioDao
{
    const TABLE_NAME = "usuarios";

    const ROWS_PER_PAGE = 10;

    /**
     * @param Usuario $usuario
     * @throws PDOException
     */
    public static function register(Usuario $usuario) : void {

        Connection::getConnection()
            ->prepare("INSERT INTO " . self::TABLE_NAME . " (usuario, nombres, apellidos, password, salt, ultimo_acceso, acceso_intentos, bloqueado) VALUES (?, ?, ?, ?, ?, ?, ?, ?)")
            ->execute([
                $usuario->getUsuario(),
                $usuario->getNombres(),
                $usuario->getApellidos(),
                $usuario->getPassword()->getHash(),
                $usuario->getPassword()->getSalt(),
                $usuario->getUltimoAcceso(),
                $usuario->getAccesoIntentos(),
                $usuario->isBloqueado()
            ]);
    }

    public static function getAll(int $comercioId = null) : array {

        $cursor = Connection::getConnection()->prepare("SELECT * FROM " . self::TABLE_NAME);
        $cursor->execute([]);

        $users = [];

        while ($rs = $cursor->fetch(PDO::FETCH_ASSOC)) {

            $builder = new UsuarioBuilder($rs['usuario']);
            $builder->id = $rs['id'];
            $builder->nombres = $rs['nombres'];
            $builder->apellidos = $rs['apellidos'];
            $builder->ultimoAcceso = $rs['ultimo_acceso'];
            $builder->accesoIntentos = $rs['acceso_intentos'];
            $builder->bloqueado = $rs['bloqueado'];
            $builder->bloqueadoTs = $rs['bloqueado_ts'];
            $builder->tsAlta = $rs['ts_alta'];
            $builder->tsBaja = $rs['ts_baja'];

            $users[] = $builder->build();
        }

        return $users;
    }

    public static function update(Usuario $usuario) : void {

        $stmt = Connection::getConnection()->prepare("UPDATE " . self::TABLE_NAME . " SET usuario = ?, nombres = ?, apellidos = ? WHERE id = ?");

        $stmt->execute([
            $usuario->getUsuario(),
            $usuario->getNombres(),
            $usuario->getApellidos(),
            $usuario->getId()
        ]);
    }

    public static function blockUser(Usuario $usuario) :void {

        $stmt = Connection::getConnection()->prepare("UPDATE " . self::TABLE_NAME . " SET bloqueado = ?, bloqueado_ts = now() WHERE id = ?");

        $stmt->execute([true, $usuario->getId()]);
    }

    public static function unblockUser(Usuario $usuario) :void {

        $stmt = Connection::getConnection()->prepare("UPDATE " . self::TABLE_NAME . " SET bloqueado = ? WHERE id = ?");
        $stmt->execute([false, $usuario->getId()]);
    }

    /**
     * @param string $usuario
     * @return Usuario
     * @throws RowNotFoundException
     */
    public static function getByUserIdentifier(string $usuario) : Usuario {

        $cursor = Connection::getConnection()->prepare("SELECT * FROM " . self::TABLE_NAME . " WHERE usuario = ?");
        $cursor->execute([$usuario]);

        while ($rs = $cursor->fetch(PDO::FETCH_ASSOC)) {

            $builder = new UsuarioBuilder($rs['usuario']);
            $builder->id = $rs['id'];
            $builder->nombres = $rs['nombres'];
            $builder->apellidos = $rs['apellidos'];

            $password = new Password();
            $password->setHash($rs['password']);
            $password->setSalt($rs['salt']);

            $builder->password = $password;
            $builder->ultimoAcceso = $rs['ultimo_acceso'];
            $builder->accesoIntentos = $rs['acceso_intentos'];
            $builder->bloqueado = $rs['bloqueado'];
            $builder->bloqueadoTs = $rs['bloqueado_ts'];
            $builder->tsAlta = $rs['ts_alta'];
            $builder->tsBaja = $rs['ts_baja'];

            return $builder->build();
        }

        throw new RowNotFoundException("El email ingresado no es válido");
    }

    /**
     * @param int $usuarioId
     * @return Usuario
     * @throws RowNotFoundException
     */
    public static function getById(int $usuarioId) : Usuario {

        $cursor = Connection::getConnection()->prepare("SELECT * FROM " . self::TABLE_NAME . " WHERE id = ?");
        $cursor->execute([$usuarioId]);

        while ($rs = $cursor->fetch(PDO::FETCH_ASSOC)) {

            $builder = new UsuarioBuilder($rs['usuario']);
            $builder->id = $rs['id'];
            $builder->nombres = $rs['nombres'];
            $builder->apellidos = $rs['apellidos'];

            $password = new Password();
            $password->setHash($rs['password']);
            $password->setSalt($rs['salt']);

            $builder->password = $password;
            $builder->ultimoAcceso = $rs['ultimo_acceso'];
            $builder->accesoIntentos = $rs['acceso_intentos'];
            $builder->bloqueado = $rs['bloqueado'];
            $builder->bloqueadoTs = $rs['bloqueado_ts'];
            $builder->tsAlta = $rs['ts_alta'];
            $builder->tsBaja = $rs['ts_baja'];

            return $builder->build();
        }

        throw new RowNotFoundException("El identificador ingresado no es válido");
    }

    /**
     * @param array $filters
     * @param $selectedPage
     * @param $rowsPerPage
     * @return PaginatorWrapper
     */
    public static function getAllPaginated(Array $filters = null, $selectedPage, $rowsPerPage) {

        $query = "SELECT  * FROM " . self::TABLE_NAME;

        if ($filters !== null && count($filters) > 0) {

            $where = [];
            foreach (array_keys($filters) as $key) {
                $where[] = "$key = $filters[$key]";
            }

            $query .= " where " . implode(" and ", $where);
        }

        $conn = Connection::getConnection();

        $totalRows = $conn->query(str_replace("*", "count(*)", $query))->fetchColumn();

        $cursor = $conn->prepare($query . " order by id desc limit ? offset ?");

        $cursor->execute(
            [
                $rowsPerPage,
                ($selectedPage - 1) * $rowsPerPage
            ]
        );

        $usuarios = [];

        while ($rs = $cursor->fetch(PDO::FETCH_ASSOC)) {

            $builder = new UsuarioBuilder($rs['usuario']);
            $builder->id = $rs['id'];
            $builder->nombres = $rs['nombres'];
            $builder->apellidos = $rs['apellidos'];

            $password = new Password();
            $password->setHash($rs['password']);
            $password->setSalt($rs['salt']);

            $builder->password = $password;
            $builder->ultimoAcceso = $rs['ultimo_acceso'];
            $builder->accesoIntentos = $rs['acceso_intentos'];
            $builder->bloqueado = $rs['bloqueado'];
            $builder->bloqueadoTs = $rs['bloqueado_ts'];
            $builder->tsAlta = $rs['ts_alta'];
            $builder->tsBaja = $rs['ts_baja'];

            $usuarios[] = $builder->build();
        }

        $paginator = new Paginator($totalRows, self::ROWS_PER_PAGE, 'list?', $selectedPage);

        return PaginatorWrapper::build($paginator, $usuarios);
    }
}