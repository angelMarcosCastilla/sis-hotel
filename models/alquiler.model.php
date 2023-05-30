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
}