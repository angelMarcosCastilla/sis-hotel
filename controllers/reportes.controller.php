<?php
include_once "../models/reportes.model.php";

if (isset($_GET['operacion'])) {
  $reporte = new Reporte();

  if($_GET["operacion"] == "obtenerAlquilerEntreDosFechas"){
    $startDate = $_GET["startDate"];
    $endDate = $_GET["endDate"];
    $data = $reporte->obtenerAlquilerEntreDosFechas($startDate, $endDate);
    echo json_encode($data);
  }
}
