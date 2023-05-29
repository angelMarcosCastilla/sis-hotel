<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../styles/base.css" />
  <link rel="stylesheet" href="../styles/main.css" />
  <link rel="stylesheet" href="../styles/estadisticas.css" />
</head>

<body>
  <?php include_once "../compents/sidebar.php" ?>
  <main>
    <?php include_once "../compents/haeader.php" ?>
    <div class="card-Detalles" id="cardDetalles">
      
    </div>
    <div class="container-grafica">
      <div class="grafica-item">
          <canvas id="grafico1"></canvas>
      </div>
      <div class="grafica-item">
        <canvas id="grafico2"></canvas>
      </div>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="../js/main.js" type="module"></script>
  <script src="../js/estadisticas.js" type="module"></script>
</body>

</html>