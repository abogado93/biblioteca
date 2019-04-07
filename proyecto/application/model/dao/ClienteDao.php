<?php
/**
 * Created by PhpStorm.
 * User: crojas
 * Date: 2/9/18
 * Time: 13:44
 */

class ClienteDao {
    const TABLE_NAME = "clientes";
    const ROWS_PER_PAGE = 10;

    /**
     * @param $id
     * @return Cliente
     * @throws RowNotFoundException
     */
    public static function getById($id) : Cliente {

        $db = Connection::getConnection();

        $cursor = $db->prepare("SELECT * FROM " . self::TABLE_NAME . " WHERE id = ?");
        $cursor->execute([$id]);

        while ($rs = $cursor->fetch(PDO::FETCH_ASSOC)) {

                $builder = new ClienteBuilder($rs['id']);
                $builder->ruc = $rs['ruc'];
                $builder->nombreFantasia = $rs['nombre_fantasia'];
                $builder->razonSocial = $rs['razon_social'];
                $builder->email = $rs['email'];
                $builder->telefono = $rs['telefono'];
                $builder->direccion = $rs['direccion'];
                $builder->observaciones = $rs['observaciones'];
                $builder->tsAlta = $rs['ts_alta'];
                $builder->usuarioAlta = UsuarioDao::getById($rs['usuario_alta']);

                return $builder->build();
        }

        throw new RowNotFoundException("El código de cliente proveído no es válido");
    }

    /**
     * @return array
     * @throws RowNotFoundException
     */
    public static function getAll() : array {

        $db = Connection::getConnection();

        $cursor = $db->prepare("SELECT * FROM " . self::TABLE_NAME);
        $cursor->execute([]);

        $clientes = [];

        while ($rs = $cursor->fetch(PDO::FETCH_ASSOC)) {

            $builder = new ClienteBuilder($rs['id']);
            $builder->ruc = $rs['ruc'];
            $builder->nombreFantasia = $rs['nombre_fantasia'];
            $builder->razonSocial = $rs['razon_social'];
            $builder->email = $rs['email'];
            $builder->telefono = $rs['telefono'];
            $builder->direccion = $rs['direccion'];
            $builder->observaciones = $rs['observaciones'];
            $builder->tsAlta = $rs['ts_alta'];
            $builder->usuarioAlta = UsuarioDao::getById($rs['usuario_alta']);

            $clientes[] = $builder->build();
        }

        return $clientes;
    }

    /**
     * @param Cliente $cliente
     * @return int
     */
    public static function register(Cliente $cliente) : int {

        $db = Connection::getConnection();

        $stmt = $db->prepare("INSERT INTO " . self::TABLE_NAME . "(ruc, nombre_fantasia, razon_social, email, telefono, direccion, observaciones, usuario_alta) values(?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->execute(
            [
                $cliente->getRuc(),
                $cliente->getNombreFantasia(),
                $cliente->getRazonSocial(),
                $cliente->getEmail(),
                $cliente->getTelefono(),
                $cliente->getDireccion(),
                $cliente->getObservaciones(),
                $cliente->getUsuarioAlta()->getId()
            ]
        );

        return $db->lastInsertId();
    }

    /**
     * @param Cliente $cliente
     */
    public static function update(Cliente $cliente) : void {

        $db = Connection::getConnection();

        $stmt = $db->prepare("UPDATE " . self::TABLE_NAME . " SET ruc = ?, nombre_fantasia = ?, razon_social = ?, email = ?, telefono = ?, direccion = ?, observaciones = ? WHERE id = ?");

        $stmt->execute(
            [
                $cliente->getRuc(),
                $cliente->getNombreFantasia(),
                $cliente->getRazonSocial(),
                $cliente->getEmail(),
                $cliente->getTelefono(),
                $cliente->getDireccion(),
                $cliente->getObservaciones(),
                $cliente->getId()
            ]
        );
    }

    /**
     * @param int $clienteId
     */
    public static function removeById(int $clienteId) : void {

        $db = Connection::getConnection();

        $stmt = $db->prepare("DELETE FROM " . self::TABLE_NAME . " WHERE id = ?");

        $stmt->execute([$clienteId]);
    }

    /**
     * @param string $filter
     * @return array
     */
    public static function getAllByFilter(string $filter) : array {

        $db = Connection::getConnection();

        if (is_numeric($filter)) {
            $cursor = $db->prepare("SELECT id, ruc, razon_social FROM " . self::TABLE_NAME . " WHERE id = ? or ruc like ? or nombre_fantasia like ? or razon_social like ?");
            $cursor->execute([$filter, $filter . '%', '%' . $filter . '%', '%' . $filter . '%']);

        } else {
            $cursor = $db->prepare("SELECT id, ruc, razon_social FROM " . self::TABLE_NAME . " WHERE ruc like ? or nombre_fantasia like ? or razon_social like ?");
            $cursor->execute([$filter . '%', '%' . $filter . '%', '%' . $filter . '%']);
        }

        $clientes = [];

        while ($rs = $cursor->fetch(PDO::FETCH_ASSOC)) {

            $clientes[] = $rs['id'] . " | ". $rs['ruc'] . " | " . $rs['razon_social'];
        }

        return $clientes;
    }

    public static function getAllPaginated(Array $filters, $selectedPage, $rowsPerPage) : PaginatorWrapper{

        $query = "SELECT  * FROM " . self::TABLE_NAME;

        if ($filters !== null && count($filters) > 0) {

            $where = [];
            foreach (array_keys($filters) as $key) {
                $where[] = "$key";
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

        $clientes = [];

        while ($rs = $cursor->fetch(PDO::FETCH_ASSOC)) {

            $builder = new ClienteBuilder($rs['id']);
            $builder->ruc = $rs['ruc'];
            $builder->nombreFantasia = $rs['nombre_fantasia'];
            $builder->razonSocial = $rs['razon_social'];
            $builder->email = $rs['email'];
            $builder->telefono = $rs['telefono'];
            $builder->direccion = $rs['direccion'];
            $builder->observaciones = $rs['observaciones'];
            $builder->tsAlta = $rs['ts_alta'];
            $builder->usuarioAlta = UsuarioDao::getById($rs['usuario_alta']);

            $clientes[] = $builder->build();
        }

        $paginator = new Paginator($totalRows, self::ROWS_PER_PAGE, 'list?', $selectedPage);

        return PaginatorWrapper::build($paginator, $clientes);
    }
}