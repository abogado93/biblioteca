<?php


class DevolucionBuilder
{
	public $id;
    public $devolucion_fecha;
    public $devolucion_devolucion;
    public $devolucion_persona;
    public $devolucion_estado;
    public $devolucion_libro_id;
   
	
    public function __construct($id) {
        $this->id = $id;
    }
    public function build(){
        return new Devolucion($this);
    }
}

?>