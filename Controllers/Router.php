<?php
  require_once('ViewControllers.php');
  require_once('SessionController.php');

  class Router
  {
    public $route;
    public function __construct($route)
    {
      // !isset($_SESSION) = NO existe la variable Global
      if (!isset($_SESSION))
      {
        session_start
        ([
          // http://php.net/manual/es/function.session-start.php    
          // Revisar el archivo de configuracion "PHP.INI", en XAMPP.
          // se agrega un arreglo como parametro en la PHP 7, modifican en PHP.ini
          // Valores minímos para que opera la sesión en PHP 7

          "use_only_cookies" => 1,
          //x Este valor es solo modificable en ".htaccess, httpd.conf,user.ini
          // No tine sentido en tiempo de ejecución decirle a PHP que autinicie sesion
          // a la vez que inicias session.
          "auto_start", // <=======
          "read_and_close" => false // La sesion se cierre automaticamente.
                                    // Si se coloca a "true" no funciona la variable Global 
                                    // $_SESSION['ok'],
          /* Valores originales, pero no funciona en PHP Ver 7 
          "use_only_cookies" => 1,
          "auto_start" => 1,
          "read_and_close" => true
          */
        ]);
        //$_SESSION['ok'] = false;

      } // if (!isset($_SESSION))

      if (!isset($_SESSION['ok']))
      {
        $_SESSION['ok'] = false;
      }

      if ($_SESSION['ok'])
      {
        // Aqui va toda la programacion de la Aplicacion Web
        //print ("Seccion para la Aplicacion Web");

        // Determina a que ruta (Opcion del menu)
        $this->route = isset($_GET['r'])?$_GET['r']:'home';
        // Estas son las opciones del menu.
        $controller = new ViewControllers();
        switch($this->route)
        {
          case 'home':                    
            $controller->load_view('home');
            break;

          case 'salir':
            $user_session = new SessionController();
            $user_session->logout();
            break;
          default:
            $controller->load_view('error404');
            break;     
        }
        
      }
      else
      {
        if (!isset($_POST['usuario']) && !isset($_POST['clave']))
        {
          // Mostrar el formulario de Autenticación.        
          $login_form = new ViewControllers();
          $login_form->load_view('login');         
        }
        else
        {
          // Buscar al usuario (Del sistema) en la base de datos.
          $user_session = new SessionController();          
          $session = $user_session->login($_POST['usuario'],$_POST['clave']);
          
          if (empty($session))
          {
           // echo 'El Usuario y/o Password Son INCORRECTOS';
           $login_form = new ViewControllers();           
           $login_form->load_view('login');
           // Se envía informacion a las capas (View, Controller. Model) a través de las variables globales "$_GET, $_POST" 
           header('Location: ./?error=El Usuario '. $_POST['usuario']. 'y el Passoword proporcionado no coinciden');

          }
          else
          {
            //echo 'El Usuario y/o Password Son CORRECTOS';
            $_SESSION['ok'] = true;
            // Se crean las variables de session
            foreach ($session as $row)
            {
              $_SESSION['active'] = true;
              $_SESSION['idusuario'] = $row['idusuario'];
              $_SESSION['nombre'] = $row['nombre'];
              $_SESSION['correo'] = $row['correo'];
              $_SESSION['usuario'] = $row['usuario'];
              $_SESSION['rol'] = $row['rol'];
            }
            // Se vuelve a recargar este archivo , es decir se redireccion al home; y vuelve a realizar las comparaciones, es esta ocacion "$_SESSION['ok'] = true.
            header('Location: ./');
          }
        }
          
      }
    }

    public function __destruct()
    {
      unset($this);
    }
  }
?>