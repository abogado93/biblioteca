<?php


class TipoDao {
    const TABLE_NAME = "tipo";
    const ROWS_PER_PAGE = 10;

   
    public static function getById($id) : Tipo {

        $db = Connection::getConnection();

        $cursor = $db->prepare("SELECT * FROM " . self::TABLE_NAME . " WHERE id = ?");
        $cursor->execute([$id]);

        while ($rs = $cursor->fetch(PDO::FETCH_ASSOC)) {

                $builder = new TipoBuilder($rs['id']);
                $builder->tipo_descripcion = $rs['descripcion']
                

                return $builder->build();
        }

        throw new RowNotFoundException("El código de tipo de libros proveído no es válido");
    }

 
    public static function getAll() : array {

        $db = Connection::getConnection();

        $cursor = $db->prepare("SELECT * FROM " . self::TABLE_NAME);
        $cursor->execute([]);

        $tipos = [];

        while ($rs = $cursor->fetch(PDO::FETCH_ASSOC)) {

            $builder = new TipoBuilder($rs['id']);
                $builder->tipo_descripcion = $rs['descripcion']
           

            $tipos[] = $builder->build();
        }

        return $tipos;
    }

  
    public static function register(Tipo $tipo) : int {

        $db = Connection::getConnection();

        $stmt = $db->prepare("INSERT INTO " . self::TABLE_NAME . "(descripcion) values(?)");

        $stmt->execute(
            [
                $tipo->getTipo_descripcion()
                
                
            ]
        );

        return $db->lastInsertId();
    }

  
    public static function update(Tipo $tipo) : void {

        $db = Connection::getConnection();

        $stmt = $db->prepare("UPDATE " . self::TABLE_NAME . " SET descripcion = ? WHERE id = ?");

        $stmt->execute(
            [
              $tipo->getTipo_descripcion()
                $tipo->getId()
            ]
        );
    }

   
    public static function removeById(int $tipoId) : void {

        $db = Connection::getConnection();

        $stmt = $db->prepare("DELETE FROM " . self::TABLE_NAME . " WHERE id = ?");

        $stmt->execute([$tipoId]);
    }

    
    public static function getAllByFilter(string $filter) : array {

        $db = Connection::getConnection();

        if (is_numeric($filter)) {
            $cursor = $db->prepare("SELECT id, descripcion, descripcion FROM " . self::TABLE_NAME . " WHERE id = ? or descripcion like ? or descripcion like ?");
            $cursor->execute([$filter, $filter . '%', '%' . $filter . '%', '%' . $filter . '%']);

        } else {
            $cursor = $db->prepare("SELECT id, descripcion, descripcion FROM " . self::TABLE_NAME . " WHERE descripcion like ? or descripcion like ?");
            $cursor->execute([$filter . '%', '%' . $filter . '%', '%' . $filter . '%']);
        }

        $tipos = [];

        while ($rs = $cursor->fetch(PDO::FETCH_ASSOC)) {

            $tipos[] = $rs['id'] . " | ". $rs['descripcion'] . " | " . $rs['descripcion'];
        }

        return $tipos;
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

        $tipos = [];

        while ($rs = $cursor->fetch(PDO::FETCH_ASSOC)) {

            $builder = new TipoBuilder($rs['id']);
                $builder->tipo_descripcion = $rs['descripcion']

            $tipos[] = $builder->build();
        }

        $paginator = new Paginator($totalRows, self::ROWS_PER_PAGE, 'list?', $selectedPage);

        return PaginatorWrapper::build($paginator, $tipos);
    }
}