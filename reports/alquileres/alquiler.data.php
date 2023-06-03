<h1 class="text-md text-center">Reporte Alquiler</h1>
<p >Fecha de inicio: <?=$startDate?></p>
<p>Fecha de fin: <?=$endDate?></p>
<table class="table table-border mt-3">
  <colgroup>
    <col style='width: 10%'>
    <col style='width:15%'>
    <col style='width:15%'>
    <col style='width:20%'>
    <col style='width:30%'>
    <col style='width:10%'>
  </colgroup>
  <thead>
    <tr>
    <th>N° Hab</th>
    <th>Tipo</th>
    <th>entrada</th>
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
          <td><?=explode(' ', $registro['registroentrada'])[0]?></td>
          <td><?=$registro['tipocomprobante']?></td>
          <td><?=$registro['cliente']?></td>
          <td><?=$registro['total']?></td>
        </tr>
      <?php endforeach; ?>
  </tbody>
</table>