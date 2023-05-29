

<?php
require "conexion.php";

class Estadistica
{
	private $acceso;

	public function __CONSTRUCT()
	{
		$conexion = new Conexion();
		$this->acceso = $conexion->getConexion();
	}

	public function obtenerTotalEstadosHabitacion()
	{
		try {
			$consulta = $this->acceso->prepare("CALL spu_totalestado_habitacion()");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_ASSOC);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function obtenerAlquileresHoy()
	{
		try {
			$consulta = $this->acceso->prepare("CALL spu_alquiladashoy_habitacion()");
			$consulta->execute();
			return $consulta->fetch(PDO::FETCH_ASSOC);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
}