<?php

class DevolucionDao {
    const TABLE_NAME = "devoluciones";
    const ROWS_PER_PAGE = 10;

 
    public static function getById($id) : Devolucion {

        $db = Connection::getConnection();

        $cursor = $db->prepare("SELECT * FROM " . self::TABLE_NAME . " WHERE id = ?");
        $cursor->execute([$id]);

        while ($rs = $cursor->fetch(PDO::FETCH_ASSOC)) {

                $builder = new DevolucionBuilder($rs['fecha']);
                $builder->devolucion_fecha = $rs['devuelto'];
                $builder->devolucion_devolucion = $rs['persona'];
                $builder->devolucion_persona = $rs['libro'];
                $builder->devolucion_estado = $rs['estado'];
              
               
              

                return $builder->build();
        }

        throw new RowNotFoundException("El código de devolucion proveído no es válido");
    }

    /**
     * @return array
     * @throws RowNotFoundException
     */
    public static function getAll() : array {

        $db = Connection::getConnection();

        $cursor = $db->prepare("SELECT * FROM " . self::TABLE_NAME);
        $cursor->execute([]);

        $devoluciones = [];

        while ($rs = $cursor->fetch(PDO::FETCH_ASSOC)) {

            $builder = new DevolucionBuilder($rs['id']);
			$builder->devolucion_fecha = $rs['fecha'];
                $builder->devolucion_devolucion = $rs['devuelto'];
                $builder->devolucion_persona = $rs['persona'];
                $builder->devolucion_estado = $rs['estado'];
				    $builder->devolucion_libro_id = $rs['libro'];

            $devoluciones[] = $builder->build();
        }

        return $devoluciones;
    }

   
    public static function register(Devolucion $devolucion) : int {

        $db = Connection::getConnection();

        $stmt = $db->prepare("INSERT INTO " . self::TABLE_NAME . "(devolucion_fecha, devolucion_devolucion, devolucion_persona, devolucion_estado, devolucion_libro_id) values(?, ?, ?, ?, ?)");

        $stmt->execute(
            [
                $devolucion->getDevolucion_fecha(),
                $devolucion->getDevolucion_devolucion(),
                $devolucion->getDevolucion_persona(),
                $devolucion->getDevolucion_estado(),
                $devolucion->getDevolucion_libro_id(),
				
               
          
            ]
        );

        return $db->lastInsertId();
    }

    /**
     * @param Devolucion $devolucion
     */
    public static function update(Devolucion $devolucion) : void {

        $db = Connection::getConnection();

        $stmt = $db->prepare("UPDATE " . self::TABLE_NAME . " SET devolucion_fecha = ?, devolucion_devolucion = ?, devolucion_persona = ?, devolucion_estado = ?, devolucion_libro_id = ? WHERE id = ?");

        $stmt->execute(
            [
                $devolucion->getDevolucion_fecha(),
                $devolucion->getDevolucion_devolucion(),
                $devolucion->getDevolucion_persona(),
                $devolucion->getDevolucion_estado(),
                $devolucion->getDevolucion_libro_id(),
				$devolucion->getId()
            ]
        );
    }

  
    public static function removeById(int $devolucionId) : void {

        $db = Connection::getConnection();

        $stmt = $db->prepare("DELETE FROM " . self::TABLE_NAME . " WHERE id = ?");

        $stmt->execute([$devolucionId]);
    }

    /**
     * @param string $filter
     * @return array
     */
    public static function getAllByFilter(string $filter) : array {

        $db = Connection::getConnection();

        if (is_numeric($filter)) {
            $cursor = $db->prepare("SELECT id, devolucion_fecha, devolucion_devolucion FROM " . self::TABLE_NAME . " WHERE id = ? or devolucion_fecha like ? or devolucion_devolucion like ? or devolucion_persona like ?");
            $cursor->execute([$filter, $filter . '%', '%' . $filter . '%', '%' . $filter . '%']);

        } else {
            $cursor = $db->prepare("SELECT id, devolucion_fecha, devolucion_devolucion FROM " . self::TABLE_NAME . " WHERE devolucion_fecha like ? or devolucion_devolucion like ? or devolucion_persona like ?");
            $cursor->execute([$filter . '%', '%' . $filter . '%', '%' . $filter . '%']);
        }

        $devoluciones= [];

        while ($rs = $cursor->fetch(PDO::FETCH_ASSOC)) {

            $devoluciones[] = $rs['id'] . " | ". $rs['devolucion_fecha'] . " | " . $rs['devolucion_persona'];
        }

        return $devoluciones;
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

        $devoluciones = [];

        while ($rs = $cursor->fetch(PDO::FETCH_ASSOC)) {

            $builder = new DevolucionBuilder($rs['id']);
			$builder->devolucion_fecha = $rs['fecha'];
                $builder->devolucion_devolucion = $rs['devuelto'];
                $builder->devolucion_persona = $rs['persona'];
                $builder->devolucion_estado = $rs['estado'];
				    $builder->devolucion_libro_id = $rs['libro'];

            $devoluciones[] = $builder->build();
        }

        $paginator = new Paginator($totalRows, self::ROWS_PER_PAGE, 'list?', $selectedPage);

        return PaginatorWrapper::build($paginator, $devoluciones);
    }
}