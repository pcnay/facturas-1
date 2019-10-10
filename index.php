<?php
  require_once ('./Controllers/Router.php');

  $route = isset($_GET['r']) ? $_GET['r']:'home';
  $facturacion = new Router($route);

?>