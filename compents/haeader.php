<?php
session_start();
if (!isset($_SESSION["seguridad"]) || !$_SESSION["seguridad"]["login"]) {
  header("Location:../index.php");
}
?>
<header class="header ">

  <div>
    HOLA:
    <?php echo $_SESSION["seguridad"]["nombres"] . " " . $_SESSION["seguridad"]["apellidos"] ?>
  </div>
  <div class="header__right">
    <div>
      <label class="switch">
        <input type="checkbox" id="toggleTheme">
        <span class="slider round"></span>
      </label>
    </div>
    <a href="../controllers/user.controller.php?operacion=cerrarSesion" aria-label="Cerrar session">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
        class="feather feather-log-out">
        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
        <polyline points="16 17 21 12 16 7"></polyline>
        <line x1="21" y1="12" x2="9" y2="12"></line>
      </svg>
    </a>
  </div>
</header>