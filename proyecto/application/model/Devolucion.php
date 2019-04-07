
<?php

class Devolucion{
    public $id;
    public $devolucion_fecha;
    public $devolucion_devolucion;
    public $devolucion_persona;
    public $devolucion_estado;
    public $devolucion_libro_id;
   
	
	
	
	
    public function getId() {
        return $this->id;
    }

    public function getDevolucion_fecha() {
        return $this->devolucion_fecha;
    }

    public function getDevolucion_devolucion() {
        return $this->devolucion_devolucion;
    }

    public function getDevolucion_persona() {
        return $this->devolucion_persona;
    }

    public function getDevolucion_estado() {
        return $this->devolucion_estado;
    }

    public function getDevolucion_libro_id() {
        return $this->devolucion_libro_id;
    }

  


}
