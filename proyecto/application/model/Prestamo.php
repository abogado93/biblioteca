<?php

class Prestamo{
   public $id;
   public $prestamo_fecha;
   public $prestamo_estado;
   public $prestamo_persona;
   public $prestamo_libro_id;
   public $prestamo_devolucion;
   public $prestamo_dias;
   public $prestamo_cantidad;
   public $prestamo_pago;
	
	
   public function getId() {
       return $this->prestamo_id;
   }

   public function getPrestamo_fecha() {
       return $this->prestamo_fecha;
   }

   public function getPrestamo_estado() {
       return $this->prestamo_estado;
   }

   public function getPrestamo_persona() {
       return $this->prestamo_persona;
   }

   public function getPrestamo_libro_id() {
       return $this->prestamo_libro_id;
   }

   public function getPrestamo_devolucion() {
       return $this->prestamo_devolucion;
   }

   public function getPrestamo_dias() {
       return $this->prestamo_dias;
   }

   public function getPrestamo_cantidad() {
       return $this->prestamo_cantidad;
   }

   public function getPrestamo_pago() {
       return $this->prestamo_pago;
   }




}