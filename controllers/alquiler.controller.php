<?php
include_once "../models/alquiler.model.php";
session_start();

if(isset($_POST["operacion"])){
  $alquiler = new Alquiler();

  if($_POST["operacion"] == "alquilar"){
    $datos = [
      "idPersona" => $_POST["idPersona"],
      "idEmpresa" => $_POST["idEmpresa"],
      "idHabitacion" => $_POST["idHabitacion"],
      "idUsuario" => $_SESSION["seguridad"]["idusuario"],
      "registroEntrada" => $_POST["registroEntrada"],
      "cantidadDias" => $_POST["cantidadDias"], 
      "precio" => $_POST["precio"], 
      "tipoComprobante" => $_POST["tipoComprobante"],  
      "huespedes" => $_POST["huespedes"]
    ];

    $isRegister = $alquiler->crearAlquiler($datos);

    echo json_encode([
      "success" => $isRegister,
      "message" => $isRegister ? "Alquiler registrada correctamente" : "Error al Alquilar habitacion"
    ]);
  }

  if($_POST["operacion"] == 'buscarCliente'){
    $datos= $alquiler->buscarCliente($_POST["tipoComprobante"],$_POST["numeroDocumento"]);
    echo json_encode([
      "data" => $datos,
      "success" => true
    ]);
  }
  if($_POST["operacion"] == 'buscarHuesped'){
    $datos= $alquiler->buscarHuesped($_POST["numeroDocumento"]);
    echo json_encode([
      "data" => $datos,
      "success" => true
    ]);
  }
  
  if($_POST["operacion"] == "ObteberDetalleAlquiler"){
    $datos =  [
      "data" => [
        "alquiler" => [],
        "huespedes" => [],
        "cliente" => []
      ],
      "success" => true
    ];
    $datos["data"]["alquiler"] = $alquiler->obtenerDetallesAlquiler($_POST["idHabitacion"]);
    $datos["data"]["huespedes"] = $alquiler->obtenerDetallesHuespedes($_POST["idHabitacion"]);
    $datos["data"]["cliente"] = $alquiler->obtenercliente($_POST["idHabitacion"]);
    echo json_encode($datos);
  }

  if($_POST["operacion"] == "registrarSalida"){
    $isRegister = $alquiler->registrarSalida($_POST["idAlquiler"], $_POST["idHabitacion"]);
    echo json_encode([
      "success" => $isRegister,
      "message" => $isRegister ? "Salida registrada correctamente" : "Error al registrar salida"
    ]);
  }
  
  if($_POST["operacion"] == "actualizarHabitacionADisponible"){
    $isRegister = $alquiler->actualizarEstadoADisponible( $_POST["idHabitacion"]);
    echo json_encode([
      "success" => $isRegister,
      "message" => $isRegister ? "Salida registrada correctamente" : "Error al registrar salida"
    ]);
  }
}