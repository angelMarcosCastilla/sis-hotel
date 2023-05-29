<?php
session_start();
if (isset($_SESSION["seguridad"]) && $_SESSION["seguridad"]["login"]) {
  header("Location:./views/estadisticas.php");
}
?>

<!DOCTYPE html>
<html
  lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <link rel="stylesheet" href="./styles/base.css">
  <link rel="stylesheet" href="./styles/login.css">
</head>
<body>
  <div class="container-form">
    <div class="banner-img">
      <img src="./assets/bannerimg.svg" alt="">
    </div>
    <form action="" id="formLogin" autocomplete="off">
      <h1 >Iniciar sesion</h1>
      <div class="form__group">
        <label for="user">Nombre Usuario</label>
        <input type="text" name="nombreUsuario" required>
      </div>
      <div class="form__group">
        <label for="user">Contraseña</label>
        <input type="password" name="password" required>
      </div>
      <div style="text-align: right;">
        olvidates tu contraseña 👉<a href="#">recuperar</a>
      </div>
      <div style="margin-top: 2rem;">
        <button type="submit">Iniciar sesion</button>
      </div>
    </form>
  </div>
  <!-- <div class="wave">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
    <path fill="#0099ff" fill-opacity="1"
      d="M0,192L48,208C96,224,192,256,288,250.7C384,245,480,203,576,170.7C672,139,768,117,864,128C960,139,1056,181,1152,213.3C1248,245,1344,267,1392,277.3L1440,288L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
    </path>
  </svg>
  </div> -->
</body>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="./js/login.js" type="module"></script>
</html>