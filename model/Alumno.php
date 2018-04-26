<?php


class Alumno {
    
   private $cedula;
   private $nombres;
   private $nota1;
   private $nota2;
   private $promedio;
   
   public function getCedula() {
       return $this->cedula;
   }

   public function getNombres() {
       return $this->nombres;
   }

   public function getNota1() {
       return $this->nota1;
   }

   public function getNota2() {
       return $this->nota2;
   }

   public function getPromedio() {
       return $this->promedio;
   }

   public function setCedula($cedula) {
       $this->cedula = $cedula;
   }

   public function setNombres($nombres) {
       $this->nombres = $nombres;
   }

   public function setNota1($nota1) {
       $this->nota1 = $nota1;
   }

   public function setNota2($nota2) {
       $this->nota2 = $nota2;
   }

   public function setPromedio($promedio) {
       $this->promedio = $promedio;
   }


}
