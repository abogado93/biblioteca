<?php

class Libro{
  public $id;
  public $libro_nombre;
  public $libro_fecha;
  public $libro_tipo;
  public $libro_estado;
  public $libro_precio;
  public $libro_existencia;
  public $libro_cantidad;
  public $tsAlta;
  public $libroAlta;
 
     public function __construct(LibroBuilder $builder) {
        $this->id = $builder->id;
        $this->libro_nombre = $builder->libro_nombre;
        $this->libro_fecha = $builder->libro_fecha;
        $this->libro_tipo = $builder->libro_tipo;
        $this->libro_estado = $builder->libro_estado;
        $this->libro_precio = $builder->libro_precio;
        $this->libro_existencia = $builder->libro_existencia;
        $this->libro_cantidad = $builder->libro_cantidad;
        $this->tsAlta = $builder->tsAlta;
        $this->usuarioAlta = $builder->usuarioAlta;
    }
 
 
 
 
  /**
     * @var integer
     */
 
  public function getId(){
        return $this->id;
    }


 public function getLibro_nombre(){
      return $this->libro_nombre;
 }

  public function getLibro_fecha() {
      return $this->libro_fecha;
  }

  public function getLibro_tipo() {
      return $this->libro_tipo;
  }

  public function getLibro_estado() {
      return $this->libro_estado;
  }

  public function getLibro_precio() {
      return $this->libro_precio;
  }

  public function getLibro_existencia() {
      return $this->libro_existencia;
  }

  public function getLibro_cantidad() {
      return $this->libro_cantidad;
  }

  public function getTsAlta(){
      return $this->tsAlta;
  }

    /**
     * @return Usuario
     */
   public function getLibroAlta() {
        return $this->libroAlta;
   }
 }

