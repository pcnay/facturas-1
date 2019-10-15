<!DOCTYPE html>
<?php
/*
  $alert = '';
  if(!empty($_POST))
  {
    if (empty($_POST['usuario']) || empty($_POST['clave']))
    {
      $alert = "Ingrese su Usuario y/o Clave";
    }
    else
    {
      if (!isset($_POST['usuario']) && !isset($_POST['clave']))
      {

      }

      
      require_once("./conexion.php");
      $user = $_POST['usuario'];
      $pass = $_POST['clave'];
      $query = mysqli_query($conection,"SELECT * FROM usuario WHERE usuario = '$user' AND clave = MD5('$pass') ");
      $result = mysqli_num_rows($query);
      if ($result>0)
      {
        $data = mysqli_fetch_array($query);
        // print_r($data);
        $_SESSION['active'] = true;
        $_SESSION['idUser'] = $data['idusuario'];
        $_SESSION['nombre'] = $data['nombre'];
        $_SESSION['email'] = $data['correo'];
        $_SESSION['user'] = $data['usuario'];
        $_SESSION['rol'] = $data['rol'];
        header('location:sistema/');
      }
      

    }
  }
  */
?>

<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Login Sistema De Facturacion</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" >
  </head>
  <body>
   <section id="container">
    
    <form action ="" method = "post">
      
      <h3>Iniciar Sesion</h3>
      <img src="img/login.png" alt="Login">
      <input type="text" name="usuario" placeholder="Usuario">
      <input type="password" name="clave" placeholder = "Contraseña">
      <!-- Utilizado para desplegar mensaje en la captura de contraseña--->

      <!-- <div class="alert"><?php //echo (isset($alert) ? $alert :'';) ?></div> -->
      <div class="alert"><?php echo isset($_GET['error'])?$_GET['error']:'' ; ?></div>

      <input type="submit" value="INGRESAR">
      
      <!-- Este formulario no tiene "action" por lo que al hacer "click" en este boton se autoprocesa, es decir vuelve a ejecutarse desde el inicio nuevamente-->

    </form>
    
   </section>

  </body>
</html>
 