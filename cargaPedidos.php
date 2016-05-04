<?php 
require_once('dao/UsuarioDAO.php');
require_once('envio.php');

//Recibe las peticiones AJAX
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	switch ($_POST['accion']) {
		case 'enviar': //Caso para enviar una notificación
			enviarNotificacion();
			break;

		case 'cambio_estado': //Caso para actualizar el estado del pedido
			actualizarEstado();
			break;
		
		default: //Por defecto lista en la interfaz la cantidad de registros
			cargarLista();
			break;
	}
}

/**
 * Función que recopila la info a enviar al servicio
 * @return [type] [description]
 */
function enviarNotificacion(){
	$nombreUsuario = $_POST['usuario'];

	$daoUsuario = new UsuarioDAO();
	$response = $daoUsuario->findBy('nombreUsuario', $nombreUsuario);

	//Verifica que exista el pedido
	if($response){
		$response = $response[0];
		$dataPost = array('registration_id'=>$response->getCodigoC2DM(),
 										  'collapse_key'=>date('l, F d, Y'),
 										  'data.msg'=>'Su pedido '.$nombreUsuario.' esta listo');
	

		$out = sendNotification($dataPost);
		$out = explode('=', $out);
		if($out[0] == 'id'){
			$return = array('mensaje' => 'Notificación enviada.');	
		}else{
			$return = array('mensaje' => 'Error en el envío.');	
		}
	}else{
		$return = array('mensaje' => 'No existe el pedido registrado.');
	}

	echo json_encode($return);
}


/**
 * Función para consultar los registros existentes
 * @return [type] [description]
 */
function cargarLista(){
	$daoUsuario = new UsuarioDAO();
	$response = $daoUsuario->getAll();

	if($response){
		crearLista($response);
	}else{
		echo "Sin registros.";
	}
}

/**
 * Función que arma la tabla con el listado en la Interfaz
 * @param  [type] $resultado [description]
 * @return [type]            [description]
 */
function construirListado($resultado){

	$cadenaHTML = "<div class='table-responsive'>";
	$cadenaHTML .= "<table class='table table-striped table-hover table-condensed'>";
	$cadenaHTML .= "<thead>";
	$cadenaHTML .= "<tr>";
	$cadenaHTML .= "<th>N°</th>";
	$cadenaHTML .= "<th>Pedido ID</th>";
	$cadenaHTML .= "<th>Acción</th>";
	$cadenaHTML .= "<th>Estado</th>";
	$cadenaHTML .= "</tr>";
	$cadenaHTML .= "</thead>";
	$cadenaHTML .= "<tbody>";

	$x = 1;
	foreach ($resultado as $key => $usuario) {

		$cadenaHTML .= "<tr>";
		$cadenaHTML .= "<td>".$x."</td>";
		$cadenaHTML .= "<td>".$usuario->getNombreUsuario()."</td>";
		$cadenaHTML .= '<td><a name="usuariobtn"  rel="'.$usuario->getNombreUsuario().'" class="btnEnviarNoti btn btn-success btn-fab btn-fab-mini"><i class="material-icons">send</i></a></td>';
		$cadenaHTML .= '<td><div class="row-action-primary checkbox"><label><input type="checkbox"></label></div></td>';
		$cadenaHTML .= "</tr>";
		$x++;
	}

	$cadenaHTML .= "</tbody>";
	$cadenaHTML .= "</table>";
	$cadenaHTML .= "</div>";

	echo $cadenaHTML;
}

function crearLista($resultado){

	$x = 1;
	$cadenaHTML = '<div class="list-group">';
	foreach ($resultado as $key => $usuario) {

		if($x > 1){
	  	$cadenaHTML .= '<div class="list-group-separator"></div>';
	  }

	  $status = "";
	  if($usuario->getEstado() == 1){
	  	$status = "checked";
	  }

	
	  $cadenaHTML .= '<div class="list-group-item">';
	  $cadenaHTML .= '<div class="row-picture">';
	  $cadenaHTML .= '<img class="circle" src="http://lorempixel.com/56/56/people/'.$x.'" alt="icon">';
	  $cadenaHTML .= '</div>';
	  $cadenaHTML .= '<div class="row-content">';
	  $cadenaHTML .= '<div class="action-secondary"><a name="usuariobtn"  rel="'.$usuario->getNombreUsuario().'" class="btnEnviarNoti btn btn-success btn-fab btn-fab-mini"><i class="material-icons">send</i></a></div>';
	  $cadenaHTML .= '<h4 class="list-group-item-heading text-success">Pedido # '.$usuario->getNombreUsuario().'</h4>';

	  $cadenaHTML .= '<p class="list-group-item-text">Estado: <input id="'.$usuario->getNombreUsuario().'" class="inputEstado" type="checkbox" name="estado" data-size="mini" '.$status.'></p>';
	  $cadenaHTML .= '</div>';
	  $cadenaHTML .= '</div>';

	  $x++;

	}

	$cadenaHTML .= '</div>';
	echo $cadenaHTML;
}


function actualizarEstado(){
	$nombreUsuario = $_POST['usuario'];
	$estado = $_POST['estado'];

	$daoUsuario = new UsuarioDAO();
	$response = $daoUsuario->updateStatus($nombreUsuario, $estado);

	//Verifica que exista el pedido
	if($response){
		$return = array('mensaje' => 'Estado de pedido cambiado');	
	}else{
		$return = array('mensaje' => 'Error al cambiar el estado.');
	}

	echo json_encode($return);
}

 ?>