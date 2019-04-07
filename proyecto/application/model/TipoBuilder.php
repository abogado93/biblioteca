<?php


class TipoBuilder
{
	public $id;
    public $tipo_descripcion;
    
    public function __construct($id) {
        $this->id = $id;
    }
    public function build(){
        return new Tipo($this);
    }
}