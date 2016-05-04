function validarEstudiante(form,tipo){
	document.getElementById("txtType").value = tipo;

	switch (tipo) {
		case "save":
			save(form);
			break;

		case "update":
			update(form);
			break;

		case "delete":
			ddelete(form);
			break;

		case "search":
			search(form);
			break;

		case "list":
			form.submit();
			break;
		
	}
}


function save(form){
	if(document.getElementById("txtNombre").value != "" &&
		 document.getElementById("txtApellido").value != "" &&
		 document.getElementById("txtCodigo").value != "" &&
		 document.getElementById("txtCedula").value != "" &&
		 document.getElementById("txtEdad").value != "" &&
		 document.getElementById("txtSemestre").value != ""){

		form.submit();
	}else{
		createSnackbar("<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> Ingrese todos los datos","toast");
	}
}

function update(form){
	if(document.getElementById("txtNombre").value != "" &&
		 document.getElementById("txtApellido").value != "" &&
		 document.getElementById("txtCodigo").value != "" &&
		 document.getElementById("txtCedula").value != "" &&
		 document.getElementById("txtEdad").value != "" &&
		 document.getElementById("txtSemestre").value != "" &&
		 document.getElementById("txtId").value != ""){

		form.submit();
	}else{
		createSnackbar("<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> Realice una busqueda previa o ingrese todos los datos.", "toast");
	}
}

function ddelete(form){
	if(document.getElementById("txtId").value != ""){
		form.submit();
	}else{
		createSnackbar("<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> Por favor busque el registro a eliminar.", "toast");
	}
}

function search(form){
	if(document.getElementById("txtCodigo").value != ""){
		form.submit();
	}else{
		createSnackbar("<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> Por favor ingrese el código a buscar.", "toast");
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