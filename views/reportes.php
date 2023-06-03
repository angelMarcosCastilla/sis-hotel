<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../styles/base.css" />
  <link rel="stylesheet" href="../styles/main.css" />
  <link rel="stylesheet" href="../styles/reporte.css" />
</head>

<body>
  <?php include_once "../compents/sidebar.php" ?>
  <main>
    <?php include_once "../compents/haeader.php" ?>
    <h1>Reportes</h1>
    <div>
      <form action="" class="formReportAlquiler" id="formReportAlquiler">
        <div class="filterContainer">
        <div class="filterItem">
          <label for="startDate">Fecha de inicio</label>
          <input type="date" name="startDate" id="startDate" required>
        </div>
        <div class="filterItem">
          <label for="endDate">Fecha de fin</label>
          <input type="date" name="endDate" id="endDate" required>
        </div>
        <div class="button-container">
          <button class="btnBuscar" type="submit">
            Buscar
          </button>
          <button id="btnExportarPdf" type="button">
            pdf
          </button>
        </div>
        </div> 
      </form>
    </div>
    <div class="table-container">
      <table id="tableReportAlquiler" class="table">
        <thead class="table-head">
          <tr>
            <th class="table__head-cell" >N° Habitación</th>
            <th class="table__head-cell" >Tipo</th>
            <th class="table__head-cell" >entrada</th>
            <th class="table__head-cell" >Salida</th>
            <th class="table__head-cell" >tipo Comprobante</th>
            <th class="table__head-cell" >Cliente</th>
            <th class="table__head-cell" >total</th>
          </tr>
        </thead>
        <tbody id="tbodyReportAlquiler">
          
        </tbody>
      </table>
  </main>
  <script src="../js/main.js" type="module"></script>
  <script src="../js/report.js" type="module"></script>
</body>
</body>

</html>