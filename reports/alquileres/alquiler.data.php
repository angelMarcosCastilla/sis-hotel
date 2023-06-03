<h1 class="text-md text-center">Reporte Alquiler</h1>
<table class="table table-border mt-3">
  <colgroup>
    <col style='width: 10%'>
    <col style='width:20%'>
    <col style='width:10%'>
    <col style='width:10%'>
    <col style='width:20%'>
    <col style='width:10%'>
    <col  class='text-end' style='width:10%'>
    <col  class='text-end' style='width:10%'>
  </colgroup>
  <thead>
    <tr>
    <th>N° Habitación</th>
    <th>Tipo</th>
    <th>entrada</th>
    <th>Salida</th>
    <th>tipo Comprobante</th>
    <th>Cliente</th>
    <th>total</th>
    </tr>
  </thead>
  <tbody>
      <?php foreach($datos as $registro): ?>
        <tr>
          <td><?=$registro['numHabitacion']?></td>
          <td><?=$registro['nombre']?></td>
          <td><?=$registro['registroentrada']?></td>
          <td><?=$registro['registrosalida']?></td>
          <td><?=$registro['tipocomprobante']?></td>
          <td><?=$registro['cliente']?></td>
          <td><?=$registro['total']?></td>
        </tr>
      <?php endforeach; ?>
  </tbody>
</table>