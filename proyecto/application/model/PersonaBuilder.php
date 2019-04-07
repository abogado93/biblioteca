<?php


class PersonaBuilder
{
	public $id;
 	public $persona_nombre;
   public $persona_apellido; 
   public $persona_cedula; 
   public $persona_telefono;
   public $persona_direccion; 
   public $persona_sexo; 
   public $persona_fecha;
	
    public function __construct($id) {
        $this->id = $id;
    }
    public function build(){
        return new Persona($this);
    }
}

?>