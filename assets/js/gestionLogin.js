function validarLogin(formulario, tipo){
	document.getElementById("txtType").value = tipo;

	if(tipo == "con"){
		if(document.getElementById("txtUsuario").value != "" && document.getElementById("txtPassword").value != ""){
			formulario.submit();
		}else{
			createSnackbar("<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> Faltan campos por llenar", "toast");
		}
	}

	if(tipo == "desc"){
		formulario.submit();
	}
}


function createSnackbar(message, type){
	$.snackbar({
		content: message, // text of the snackbar
    style: type, // add a custom class to your snackbar
    timeout: 2000, // time in milliseconds after the snackbar autohides, 0 is disabled
    htmlAllowed: true, // allows HTML as content value
    onClose: function(){ } // callback called when the snackbar gets closed.
  });
}