<?php
include_once "../models/alquiler.model.php";

if(isset($_POST["operacion"])){
  $alquiler = new Alquiler();

  if($_POST["operacion"] == "alquilar"){
    $datos = [
      "idPersona" => $_POST["idPersona"],
      "idEmpresa" => $_POST["idEmpresa"],
      "idHabitacion" => $_POST["idHabitacion"],
      "idUsuario" => $_POST["idUsuario"],
      "registroEntrada" => $_POST["registroEntrada"],
      "cantidadDias" => $_POST["cantidadDias"], 
      "precio" => $_POST["precio"], 
      "tipoComprobante" => $_POST["tipoComprobante"],  
      "huespedes" => $_POST["huespedes"]
    ];

    $isRegister = $alquiler->crearAlquiler($datos);

    echo json_encode([
      "success" => $isRegister,
      "message" => $isRegister ? "Habitación registrada correctamente" : "Error al registrar habitacion"
    ]);
  }

  if($_POST["operacion"] == 'buscarCliente'){
    $datos= $alquiler->buscarCliente($_POST["tipoComprobante"],$_POST["numeroComprobante"]);
    echo json_encode([
      "data" => $datos,
      "success" => true
    ]);
  }
  
}