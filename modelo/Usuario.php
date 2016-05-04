<?php 
/**
 * Clase que modela un usuario o dispositivo registrado en el sistema
 */
Class Usuario{

  /**
   * Identificador primario del registro
   * @var int
   */
	private $idUsuario;

  /**
   * Nombre o ID del pedido
   * @var String
   */
  private $nombreUsuario;

  /**
   * ID único del registro de un dispositivo
   * @var String
   */
  private $codigoC2DM;

  /**
   * Indica si será visible o no el pedido
   * @var boolean
   */
  private $estado;
  
  function __construct() {
      
  }
  
  public  function getIdUsuario() {
      return $this->idUsuario;
  }

  public  function getNombreUsuario() {
      return $this->nombreUsuario;
  }

  public function getCodigoC2DM() {
      return $this->codigoC2DM;
  }

  public function getEstado() {
      return $this->estado;
  }

  public function setIdUsuario($idUsuario) {
      $this->idUsuario = $idUsuario;
  }

  public function setNombreUsuario($nombreUsuario) {
      $this->nombreUsuario = $nombreUsuario;
  }

  public function setCodigoC2DM($codigoC2DM) {
      $this->codigoC2DM = $codigoC2DM;
  }

  public function setEstado($estado) {
      $this->estado = $estado;
  }
}

 ?>