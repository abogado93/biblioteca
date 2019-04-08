<?php

class PersonaDao {
    const TABLE_NAME = "personas";
    const ROWS_PER_PAGE = 10;

    
    public static function getById($id) : Persona {

        $db = Connection::getConnection();

        $cursor = $db->prepare("SELECT * FROM " . self::TABLE_NAME . " WHERE id = ?");
        $cursor->execute([$id]);

        while ($rs = $cursor->fetch(PDO::FETCH_ASSOC)) {

                $builder = new PersonaBuilder($rs['id']);
                $builder->persona_nombre = $rs['nombre'];
                $builder->persona_apellido = $rs['apellido'];
                $builder->persona_cedula = $rs['cedula'];
                $builder->persona_telefono = $rs['telefono'];
                $builder->persona_direccion = $rs['direccion'];
                $builder->persona_sexo = $rs['sexo'];
                $builder->persona_fecha = $rs['fecha'];
                

                return $builder->build();
        }

        throw new RowNotFoundException("El código de personas proveído no es válido");
    }

    /**
     * @return array
     * @throws RowNotFoundException
     */
    public static function getAll() : array {

        $db = Connection::getConnection();

        $cursor = $db->prepare("SELECT * FROM " . self::TABLE_NAME);
        $cursor->execute([]);

        $personas = [];

        while ($rs = $cursor->fetch(PDO::FETCH_ASSOC)) {

            $builder = new PersonaBuilder($rs['id']);
                $builder->persona_nombre = $rs['nombre'];
                $builder->persona_apellido = $rs['apellido'];
                $builder->persona_cedula = $rs['cedula'];
                $builder->persona_telefono = $rs['telefono'];
                $builder->persona_direccion = $rs['direccion'];
                $builder->persona_sexo = $rs['sexo'];
                $builder->persona_fecha = $rs['fecha'];

            $personas[] = $builder->build();
        }

        return $personas;
    }

    
    public static function register(Persona $persona) : int {

        $db = Connection::getConnection();

        $stmt = $db->prepare("INSERT INTO " . self::TABLE_NAME . "(persona_nombre, persona_apellido, persona_cedula, persona_telefono, persona_direccion, persona_sexo, persona_fecha) values(?, ?, ?, ?, ?, ?, ?)");

        $stmt->execute(
            [
                $persona->getPersona_nombre(),
                $persona->getPersona_apellido(),
                $persona->getPersona_cedula(),
                $persona->getPersona_telefono(),
                $persona->getPersona_direccion(),
                $persona->getPersona_sexo(),
                $persona->getPersona_fecha()
               
            ]
        );

        return $db->lastInsertId();
    }

    
    public static function update(Persona $persona) : void {

        $db = Connection::getConnection();

        $stmt = $db->prepare("UPDATE " . self::TABLE_NAME . " SET persona_nombre = ?, persona_apellido = ?, persona_cedula = ?, persona_telefono = ?, persona_direccion = ?, persona_sexo = ?, persona_fecha = ? WHERE id = ?");

        $stmt->execute(
            [
               $persona->getPersona_nombre(),
                $persona->getPersona_apellido(),
                $persona->getPersona_cedula(),
                $persona->getPersona_telefono(),
                $persona->getPersona_direccion(),
                $persona->getPersona_sexo(),
                $persona->getPersona_fecha(),
				$persona->getId()
            ]
        );
    }

    
    public static function removeById(int $personaId) : void {

        $db = Connection::getConnection();

        $stmt = $db->prepare("DELETE FROM " . self::TABLE_NAME . " WHERE id = ?");

        $stmt->execute([$personaId]);
    }

   
    public static function getAllByFilter(string $filter) : array {

        $db = Connection::getConnection();

        if (is_numeric($filter)) {
            $cursor = $db->prepare("SELECT id, persona_cedula, persona_direccion FROM " . self::TABLE_NAME . " WHERE id = ? or persona_cedula like ? or persona_nombre like ? or persona_direccion like ?");
            $cursor->execute([$filter, $filter . '%', '%' . $filter . '%', '%' . $filter . '%']);

        } else {
            $cursor = $db->prepare("SELECT id, persona_cedula, persona_direccion FROM " . self::TABLE_NAME . " WHERE persona_cedula like ? or persona_nombre like ? or persona_direccion like ?");
            $cursor->execute([$filter . '%', '%' . $filter . '%', '%' . $filter . '%']);
        }

        $personas = [];

        while ($rs = $cursor->fetch(PDO::FETCH_ASSOC)) {

            $personas[] = $rs['id'] . " | ". $rs['persona_cedula'] . " | " . $rs['persona_direccion'];
        }

        return $personas;
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

        $personas = [];

        while ($rs = $cursor->fetch(PDO::FETCH_ASSOC)) {

            $builder = new PersonaBuilder($rs['id']);
                $builder->persona_nombre = $rs['nombre'];
                $builder->persona_apellido = $rs['apellido'];
                $builder->persona_cedula = $rs['cedula'];
                $builder->persona_telefono = $rs['telefono'];
                $builder->persona_direccion = $rs['direccion'];
                $builder->persona_sexo = $rs['sexo'];
                $builder->persona_fecha = $rs['fecha'];

            $personas[] = $builder->build();
        }

        $paginator = new Paginator($totalRows, self::ROWS_PER_PAGE, 'list?', $selectedPage);

        return PaginatorWrapper::build($paginator, $personas);
    }
}