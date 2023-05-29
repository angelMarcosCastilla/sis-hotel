<?php
session_start();
include_once "../models/usuario.model.php";

if (isset($_GET['operacion'])) {
	$user = new User();

	if ($_GET["operacion"] == "cerrarSesion") {
		session_destroy();
		session_unset();
		header('Location:../Index.php');
	}
	if ($_GET["operacion"] == "iniciarSesion") {
		$acceso = [
			"login" => false,
			"apellidos" => "",
			"nombres" => "",
			"mensaje" => "",
			"email"=> ""
		];

		$data = $user->iniciarSesion($_GET['nombreUsuario']);
		$claveingresada = $_GET['password'];
		if ($data) {
			if (password_verify($claveingresada, $data["claveacceso"])) {
				$acceso["login"] = true;
				$acceso["apellidos"] = $data["apellidos"];
				$acceso["nombres"] = $data["nombres"];
				$acceso["email"] = $data["email"];
				$acceso["idusuario"] = $data["idusuario"];
			} else {
				$acceso["mensaje"] = "Error en la Contraseña por favor verificar";
			}
		} else {
			$acceso["mensaje"] = "Nombre de Usuario y Contreña no encontrados";
		}
		$_SESSION["seguridad"] = $acceso;

		echo json_encode($acceso);
	}

	if ($_GET["operacion"] == "registrarUsuario") {

		$data = [
			"nombres" => $_GET["nombres"],
			"apellidos" => $_GET["apellidos"],
			"documentoIdentidad" => $_GET["documentoIdentidad"],
			"telefono" => $_GET["telefono"],
			"fechaNacimiento"=>$_GET["fechaNacimiento"],
			"email" => $_GET["email"],
			"nombreUsuario" => $_GET["nombreUsuario"],
			"claveAcceso" =>password_hash($_GET["claveAcceso"], PASSWORD_BCRYPT)
		];

		$isUserRegister = $user->registrarUsuario($data);
		$response = [
			"success" => $isUserRegister,
			"message" => $isUserRegister ? "Usuario registrado correctamente" : "Error al registrar usuario"
		];
		echo json_encode($response);
	}
	if ($_GET["operacion"] == "obtenerUsuario") {
		$data = $user->obtenerUsuario($_GET["idUsuario"]);
		echo json_encode($data);
	}
} 

//qfbuebjdwiddrfal