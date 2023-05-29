<?php
include_once "../models/listado.model.php";

if(isset($_GET["operacion"])){
  $listado = new Listado();

  if($_GET["operacion"] == "listarPisos"){
    $data = $listado->listarPisos();
    echo json_encode([
      "data" => $data,
      "success" => true
    ]);
  }

  if($_GET["operacion"] == "listarTipoHabitaciones"){
    $data = $listado->listarTipoHabitaciones();
    echo json_encode([
      "data" => $data,
      "success" => true
    ]);
  }
}