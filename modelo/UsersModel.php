<?php
  require_once('modelo/model.php');
  class UsersModel extends Model
  {
    // Se definen los atributos de la tabla

    public $idusuario;
    public $nombre;
    public $correo;
    public $usuario;
    public $clave;
    public $rol;
    public $status;

    public function __construct()
    {
      // El controlador no debe saber nada del Modelo.      
      $this->db_name = 'facturacion';
    }

    // Se tienen que definir los métodos en la clase Abstracta 
    public function create($user_data = array())
    {
      foreach ($user_data as $key => $value)
      {
        // http://php-net/manual/es/language.variables.varible.php
        // Variables Variable. "$$" para convertila en una variable dinámica.
        // Por lo que el contenido del arreglo cada elemento asociativo el valor de clave se convierte en variable es decir en $idrol, $rol, $otraValor , etc. depende del contenido del arreglo asociativo.
        $$key = $value;        
      }

      $this->query = "INSERT INTO usuario (idusuario,nombre,correo,usuario,clave,rol,estatus) VALUES ($idusuario,'$nombre','$correo','$usuario','$clave','$rol','$estatus')";
      $this->set_query();
    }

    public function read($user_id = '')
    {
      // Si no viene con parámetro se le asigna valor de blanco.
      $this->query = ($user_id != '')?"SELECT * FROM usuario WHERE idusuario = '$user_id'":"SELECT * FROM usuario";
      /* 
        if($user_id != '')
        {
          $sql = "SELECT * FROM usuario";
        }
        else
        {
          $sql = "SELECT * FROM usuario WHERE idusuario = '$user_id'";
        }
      */
      // Devuelve un arreglo
      //var_dump($this->query);
      $this->get_query();
      //Convierte a cada de Texto un objeto y se muestra en pantalla.
      // Determina el número de elementos del arreglo.
      //$num_rows = count($this->rows);
      $data = array();
      
      // Para pasar la consulta obtenida a un arreglo posiconal.
      // $clave = Extrae el valor de "key" del arreglo asociativo y lo asigna a "$value" 
      foreach ($this->rows as $key => $value)
      {
        // Agrega ual final del arreglo una nueva posicion.
        array_push($data,$value);
        //$data[$key] = $value;
      }

      // Retorna un arreglo 
      //var_dump($data);
      return $data;
    }

    public function delete($idusuario)
    {
      $this->query = "DELETE FROM usuario WHERE idusuario = $idusuario";
      $this->set_query();
    }
    
    public function update($user_data = array())
    {
      foreach ($user_data as $key => $value)
      {
        // http://php-net/manual/es/language.variables.varible.php
        // Variables Variable. "$$" para convertila en una variable dinámica.
        // Por lo que el contenido del arreglo cada elemento asociativo el valor de clave se convierte en variable es decir en $idrol, $rol, $otraValor , etc. depende del contenido del arreglo asociativo.
        $$key = $value;        
      }
      // El campo "idrol" no se actualiza, ya que es unico y no se cambia
      $this->query = "UPDATE usuario SET idusuario = $idusuario, nombre = '$nombre', correo = '$correo', usuario = '$usuario', clave = '$clave', rol = '$rol', estatus = '$estatus' WHERE idusuario = $idusuario";

      $this->set_query();

    }

    public function validate_user($usuario,$clave)
    {
      //print(' funcion Validate_User,  Valor 1 = '.$usuario);
      //print ('Valor 2 = '.$clave);
      //exit;

      $this->query = "SELECT * FROM usuario WHERE usuario = '$usuario' AND clave = MD5('$clave')";
      $this->get_query();
      $data = array();
      foreach ($this->rows as $Campo => $Valor)
      {
        array_push($data,$Valor);
      }
      //var_dump($data);

      return $data;

    }

    public function set()    
    {

    }
    public function get()
    {

    }
    public function del()
    {

    }


  }
?>
