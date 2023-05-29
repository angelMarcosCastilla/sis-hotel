<?php
require "conexion.php";

class Habitacion {
  private $acceso;

  public function __CONSTRUCT() {
    $conexion = new Conexion();
    $this->acceso = $conexion->getConexion();
  }

  public function obtener() {
    try {
      $consulta = $this->acceso->prepare("CALL spu_listar_habitaciones()");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function registrar($datos=[]){
    try {
      $consulta = $this->acceso->prepare("CALL spu_registrar_habitacion(?,?,?,?,?)");
      $consulta->execute(array(
        $datos['numHabitacion'],
        $datos['tipoHabitacion'],
        $datos['detalles'],
        $datos['precio'],
        $datos['piso']
      ));
      return true;
    } catch (Exception $e) {
     return false;
    }
  }

  public function eliminar($idHabitacion=0){
    try {
      $consulta = $this->acceso->prepare("CALL spu_eliminar_habitacion(?)");
      $consulta->execute(array($idHabitacion));
      return true;
    } catch (Exception $e) {
      return false;
    }
  }

  public function editar($datos=[]){
    try {
      $consulta = $this->acceso->prepare("CALL spu_actualizar_habitacion(?,?,?,?,?,?)");
      $consulta->execute(array(
        $datos['idHabitacion'],
        $datos['numHabitacion'],
        $datos['tipoHabitacion'],
        $datos['detalles'],
        $datos['precio'],
        $datos['piso']
      ));
      return true;
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

}