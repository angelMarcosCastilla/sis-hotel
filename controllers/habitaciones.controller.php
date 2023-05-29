<?php
  include_once "../models/habitacion.model.php";

if(isset($_POST["operacion"])){
  $habitacion = new Habitacion();

  if($_POST["operacion"] == "listar"){
    $data = $habitacion->obtener();
    echo json_encode([
      "data" => $data,
      "success" => true
    ]);
  }

  if($_POST["operacion"] == "eliminar"){
    $isDelete = $habitacion->eliminar($_POST["idHabitacion"]);
    echo json_encode([
      "success" => $isDelete,
      "message" => $isDelete ? "Habitación eliminada correctamente" : "Error al eliminar habitacion"
    ]);
  }
    
  
  if($_POST["operacion"] == "registrar"){
    $datos = [
      "numHabitacion" => $_POST["numHabitacion"],
      "tipoHabitacion" => $_POST["tipoHabitacion"],
      "detalles" => $_POST["detalles"],
      "precio" => $_POST["precio"],
      "piso" => $_POST["piso"]
    ];
    $isRegister = $habitacion->registrar($datos);

    echo json_encode([
      "success" => $isRegister,
      "message" => $isRegister ? "Habitación registrada correctamente" : "Error al registrar habitacion"
    ]);
  }
  if($_POST["operacion"] == "editar"){
    $datos = [
      "idHabitacion" => $_POST["idHabitacion"],
      "numHabitacion" => $_POST["numHabitacion"],
      "tipoHabitacion" => $_POST["tipoHabitacion"],
      "detalles" => $_POST["detalles"],
      "precio" => $_POST["precio"],
      "piso" => $_POST["piso"]
    ];

    $isEdit = $habitacion->editar($datos);
    
    echo json_encode([
      "success" => $isEdit,
      "message" => $isEdit ? "Habitación editada correctamente" : "Error al editar habitacion"
    ]);
  }
}
