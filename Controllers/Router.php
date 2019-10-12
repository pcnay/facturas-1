<?php
  require_once('ViewControllers.php');
  
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
        print ("Seccion para la Aplicacion Web");
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
          $user_session = new SessionController();

          
        }
          
      }
    }

    public function __destruct()
    {
      unset($this);
    }
  }
?>