<?php
  require_once('./modelo/UsersModel.php');

  class SessionController
  {
    private $session;
    public function __construct()
    {
      $this->session = new UsersModel(); // Accesa al Modelo de Usuarios.

    }
    public function __destruct()
    {
      unset($this);
    }
    public function login($usuario,$clave)    
    {
      return $this->session->validate_user($usuario,$clave);
    }

    public function logout()
    {

    }
    
  }
?>
