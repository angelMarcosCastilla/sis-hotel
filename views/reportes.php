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
    <h1>Reportes de Alquileres</h1>
    <div>
      <form action="" class="formReportAlquiler" id="formReportAlquiler">
        <div style="display:flex; justify-content:space-between; align-items: flex-end">

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
            <button class=""  id="btnExportarPdf" type="button">
              pdf
            </button>
            
          </div>
        </div> 
        <a href="../reports/habitacion/habitacion.report.php" target="_blank" class="enlace" > <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: currentColor ;transform: ;msFilter:;"><path d="M8.267 14.68c-.184 0-.308.018-.372.036v1.178c.076.018.171.023.302.023.479 0 .774-.242.774-.651 0-.366-.254-.586-.704-.586zm3.487.012c-.2 0-.33.018-.407.036v2.61c.077.018.201.018.313.018.817.006 1.349-.444 1.349-1.396.006-.83-.479-1.268-1.255-1.268z"></path><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zM9.498 16.19c-.309.29-.765.42-1.296.42a2.23 2.23 0 0 1-.308-.018v1.426H7v-3.936A7.558 7.558 0 0 1 8.219 14c.557 0 .953.106 1.22.319.254.202.426.533.426.923-.001.392-.131.723-.367.948zm3.807 1.355c-.42.349-1.059.515-1.84.515-.468 0-.799-.03-1.024-.06v-3.917A7.947 7.947 0 0 1 11.66 14c.757 0 1.249.136 1.633.426.415.308.675.799.675 1.504 0 .763-.279 1.29-.663 1.615zM17 14.77h-1.532v.911H16.9v.734h-1.432v1.604h-.906V14.03H17v.74zM14 9h-1V4l5 5h-4z"></path></svg>Habitaciones mas alquiladas</a>
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