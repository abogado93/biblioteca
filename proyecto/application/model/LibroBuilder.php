<?php


class LibroBuilder
{
  public $id;
  public $libro_nombre;
  public $libro_fecha;
  public $libro_tipo;
  public $libro_estado;
  public $libro_precio;
  public $libro_existencia;
  public $libro_cantidad;
  public $libroAlta;
	
	
    public function __construct($id) {
        $this->id = $id;
    }
    public function build(){
        return new Libro($this);
    }
}

?>