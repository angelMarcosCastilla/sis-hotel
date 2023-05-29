<?php
require "conexion.php";

class Alquiler {
  private $acceso;

  public function __CONSTRUCT() {
    $conexion = new Conexion();
    $this->acceso = $conexion->getConexion();
  }

  public function crearAlquiler($datos){
    //TODO hace el crear alquiler
  }
}