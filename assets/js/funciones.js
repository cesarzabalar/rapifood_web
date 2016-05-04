$(function () {
  $.material.init();
  $(".inputEstado").bootstrapSwitch();

  llenarListado();

  /**
   * Evento de click sobre el boton de enviar la notificación
   */
  $('#listaUsuarios').on('click', '.btnEnviarNoti',function (ev) {
		var id = $(this).attr('rel');
		enviarNotificacion(id);
	});	

  //Cambia el estado del pedido
	$('#listaUsuarios').on('switchChange.bootstrapSwitch', '.inputEstado',function (ev, state) {
		var id = $(this).attr('id');
		actualizarEstado(id, state);
	});

  //Ejecuta la función infinitamente cada 3 segundos
	setInterval('llenarListado()',3000);

});

/**
 * Función que realiza la petición AJAX que llena en la interfaz el listado de pedidos
 * @return {[type]} [description]
 */
function llenarListado(){
	$.ajax({
		url: 'cargaPedidos.php',
		type: 'POST',
		dataType: 'html',
		data: {accion: 'listar'},
		success: function (data) {
			 
			 $('#listaUsuarios').html(data);
			 $(".inputEstado").bootstrapSwitch();
		}
	});
}

/**
 * Función ejecutada en el evento click del boton de envío
 * @param  {[type]} id [description]
 * @return {[type]}    [description]
 */
function enviarNotificacion(id){
	$.ajax({
		url: 'cargaPedidos.php',
		type: 'POST',
		dataType: 'json',
		data: {accion: 'enviar', usuario: id},
		success: function (data) {

			//Procesar respuesta
			createSnackbar(data.mensaje); 
		}
	});
}

function actualizarEstado(id, state){
	$.ajax({
		url: 'cargaPedidos.php',
		type: 'POST',
		dataType: 'json',
		data: {accion: 'cambio_estado', usuario: id, estado: state},
		success: function (data) {

			//Procesar respuesta
			createSnackbar(data.mensaje); 
		}
	});
}

/**
 * Función que inicializa un mensaje para mostrar en pantalla
 * @param  {[type]} message [description]
 * @param  {[type]} type    [description]
 * @return {[type]}         [description]
 */
function createSnackbar(message, type){
	$.snackbar({
		content: message, // text of the snackbar
    style: type, // add a custom class to your snackbar
    timeout: 2000, // time in milliseconds after the snackbar autohides, 0 is disabled
    htmlAllowed: true, // allows HTML as content value
    onClose: function(){ } // callback called when the snackbar gets closed.
  });
}