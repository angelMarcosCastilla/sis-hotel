<h1 class="text-md text-center">Reporte Habitación</h1>
<p>La siguiente tabla muestra cuantas veces una habitación ha sido alquilada  </p>
<table class="table table-border mt-3">
  <colgroup>
    <col style='width: 20%'>
    <col style='width:50%'>
    <col style='width:30%'>

  </colgroup>
  <thead>
    <tr>
    <th>Num Habitación</th>
    <th>Tipo Habitacion</th>
    <th>Total Alquiladas</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($datos as $registro): ?>
    <tr>
      <td><?=$registro['numHabitacion']?></td>
      <td><?=$registro['tipo']?></td>
      <td class="text-end"><?=$registro['total']?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>