<?php 
require_once('dao/UsuarioDAO.php');

/**
 * EndPoint de la solicitud del dispositivo móvil
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Decodificando formato Json
	$body = json_decode(file_get_contents("php://input"), true);

	switch ($body['type']) {
		case 'register':
			registroCliente($body['usuario'], $body['regGCM']);
			break;
	}
}

/**
 * EndPoint del servicio para registrar usuarios del GCM
 * @param  [type] $nombreUsuario [description]
 * @param  [type] $regGCM        [description]
 * @return [type]                [description]
 */
function registroCliente($nombreUsuario, $regGCM){
	$daoUsuario = new UsuarioDAO();
	$cod = codigoCliente($nombreUsuario);

	$res = 0;

	$usuario = new Usuario();
	$usuario->setIdUsuario("");
	$usuario->setNombreUsuario($nombreUsuario);
	$usuario->setCodigoC2DM($regGCM);
	$usuario->setEstado(1);

	if($cod == null){
		//Se hace una inserción
		$res = $daoUsuario->insert($usuario);
	}else{
		//Se hace una actualizacion
		$res = $daoUsuario->update($usuario);
	}

	if($res == 1){
		$response = array('estado' => $res, 'mensaje' => 'Dispositivo almacenado');
	}else{
		$response = array('estado' => $res, 'mensaje' => 'Error en la operación');
	}

	echo json_encode($response);
	die();
}


/**
 * Busca la existencia de un cliente
 * @param  [type] $nombreUsuario [description]
 * @return [type]                [description]
 */
function codigoCliente($nombreUsuario){
	$daoUsuario = new UsuarioDAO();

	$response = $daoUsuario->findBy('nombreUsuario', $nombreUsuario);

	if($response){
		return $response[0]->getNombreUsuario();
	}else{
		return null;
	}
}


function guardarArchivo($contenido){
	$file = fopen("archivo.txt", "w");
	fwrite($file, $contenido . PHP_EOL);
	fclose($file);
}



 ?>