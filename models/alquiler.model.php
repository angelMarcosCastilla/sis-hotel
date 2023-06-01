<?php
require "conexion.php";

class Alquiler {
  private $acceso;

  public function __CONSTRUCT() {
    $conexion = new Conexion();
    $this->acceso = $conexion->getConexion();
  }

  public function crearAlquiler($datos = []){
    try {
      $consulta = $this->acceso->prepare("CALL spu_registrarAlquiler(?,?,?,?,?,?,?,?,?)");
      $consulta->execute(array(
        $datos['idPersona'],
        $datos['idEmpresa'],
        $datos['idHabitacion'],
        $datos['idUsuario'],
        $datos['registroEntrada'],
        $datos['cantidadDias'],
        $datos['precio'],
        $datos['tipoComprobante'],
        $datos['huespedes']
      ));
      return true;
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function buscarCliente($tipocomprobante, $numeroDocumento){
    try {
      $consulta = $this->acceso->prepare("CALL buscarclientes(?,?)");
      $consulta->execute(array($tipocomprobante, $numeroDocumento ));
      return $consulta->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
    
  }
  public function buscarHuesped($numeroDocumento){
    try {
      $consulta = $this->acceso->prepare("CALL buscarHuespedes(?)");
      $consulta->execute(array($numeroDocumento));
      return $consulta->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function obtenerDetallesAlquiler($idHabitacion){
    try{
      $consulta = $this->acceso->prepare("CALL spu_detalle_alquiler(?)");
      $consulta->execute(array($idHabitacion));
      return $consulta->fetch(PDO::FETCH_ASSOC);
    }catch(Exception $e){
      die($e->getMessage());
    }
  }

  public function obtenerDetallesHuespedes($idqluiler){
    try{
      $consulta = $this->acceso->prepare("CALL spu_detalle_huesped_alquiler(?)");
      $consulta->execute(array($idqluiler));
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }catch(Exception $e){
      die($e->getMessage());
    }
  }

  public function obtenercliente($alquiler){
    try{
      $consulta = $this->acceso->prepare("CALL spu_obtener_cliente(?)");
      $consulta->execute(array($alquiler));
      return $consulta->fetch(PDO::FETCH_ASSOC);
    }catch(Exception $e){
      die($e->getMessage());
    }
  }

  public function registrarSalida($idalquiler, $idHabitacion){
    try{
      $consulta = $this->acceso->prepare("CALL spu_registrarSalida(?, ?)");
      $consulta->execute(array($idalquiler, $idHabitacion));
      return true;
    }catch(Exception $e){
      die($e->getMessage());
    }
  }

  public function actualizarEstadoADisponible($idHabitacion){
    try{
      $consulta = $this->acceso->prepare("CALL spu_actualizarHabitacionADisponible(?)");
      $consulta->execute(array($idHabitacion));
      return true;
    }catch(Exception $e){
      die($e->getMessage());
    }
  }
}