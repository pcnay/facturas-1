<?php
  class ViewControllers
  {
    private static $view_path = './Views/';
    
    public function __destruct()
    {
      unset($this);
    }

    public function load_view($view)
    {
      //Se agregan la Cabecera, Cuerpo y Pie de página de la pantalla.
      require_once(self::$view_path.'header.php');
      require_once(self::$view_path.$view.'.php');
      require_once(self::$view_path.'footer.php');
      
    }
  }
  
?>