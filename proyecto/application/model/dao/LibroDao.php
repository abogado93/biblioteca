<?php

class LibroDao {
    const TABLE_NAME = "libros";
    const ROWS_PER_PAGE = 10;

  
    public static function getById($id) : Libro {

        $db = Connection::getConnection();

        $cursor = $db->prepare("SELECT * FROM " . self::TABLE_NAME . " WHERE id = ?");
        $cursor->execute([$id]);

        while ($rs = $cursor->fetch(PDO::FETCH_ASSOC)) {

                $builder = new LibroBuilder($rs['id']);
                $builder->libro_nombre = $rs['nombre'];
                $builder->libro_fecha = $rs['fecha'];
                $builder->libro_tipo = $rs['tipo'];
                $builder->libro_estado = $rs['estado'];
                $builder->libro_precio = $rs['precio'];
                $builder->libro_existencia = $rs['existencia'];
                $builder->libro_cantidad = $rs['cantidad'];
                

                return $builder->build();
        }

        throw new RowNotFoundException("El código del libro proveído no es válido");
    }

    /**
     * @return array
     * @throws RowNotFoundException
     */
    public static function getAll() : array {

        $db = Connection::getConnection();

        $cursor = $db->prepare("SELECT * FROM " . self::TABLE_NAME);
        $cursor->execute([]);

        $libros = [];

        while ($rs = $cursor->fetch(PDO::FETCH_ASSOC)) {

            $builder = new LibroBuilder($rs['id']);
            $builder->libro_nombre = $rs['nombre'];
                $builder->libro_fecha = $rs['fecha'];
                $builder->libro_tipo = $rs['tipo'];
                $builder->libro_estado = $rs['estado'];
                $builder->libro_precio = $rs['precio'];
                $builder->libro_existencia = $rs['existencia'];
                $builder->libro_cantidad = $rs['cantidad'];

            $libros[] = $builder->build();
        }

        return $libros;
    }

   
    public static function register(Libro $libro) : int {

        $db = Connection::getConnection();

        $stmt = $db->prepare("INSERT INTO " . self::TABLE_NAME . "(libro_nombre, libro_fecha, libro_tipo, libro_estado, libro_precio, libro_existencia, libro_cantidad) values(?, ?, ?, ?, ?, ?, ?)");

        $stmt->execute(
            [
                $libro->getLibro_nombre(),
                $libro->getLibro_fecha(),
                $libro->getLibro_tipo(),
                $libro->getLibro_estado(),
                $libro->getLibro_precio(),
                $libro->getLibro_existencia(),
                $libro->getLibro_cantidad()
                
            ]
        );

        return $db->lastInsertId();
    }

   
    public static function update(Libro $libro) : void {

        $db = Connection::getConnection();

        $stmt = $db->prepare("UPDATE " . self::TABLE_NAME . " SET libro_nombre = ?, libro_fecha = ?, libro_tipo = ?, libro_estado = ?, libro_precio = ?, libro_existencia = ?, libro_cantidad = ? WHERE id = ?");

        $stmt->execute(
            [
                $libro->getLibro_nombre(),
                $libro->getLibro_fecha(),
                $libro->getLibro_tipo(),
                $libro->getLibro_estado(),
                $libro->getLibro_precio(),
                $libro->getLibro_existencia(),
                $libro->getLibro_cantidad()
                $libro->getId()
            ]
        );
    }

    
    public static function removeById(int $libroId) : void {

        $db = Connection::getConnection();

        $stmt = $db->prepare("DELETE FROM " . self::TABLE_NAME . " WHERE id = ?");

        $stmt->execute([$libroId]);
    }

    /**
     * @param string $filter
     * @return array
     */
    public static function getAllByFilter(string $filter) : array {

        $db = Connection::getConnection();

        if (is_numeric($filter)) {
            $cursor = $db->prepare("SELECT id, libro_precio, libro_cantidad FROM " . self::TABLE_NAME . " WHERE id = ? or libro_precio like ? or libro_cantidad like ? or libro_existencia like ?");
            $cursor->execute([$filter, $filter . '%', '%' . $filter . '%', '%' . $filter . '%']);

        } else {
            $cursor = $db->prepare("SELECT id, libro_precio, libro_cantidad FROM " . self::TABLE_NAME . " WHERE libro_precio like ? or libro_cantidad like ? or libro_existencia like ?");
            $cursor->execute([$filter . '%', '%' . $filter . '%', '%' . $filter . '%']);
        }

        $libros = [];

        while ($rs = $cursor->fetch(PDO::FETCH_ASSOC)) {

            $libros[] = $rs['id'] . " | ". $rs['libro_precio'] . " | " . $rs['libro_cantidad'];
        }

        return $libros;
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

        $libros = [];

        while ($rs = $cursor->fetch(PDO::FETCH_ASSOC)) {

           $builder = new LibroBuilder($rs['id']);
            $builder->libro_nombre = $rs['nombre'];
                $builder->libro_fecha = $rs['fecha'];
                $builder->libro_tipo = $rs['tipo'];
                $builder->libro_estado = $rs['estado'];
                $builder->libro_precio = $rs['precio'];
                $builder->libro_existencia = $rs['existencia'];
                $builder->libro_cantidad = $rs['cantidad'];

            $libros[] = $builder->build();
        }

        $paginator = new Paginator($totalRows, self::ROWS_PER_PAGE, 'list?', $selectedPage);

        return PaginatorWrapper::build($paginator, $libros);
    }
}