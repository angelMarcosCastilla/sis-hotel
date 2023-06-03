<?php

require "conexion.php";

class Reporte
{
	private $acceso;

	public function __CONSTRUCT()
	{
		$conexion = new Conexion();
		$this->acceso = $conexion->getConexion();
	}

	public function obtenerAlquilerEntreDosFechas($startDate, $endDate){
    try{
      $consulta = $this->acceso->prepare("CALL spu_alquileresentrefechas(?,?)");
      $consulta->execute(array($startDate, $endDate));
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }catch(Exception $e){
      die($e->getMessage());
    }
  }

  public function habitacionesMasAlquiladas(){
    try{
      $consulta = $this->acceso->prepare("CALL spu_habitacionesmasalquiladas()");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }catch(Exception $e){
      die($e->getMessage());
    }
  }
}