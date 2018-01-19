$(document).ready(function() {
	// Se ocultan el botón
	$("#enviar").fadeOut();
	$("#enviarPatron").fadeOut();
	$('#radios').fadeOut();

	// Se obtiene la imagen seleccionada
	var subirImagen = document.getElementById('subirfoto');
	subirImagen.addEventListener('change', dibujarImagen, false);
	// Se obtiene la id de la etiqueta canvas
	var canvas = document.getElementById('areaCanvas');
	// Se establece que el dibujo va a ser de 2 dimensiones
	var dibujo = canvas.getContext('2d');
	var imagen;
	var imagenSrc;

	function dibujarImagen(e){
		// Se crea un objeto de tipo FileReader
		var fichero = new FileReader();
		// Cuando el fichero ha sido seleccionado
		fichero.onload = function(event){

			// Se crea el objeto Imagen
			imagen = new Image();
			// Al cargar la imagen se realizan las siguientes instrucciones
			imagen.onload = function(){

				// Si la anchura y la altura se exceden de 149px
				if(imagen.width > 149 || imagen.height > 149){
	        		// Saca un aviso por pantalla
	        		$("#messages").css("display","block");
					$("#messages").css("background","url(../images/messages/cross.png ) no-repeat 0px 30%");
					$("#messages").css("background-color","#FFF0EF");
					$("#messages").css("border","1px solid #C42608");
					$("#messages").css("border-radius","5px");
					$("#messages").css("width","30%");
					$("#messages").css("margin","10px 10px 10px 500px");
					$("#messages").html("<center><p style='color:#c00 !important;width:60%;padding:5px;'>La imagen debe ser de 149 x 149 px.</p></center>");
	       		}
	       		else{
	       			// Muestra el botón
	       			$("#enviar").fadeIn();
					// Eliminamos el atributo disabled del botón
	       			$("#enviar").removeAttr("disabled");
	       			// Oculta el mensaje flash
	       			$("#messages").css("display","none");

					// Se establece la anchura de canvas respecto a la imagen
					canvas.width = imagen.width;
					// Se establece la altura de canvas respecto a la imagen
					canvas.height = imagen.height;
					// Se dibuja la imagen
					dibujo.drawImage(imagen,0,0);
				}
			}
			//coge desde local el archivo
	       imagen.src = event.target.result;
	       imagenSrc = imagen.src;

		}
		// Lee la url del fichero para mostrar la imagen
		fichero.readAsDataURL(e.target.files[0]);
	} // Cierre de la función dibujarImagen

	// Función para enviar datos al PHP
	$("#enviar").click(function(event) {

		event.preventDefault();

		// Se obtiene el usuario y el nombre desde los atributos name y value del botón enviar
		var usuario=document.getElementById("enviar").name;
		var nombre=document.getElementById("enviar").value;

		$.ajax({

			type: "POST",
			url: "../model/canvas.php",
			data: {

	        	imgSrc : imagenSrc,
	        	id_usuario: usuario,
	        	nombreUsuario: nombre

	    	},

			// función que se ejecutará cuando obtengamos la respuesta
			success:function(data){

				dibujo.clearRect(0, 0, canvas.width, canvas.height);

		  		$('#recargaImagen').load('../include/anadirImagen.php?nombreUsuario='+nombre);	
		  		$("#bnw").fadeOut();
				$("#enviar").fadeOut();
				$("#colour").fadeOut();	

			}
		}); // Cierre del Ajax
	}); // Cierre de la función click

	var subirPatron = document.getElementById('subirPatron');
	subirPatron.addEventListener('change', dibujarPatron, false);
	var canvasPatron = document.getElementById('canvasPatron');
	var patron = canvasPatron.getContext('2d');
	var imagen2;
	var imagenSrc2;
	var path;

	function dibujarPatron(e){

		// Se crea un objeto de tipo FileReader
		var fichero = new FileReader();
		// Cuando el fichero ha sido seleccionado
		fichero.onload = function(event){
			// Se obtiene la carpeta + nombre archivo
			//path=$('#subirPatron').val();
			// Se crea el objeto Imagen
			imagen2 = new Image();
			// Al cargar la imagen se realizan las siguientes instrucciones
			imagen2.onload = function(){

				// Si la anchura y la altura se exceden de 149px
				if(imagen2.width > 149 || imagen2.height > 149){
	        		// Saca un aviso por pantalla
	        		$("#message").css("display","block");
					$("#message").css("background","url(../images/messages/cross.png ) no-repeat 0px 30%");
					$("#message").css("background-color","#FFF0EF");
					$("#message").css("border","1px solid #C42608");
					$("#message").css("border-radius","5px");
					$("#message").css("width","30%");
					$("#message").css("margin","10px 10px 10px 500px");
					$("#message").html("<center><p style='color:#c00 !important;width:60%;padding:5px;'>La imagen debe ser de 149 x 149 px.</p></center>");
	       		}
	       		else{
	       			// Muestra el botón
	       			$("#enviarPatron").fadeIn();
	       			$('#radios').fadeIn();
					// Eliminamos el atributo disabled del botón
	       			$("#enviarPatron").removeAttr("disabled");
	       			// Oculta el mensaje flash
	       			$("#message").css("display","none");

					// Se establece la anchura de canvas respecto a la imagen
					canvasPatron.width = imagen2.width;
					// Se establece la altura de canvas respecto a la imagen
					canvasPatron.height = imagen2.height;
					// Se dibuja la imagen
					patron.drawImage(imagen2,0,0);
				}
			}
			//coge desde local el archivo
	       imagen2.src = event.target.result;
	       imagenSrc2 = imagen2.src;

		}
		// Lee la url del fichero para mostrar la imagen
		fichero.readAsDataURL(e.target.files[0]);
	} // Cierre de la función dibujarImagen

	// Radio buttons
	$('.btn[data-radio-name]').click(function() {
		// Elimina la clase 'active'
	    $('.btn[data-radio-name="'+$(this).data('radioName')+'"]').removeClass('active');
	    // Obtiene el valor de la radio
	    $('input[name="'+$(this).data('radioName')+'"]').val(
	        $(this).text()
	    );

	}); // Cierre del click de radioButtons

	// Función para enviar datos al PHP
	$("#enviarPatron").click(function() {

		event.preventDefault();

		// Se obtiene el usuario y el nombre desde los atributos name y value del botón enviarPatron
		var usuario=document.getElementById("enviarPatron").name;
		var nombre=document.getElementById("enviarPatron").value;
		var radio=document.getElementById("radioInput").value;

		$.ajax({

			type: "POST",
			url: "../model/patron.php",
			data: {

				id_usuario: usuario,
				usuario: nombre,
	        	imgSrc : imagenSrc2,
	        	publico: radio

	    	},

			// función que se ejecutará cuando obtengamos la respuesta
			success:function(data){

				patron.clearRect(0, 0, canvasPatron.width, canvasPatron.height);

		  		$('#listaPatrones').load('../include/anadirPatron.php?usuario='+nombre);	
				$("#enviarPatron").fadeOut();
				$('#radios').fadeOut();	
				//alert("ok");

			}
		}); // Cierre del Ajax

	}); // Cierre de la función click enviarPatron

	
}); // Cierre de jQuery