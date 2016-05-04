<?php 
	//Constante con el key de la API para el Server
	define('SERVER_KEY', 'AIzaSyCB-0Tt_M-xvb5jxVRAdce_eGxGnMorsMM');

	/**
	 * Función que realiza la petición HTTP POST al servicio de Google
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	function sendNotification($data){

		$url = "https://android.googleapis.com/gcm/send";

		// Se verifica si el CURL está instalado y activo
    if (!function_exists('curl_init')){
        die('Sorry cURL is not installed!');
    }

		$parametros = "";
		foreach ($data as $key => $value) {
			$parametros .= $key."=".$value."&";
		}

		//Cadena codificada con todos los parametros
		$parametros = trim($parametros, '&');


		//Cabeceras
    $header[] = 'Authorization: key='.SERVER_KEY;
    $header[] = 'Content-Length: '.strlen($parametros);

		$cr = curl_init();
		curl_setopt($cr, CURLINFO_HEADER_OUT, true);
		curl_setopt($cr, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($cr, CURLOPT_HTTPHEADER, $header);
		curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($cr, CURLOPT_URL, $url);
		curl_setopt($cr, CURLOPT_POST, true); 
		curl_setopt($cr, CURLOPT_POSTFIELDS, $parametros);
		curl_error($cr);
		
		$output = curl_exec($cr);
		//$info = curl_getinfo($cr);
		curl_close($cr);

		return $output;
	}


 ?>