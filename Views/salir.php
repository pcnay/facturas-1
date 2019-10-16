<?php
  require_once('./Controllers/SessionController.php');
  $salir = new SessionController();
  $salir->logout();

  
?>