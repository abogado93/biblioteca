<?php


class PagoBuilder
{
   public $id;
   public $pago_fecha;
   public $pago_multa;
   public $pago_monto;
   public $pago_prestamo_id;
   public $pago_estado;
    
    public function __construct($id) {
        $this->id = $id;
    }
    public function build(){
        return new Pago($this);
    }
} 