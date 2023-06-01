<?php
include_once "../models/estadistica.model.php";

if(isset($_GET["operacion"])){
  $estadistica = new Estadistica();

  if($_GET["operacion"] == "obtenerTotalEstadosHabitacion"){
    $data = $estadistica->obtenerTotalEstadosHabitacion();
    echo json_encode([
      "data" => $data,
      "success" => true
    ]);
  }
  if($_GET["operacion"] == "obtenerAlquileresHoy"){
    $data = $estadistica->obtenerAlquileresHoy();
    echo json_encode([
      "data" => $data,
      "success" => true
    ]);
  }

  if($_GET["operacion"] == "obtenerAlquiladasEnlaUltimaSemana"){
    $data = $estadistica->obtenerAlquiladasEnlaUltimaSemana();
    echo json_encode([
      "data" => $data,
      "success" => true
    ]);
  }

  if($_GET["operacion"] == "tipoHabitacionMasAlquiladas"){
    $data = $estadistica->tipoHabitacionMasAlquiladas();
    echo json_encode([
      "data" => $data,
      "success" => true
    ]);
  }
}