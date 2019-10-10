<?php
  require_once('./modelo/UsersModel.php');

  class SessionController
  {
    private $session;
    public function __construct()
    {
      $this->session = new UserModels();

    }
    public function __destruct()
    {
      unset($this);
    }
    public function login()
    {

    }
    public function logout()
    {

    }
    
  }
?>
