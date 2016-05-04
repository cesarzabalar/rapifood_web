<?php 

require_once('modelo/ConexionBD.php');
require_once('modelo/Usuario.php');

/**
 * Clase con las funcionalidades para operar en la BD un pedido
 */
Class UsuarioDAO{

	private $conex;

	public function __construct(){
		$this->conex = new ConexionBD();
	}

	/**
	 * Obtiene todos los registros de la tabla
	 * @return [type] [description]
	 */
	public function getAll()
  {
    $query_select = "SELECT * FROM usuario WHERE estado = 1 ORDER BY idUsuario DESC"; 
    $statement = $this->conex->prepare($query_select);
    $statement->execute();
    $rs_usuarios = array();


    while($usuario = $statement->fetchObject('Usuario')){
      $rs_usuarios[] = $usuario;
    }

    if($rs_usuarios){
      return $rs_usuarios;
    }else{
      return null;
    }
  }

  /**
   * Inserta un nuevo registro
   * @param  [type] $usuario [description]
   * @return [type]          [description]
   */
  public function insert($usuario){
    $query_insert = "INSERT INTO usuario(idUsuario, nombreUsuario, codigoC2DM) VALUES (?,?,?)"; 

    try{
      $statement = $this->conex->prepare($query_insert);
      $statement->bindParam(1, $usuario->getIdUsuario());
      $statement->bindParam(2, $usuario->getNombreUsuario());
      $statement->bindParam(3, $usuario->getCodigoC2DM());
      $statement->execute();
        
    }catch( PDOException $Exception ) {
      $error = $Exception->getMessage( ).', '.$Exception->getCode( );
      echo $error;
      return 0;
    }

    return 1;
  }

  /**
   * Busca por la llave primaria
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
  public function find($id)
  {
    $query = "SELECT * FROM usuario WHERE idUsuario = ".$id." ORDER BY idUsuario DESC";

    try{
      $statement = $this->conex->prepare($query);
      $statement->execute();
      $this->conex->close_con();

      $rs_registros = array();

      while($registro = $statement->fetchObject('Usuario')){
        $rs_registros[] = $registro;
      }

      if($rs_registros){
        return $rs_registros;
      }else{
        return null;
      }
    }catch( PDOException $Exception ) {
      $error = $Exception->getMessage( ).', '.$Exception->getCode( );
      echo $error;
      echo false;
    }
  }

  /**
   * Buscar por un campo en específico
   * @param  [type] $field [description]
   * @param  [type] $value [description]
   * @return [type]        [description]
   */
  public function findBy($field, $value)
  {
    $query = "SELECT * FROM usuario WHERE ".$field." = '".$value."' ORDER BY idUsuario DESC";

    try{
      $statement = $this->conex->prepare($query);
      $statement->execute();
      $this->conex->close_con();

      $rs_registros = array();

      while($registro = $statement->fetchObject('Usuario')){
        $rs_registros[] = $registro;
      }

      if($rs_registros){
        return $rs_registros;
      }else{
        return null;
      }
    }catch( PDOException $Exception ) {
      $error = $Exception->getMessage( ).', '.$Exception->getCode( );
      echo $error;
      echo false;
    }
  }

  /**
   * Actualiza un registro
   * @param  [type] $usuario [description]
   * @return [type]          [description]
   */
  public function update($usuario){
    $query_update = "UPDATE usuario SET codigoC2DM = '".$usuario->getCodigoC2DM()."' 
                     WHERE nombreUsuario = '".$usuario->getNombreUsuario()."'"; 

    try{
      $statement = $this->conex->prepare($query_update);
      $statement->execute();
      $this->conex->close_con();
        
    }catch( PDOException $Exception ) {
      $error = $Exception->getMessage( ).', '.$Exception->getCode( );
      echo $error;
      return 0;
    }

    return 1;
  }

  /**
   * Actualiza el estado del pedido
   * @param  [type] $usuario [description]
   * @return [type]          [description]
   */
  public function updateStatus($usuario, $estado){
    $query_update = "UPDATE usuario SET estado = '".$estado."' 
                     WHERE nombreUsuario = '".$usuario."'"; 

    try{
      $statement = $this->conex->prepare($query_update);
      $statement->execute();
      $this->conex->close_con();
        
    }catch( PDOException $Exception ) {
      $error = $Exception->getMessage( ).', '.$Exception->getCode( );
      echo $error;
      return 0;
    }

    return 1;
  }
}

 ?>