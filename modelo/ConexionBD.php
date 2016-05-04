<?php 

/**
 * Clase con la estructura de conexión general para el proyecto usando PDO
 */
Class ConexionBD extends PDO{  

  /** Constantes de conexión */
  const DB_HOST = 'localhost'; //Servidor
  const DB_USER = 'root'; //Usuario de la BD
  const DB_PASS = ''; // Password de la BD
  const DB_NAME = 'db_usuariosgcm'; //Nombre de la BD

  private $pdoApp;

  public function __construct()
  {
    try {
      $this->pdoApp = parent::__construct("mysql:host=".self::DB_HOST.";dbname=".self::DB_NAME, 
                                          self::DB_USER, 
                                          self::DB_PASS,
                                          array(
                                            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                                          ));
    }
    catch( PDOException $Exception ) {
        $error = $Exception->getMessage( ).', '.$Exception->getCode( );
        echo $error;
        die();
    }
    return $this->pdoApp;
  }

  /**
   * [close_con description]
   * @return [type] [description]
   */
  public function close_con() 
  {
    $this->pdoApp = null; 
  }

  /**
   * Método genérico de consulta
   * @param  String $query Cadena de la consulta
   * @return [Object]        Retorna los registros como objetos genericos
   */
  public function ejecutar_select($query)
  {
    $statement = $this->pdoApp->prepare($query);
    $statement->execute();
    $rs_registros = array();


    while($registro = $statement->fetchObject()){
      $rs_registros[] = $registro;
    }

    if($rs_registros){
      return $rs_registros;
    }else{
      return null;
    }
  }

  
}
?>