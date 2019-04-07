<?php

class Pago{
   public $id;
   public $pago_fecha;
   public $pago_multa;
   public $pago_monto;
   public $pago_prestamo_id;
   public $pago_estado;
	
	
	
   public function getId() {
       return $this->id;
   }

   public function getPago_fecha() {
       return $this->pago_fecha;
   }

   public function getPago_multa() {
       return $this->pago_multa;
   }

   public function getPago_monto() {
       return $this->pago_monto;
   }

   public function getPago_prestamo_id() {
       return $this->pago_prestamo_id;
   }

   public function getPago_estado() {
       return $this->pago_estado;
   }

 
  
  


}