<?php
  session_start();
  // Para validar los roles de los usuarios.
  // Solo tiene acceso a esta pantalla el Administrador (1)
  if ($_SESSION['rol'] != 1)
  {
    header ("location: ./");
  }

  include "../conexion.php";
  
  // Cuando el usuario oprime el boton de "Actualizar usuario"
  if (!empty($_POST))
  {
    $alert = '';
    $option = '';
    if (empty ($_POST['nombre']) || empty ($_POST['correo']) || empty ($_POST['usuario']) || empty ($_POST['rol']) )
    {
      $alert = '<p class = "msg_error">Todos los campos son obligatorios</p>';
    }
    else 
    {
      //Se retorna una carpeta, ya que este archivo se encuentra en el subdirectorio "sistema"
      $idusuario = $_POST['id'];
      $nombre = $_POST['nombre'];
      $correo = $_POST['correo'];
      $usuario = $_POST['usuario'];
      $clave = MD5($_POST['clave']);
      $rol = $_POST['rol'];

      /* Para mostrarlo en pantalla, la consulta y se detiene la ejecución del programa.
      echo " SELECT * FROM usuario WHERE (usuario = '$usuario' AND idusuario != $idusuario)
      OR (correo = '$correo' AND idusuario != $idusuario)";
      exit;
      */

      // Revisando que no existe el correo y usuario.
      $query = mysqli_query($conexion,"SELECT * FROM usuario WHERE (usuario = '$usuario' AND idusuario != $idusuario)
      OR (correo = '$correo' AND idusuario != $idusuario)");


      $result = mysqli_fetch_array($query);
      $result = count($result);
      if ($result > 0)
      {
        $alert = '<p class = "msg_error">El correo y/o usuario ya existe </p>';        
      }
      else
      {
        if (empty($_POST['clave']))
        {
          $sql_update = mysqli_query($conexion,"UPDATE usuario
                                                SET nombre = '$nombre', correo='$correo', usuario='$usuario',rol = $rol
                                                WHERE idusuario = $idusuario");

        }
        else
        {
          $sql_update = mysqli_query($conexion,"UPDATE usuario
                                                SET nombre = '$nombre', correo='$correo', usuario='$usuario',clave = '$clave',rol = $rol
                                                WHERE idusuario = $idusuario");

        }

        
        if ($sql_update)
        {
          $alert = '<p class= "msg_save">Usuario Actualizado Correctamente</p>';
        }
        else
        {
          $alert = '<p class = "msg_error">Error al Actualiar El Usuario</p>';        
        }
        
        
      }      
      
    }

    //mysqli_close($conexion);

  }
  // Recuperar los datos de los usuarios.
  // Valida que tenga valor el "id" que se encuentra en la URL. 
  // De estar en blanco se volvera a recargar la página de "lista_usuarios.php".
  if (empty($_REQUEST['id']))
  {
    header ('Location: lista_usuarios.php');
    //mysqli_close($conexion);
  }
  // Se obtiene el valor del id de la URL que se asigna en el href de Listado de Usuarios.
  $iduser = $_GET['id'];
  $sql = mysqli_query($conexion,"SELECT u.idusuario,u.nombre,u.correo,u.usuario, (u.rol) as idrol,(r.rol) as rol 
  FROM usuario u
  INNER JOIN rol r
  ON u.rol = r.idrol
  WHERE idusuario = $iduser AND estatus=1");

  //mysqli_close($conexion);

  $result_sql = mysqli_num_rows($sql);
  if ($result_sql == 0)
  {
    header ('Location: lista_usuarios.php');
  }
  else
  {
    $option = '';
    while ($data=mysqli_fetch_array($sql))
    {
      $iduser = $data['idusuario'];
      $nombre = $data['nombre'];
      $correo = $data['correo'];
      $usuario = $data['usuario'];
      $idrol = $data['idrol'];
      $rol = $data['rol'];
      // Para mostrar el nombre del rol que le pertenece al usuario.
      if ($idrol == 1)
      {
        $option = '<option value = "'.$idrol.'" select>'.$rol.'</option>';
      }
      else if ($idrol == 2)
      {
        $option = '<option value = "'.$idrol.'" select >'.$rol.'</option>';
      }
      else if ($idrol == 3)
      {
        $option = '<option value = "'.$idrol.'" select >'.$rol.'</option>';
      }


    }
  }
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/script.php"; ?>

	<title>Actualizar Usuarios</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
    <div class = "form_register">
      <h1><i class="fas fa-user-edit"></i> Actualizar Usuarios</h1>
      <hr>
      <div class="alert"><?php echo isset($alert) ? $alert: ''; ?></div>
      <!-- El formulario se autoprocesa, es decir que cuando se oprima el Input Submit se vuelve a ejecutar el archivos desde el inicio. -->
      <form action ="" method="POST">
        <!-- Campo oculto, solo se utiliza para pasar información desde el formulario. -->
        <input type="hidden" name = "id" value = "<?php echo $iduser; ?>">
         
        <label for="nombre">Nombre </label>
        <input type="text" name="nombre" id="nombre" placeholder =" Nombre completo" value = "<?php echo $nombre; ?>">
        <label for="correo">Correo Electronico </label>
        <input type="email" name="correo" id="correo" placeholder ="Correo Electronico" value = "<?php echo $correo; ?>">
        <label for="usuario">Usuario </label>
        <input type="text" name="usuario" id="usuario" placeholder ="Usuario" value = "<?php echo $usuario; ?>">
        <label for="clave">Clave</label>
        <input type="password" name="clave" id="clave" placeholder ="Clave de acceso">
        <label for="rol">Tipo Usuario</label>

        <?php
          include "../conexion.php";
          $query_rol = mysqli_query($conexion,"SELECT * FROM rol ");
          //mysqli_close($conexion);
          $result_rol = mysqli_num_rows($query_rol);
        ?>
        
        <!-- Para obtener los registros de la tabla "rol" -->
        <select name = "rol" id = "rol" class ="notItemOne">
          <?php
            echo $option;
            if ($result_rol > 0)
            {
              while ($rol = mysqli_fetch_array($query_rol))
              {
          ?> 
                <option value = "<?php echo $rol['idrol']; ?>"><?php echo $rol['rol']; ?> </option>
          <?php
              }
            }
          ?>
            
        </select>
        <!-- <input type ="submit" value = "Actualizar Usuario" class = "btn_save"> -->
        <button type ="submit" class = "btn_save"><i class="fas fa-user-edit"></i> Actualizar Usuario</button>


      </form>
    </div>
	
	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>