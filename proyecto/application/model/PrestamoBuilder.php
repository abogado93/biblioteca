<?php


class PrestamoBuilder
{
	public $id;
   public $prestamo_fecha;
   public $prestamo_estado;
   public $prestamo_persona;
   public $prestamo_libro_id;
   public $prestamo_devolucion;
   public $prestamo_dias;
   public $prestamo_cantidad;
  
	
    public function __construct($id) {
        $this->id = $id;
    }
    public function build(){
        return new Prestamo($this);
    }
}

?>