<?php

class Persona{
   public $persona_nombre;
   public $persona_apellido; 
   public $persona_cedula; 
   public $persona_telefono;
   public $persona_direccion; 
   public $persona_sexo; 
   public $id;
   public $persona_fecha;
   public $personaAlta;
   
   
   public function getPersona_nombre() {
       return $this->persona_nombre;
   }

   public function getPersona_apellido() {
       return $this->persona_apellido;
   }

   public function getPersona_cedula() {
       return $this->persona_cedula;
   }

   public function getPersona_telefono() {
       return $this->persona_telefono;
   }

   public function getPersona_direccion() {
       return $this->persona_direccion;
   }

   public function getPersona_sexo() {
       return $this->persona_sexo;
   }

   public function getId() {
       return $this->id;
   }

   public function getPersona_fecha() {
       return $this->persona_fecha;
   }

   public function getPersonaAlta() {
        return $this->personaAlta;
   }


}