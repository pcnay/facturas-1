<?php
  $host = 'localhost';
  $user = 'facturas';
  $password = 'pcnay2003';
	$db = 'facturacion';
	//$db = 'ordenservicios';
  $conection = new mysqli('localhost','facturas','pcnay2003','facturacion');
  if (!$conection)
  {
    echo "Error en la conexion";
	}
	else
	{
		echo "Conexion exitosa";
	}
?>
