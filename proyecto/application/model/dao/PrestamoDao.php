<?php


class PrestamoDao {
    const TABLE_NAME = "prestamos";
    const ROWS_PER_PAGE = 10;

  
    public static function getById($id) : Prestamo {

        $db = Connection::getConnection();

        $cursor = $db->prepare("SELECT * FROM " . self::TABLE_NAME . " WHERE id = ?");
        $cursor->execute([$id]);

        while ($rs = $cursor->fetch(PDO::FETCH_ASSOC)) {

                $builder = new PrestamoBuilder($rs['id']);
                $builder->prestamo_fecha = $rs['fecha'];
                $builder->prestamo_estado = $rs['estado'];
                $builder->prestamo_persona = $rs['persona'];
                $builder->prestamo_libro_id = $rs['libro'];
                $builder->prestamo_devolucion = $rs['devolucion'];
                $builder->prestamo_dias = $rs['dias'];
                $builder->prestamo_cantidad = $rs['cantidad'];
                $builder->prestamo_pago = $rs['pago'];
                

                return $builder->build();
        }

        throw new RowNotFoundException("El código de prestamo proveído no es válido");
    }

 
    public static function getAll() : array {

        $db = Connection::getConnection();

        $cursor = $db->prepare("SELECT * FROM " . self::TABLE_NAME);
        $cursor->execute([]);

        $prestamos = [];

        while ($rs = $cursor->fetch(PDO::FETCH_ASSOC)) {

          $builder = new PrestamoBuilder($rs['id']);
                $builder->prestamo_fecha = $rs['fecha'];
                $builder->prestamo_estado = $rs['estado'];
                $builder->prestamo_persona = $rs['persona'];
                $builder->prestamo_libro_id = $rs['libro'];
                $builder->prestamo_devolucion = $rs['devolucion'];
                $builder->prestamo_dias = $rs['dias'];
                $builder->prestamo_cantidad = $rs['cantidad'];
                $builder->prestamo_pago = $rs['pago'];

            $prestamos[] = $builder->build();
        }

        return $prestamos;
    }

    
    public static function register(Prestamo $prestamo) : int {

        $db = Connection::getConnection();

        $stmt = $db->prepare("INSERT INTO " . self::TABLE_NAME . "(prestamo_fecha, prestamo_estado, prestamo_persona, prestamo_libro_id, prestamo_devolucion, prestamo_dias, prestamo_cantidad, prestamo_cantidad,prestamo_pago) values(?, ?, ?, ?, ?, ?, ?, ?,?)");

        $stmt->execute(
            [
                $prestamo->getPrestamo_fecha(),
                $prestamo->getPrestamo_estado(),
                $prestamo->getPrestamo_persona(),
                $prestamo->getPrestamo_libro_id(),
                $prestamo->getPrestamo_devolucion(),
                $prestamo->getPrestamo_dias(),
                $prestamo->getPrestamo_cantidad(),
                $prestamo->getPrestamo_pago()
            ]
        );

        return $db->lastInsertId();
    }

   
    public static function update(Prestamo $prestamo) : void {

        $db = Connection::getConnection();

        $stmt = $db->prepare("UPDATE " . self::TABLE_NAME . " SET prestamo_fecha = ?, prestamo_estado = ?, prestamo_persona = ?, prestamo_libro_id = ?, prestamo_devolucion = ?, prestamo_dias = ?, prestamo_cantidad = ?,prestamo_pago = ? WHERE id = ?");

        $stmt->execute(
            [
                 $prestamo->getPrestamo_fecha(),
                $prestamo->getPrestamo_estado(),
                $prestamo->getPrestamo_persona(),
                $prestamo->getPrestamo_libro_id(),
                $prestamo->getPrestamo_devolucion(),
                $prestamo->getPrestamo_dias(),
                $prestamo->getPrestamo_cantidad(),
                $prestamo->getPrestamo_pago()
                $prestamo->getId()
            ]
        );
    }

   
    public static function removeById(int $prestamoId) : void {

        $db = Connection::getConnection();

        $stmt = $db->prepare("DELETE FROM " . self::TABLE_NAME . " WHERE id = ?");

        $stmt->execute([$prestamoId]);
    }

    
    public static function getAllByFilter(string $filter) : array {

        $db = Connection::getConnection();

        if (is_numeric($filter)) {
            $cursor = $db->prepare("SELECT id, prestamo_fecha, prestamo_persona FROM " . self::TABLE_NAME . " WHERE id = ? or prestamo_fecha like ? or prestamo_persona like ? or prestamo_libro_id like ?");
            $cursor->execute([$filter, $filter . '%', '%' . $filter . '%', '%' . $filter . '%']);

        } else {
            $cursor = $db->prepare("SELECT id, prestamo_fecha, prestamo_persona FROM " . self::TABLE_NAME . " WHERE prestamo_fecha like ? or prestamo_persona like ? or prestamo_libro_id like ?");
            $cursor->execute([$filter . '%', '%' . $filter . '%', '%' . $filter . '%']);
        }

        $prestamos = [];

        while ($rs = $cursor->fetch(PDO::FETCH_ASSOC)) {

            $prestamos[] = $rs['id'] . " | ". $rs['prestamo_fecha'] . " | " . $rs['prestamo_persona'];
        }

        return $prestamos;
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

        $prestamos = [];

        while ($rs = $cursor->fetch(PDO::FETCH_ASSOC)) {

           $builder = new PrestamoBuilder($rs['id']);
                $builder->prestamo_fecha = $rs['fecha'];
                $builder->prestamo_estado = $rs['estado'];
                $builder->prestamo_persona = $rs['persona'];
                $builder->prestamo_libro_id = $rs['libro'];
                $builder->prestamo_devolucion = $rs['devolucion'];
                $builder->prestamo_dias = $rs['dias'];
                $builder->prestamo_cantidad = $rs['cantidad'];
                $builder->prestamo_pago = $rs['pago'];

            $prestamos[] = $builder->build();
        }

        $paginator = new Paginator($totalRows, self::ROWS_PER_PAGE, 'list?', $selectedPage);

        return PaginatorWrapper::build($paginator, $prestamos);
    }
}