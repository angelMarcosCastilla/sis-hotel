

<?php
require "conexion.php";

class User
{
	private $acceso;

	public function __CONSTRUCT()
	{
		$conexion = new Conexion();
		$this->acceso = $conexion->getConexion();
	}

	public function iniciarSesion($nombreUsuario=""){
		try{
			$consulta = $this->acceso->prepare("CALL spu_usuarios_login(?)");
			$consulta->execute(array($nombreUsuario));
			return $consulta->fetch(PDO::FETCH_ASSOC);
		}catch(Exception $e){
			die($e->getMessage());
		}
	}
  
	public function registrarUsuario($data = [])
	{
		try {
			$consulta = $this->acceso->prepare("CALL spu_usuarios_registrar(?,?,?,?,?,?,?,?)");
			$consulta->execute( array(
				$data['nombres'],
				$data['apellidos'],
				$data['fechaNacimiento'],
				$data['telefono'],
				$data['documentoIdentidad'],				
				$data['email'],
				$data['nombreUsuario'],
				$data['claveAcceso']
			));
			return true;
		} catch (Exception $e) {
			die($e->getMessage());
		} 
	}

	public function obtenerUsuario($idUsuario = 0)
	{
		try {
			$consulta = $this->acceso->prepare("CALL spu_obtener_usuario(?)");
			$consulta->execute(array($idUsuario));
			return $consulta->fetch(PDO::FETCH_ASSOC);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
}