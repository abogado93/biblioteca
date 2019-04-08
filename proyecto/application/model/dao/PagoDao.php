<?php


class PagoDao {
    const TABLE_NAME = "pagos";
    const ROWS_PER_PAGE = 10;

   
    public static function getById($id) : Pago {

        $db = Connection::getConnection();

        $cursor = $db->prepare("SELECT * FROM " . self::TABLE_NAME . " WHERE id = ?");
        $cursor->execute([$id]);

        while ($rs = $cursor->fetch(PDO::FETCH_ASSOC)) {

                $builder = new PagoBuilder($rs['id']);
                $builder->pago_fecha = $rs['fecha'];
                $builder->pago_multa = $rs['multa'];
                $builder->pago_monto = $rs['monto'];
                $builder->pago_prestamo_id = $rs['prestamo'];
                $builder->pago_estado = $rs['estado'];
               

                return $builder->build();
        }

        throw new RowNotFoundException("El código de pagos proveído no es válido");
    }

 
    public static function getAll() : array {

        $db = Connection::getConnection();

        $cursor = $db->prepare("SELECT * FROM " . self::TABLE_NAME);
        $cursor->execute([]);

        $pagos = [];

        while ($rs = $cursor->fetch(PDO::FETCH_ASSOC)) {

             $builder = new PagoBuilder($rs['id']);
                $builder->pago_fecha = $rs['fecha'];
                $builder->pago_multa = $rs['multa'];
                $builder->pago_monto = $rs['monto'];
                $builder->pago_prestamo_id = $rs['prestamo'];
                $builder->pago_estado = $rs['estado'];

            $pagos[] = $builder->build();
        }

        return $pagos;
    }

  
    public static function register(Pago $pago) : int {

        $db = Connection::getConnection();

        $stmt = $db->prepare("INSERT INTO " . self::TABLE_NAME . "(pago_fecha, pago_multa, pago_monto, pago_prestamo_id, pago_estado) values(?, ?, ?, ?, ?)");

        $stmt->execute(
            [
                $pago->getPago_fecha(),
                $pago->getPago_multa(),
                $pago->getPago_monto(),
                $pago->getPago_prestamo_id(),
                $pago->getPago_estado()
                
            ]
        );

        return $db->lastInsertId();
    }

  
    public static function update(Pago $pago) : void {

        $db = Connection::getConnection();

        $stmt = $db->prepare("UPDATE " . self::TABLE_NAME . " SET pago_fecha = ?, pago_multa = ?, pago_monto = ?, pago_prestamo_id = ?, pago_estado = ? WHERE id = ?");

        $stmt->execute(
            [
                 $pago->getPago_fecha(),
                $pago->getPago_multa(),
                $pago->getPago_monto(),
                $pago->getPago_prestamo_id(),
                $pago->getPago_estado()
            ]
        );
    }

   
    public static function removeById(int $pagoId) : void {

        $db = Connection::getConnection();

        $stmt = $db->prepare("DELETE FROM " . self::TABLE_NAME . " WHERE id = ?");

        $stmt->execute([$pagoId]);
    }

    /**
     * @param string $filter
     * @return array
     */
    public static function getAllByFilter(string $filter) : array {

        $db = Connection::getConnection();

        if (is_numeric($filter)) {
            $cursor = $db->prepare("SELECT id, pago_fecha, pago_prestamo_id FROM " . self::TABLE_NAME . " WHERE id = ? or pago_fecha like ? or pago_multa like ? or pago_prestamo_id like ?");
            $cursor->execute([$filter, $filter . '%', '%' . $filter . '%', '%' . $filter . '%']);

        } else {
            $cursor = $db->prepare("SELECT id, pago_fecha, pago_prestamo_id FROM " . self::TABLE_NAME . " WHERE pago_fecha like ? or pago_multa like ? or pago_prestamo_id like ?");
            $cursor->execute([$filter . '%', '%' . $filter . '%', '%' . $filter . '%']);
        }

        $pagos = [];

        while ($rs = $cursor->fetch(PDO::FETCH_ASSOC)) {

            $pagos[] = $rs['id'] . " | ". $rs['pago_fecha'] . " | " . $rs['pago_prestamo_id'];
        }

        return $pagos;
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

        $pagos= [];

        while ($rs = $cursor->fetch(PDO::FETCH_ASSOC)) {
 $builder = new PagoBuilder($rs['id']);
                $builder->pago_fecha = $rs['fecha'];
                $builder->pago_multa = $rs['multa'];
                $builder->pago_monto = $rs['monto'];
                $builder->pago_prestamo_id = $rs['prestamo'];
                $builder->pago_estado = $rs['estado'];

            $pagos[] = $builder->build();
        }

        $paginator = new Paginator($totalRows, self::ROWS_PER_PAGE, 'list?', $selectedPage);

        return PaginatorWrapper::build($paginator, $clientes);
    }
}