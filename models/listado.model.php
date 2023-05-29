<?php
require "conexion.php";

class Listado {
  private $acceso;

  public function __CONSTRUCT() {
    $conexion = new Conexion();
    $this->acceso = $conexion->getConexion();
  }

  public function listarPisos(){
    try {
      $consulta = $this->acceso->prepare("CALL spu_listar_pisos()");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function listarTipoHabitaciones(){
    try {
      $consulta = $this->acceso->prepare("CALL spu_listar_tipohabitaciones()");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }
}