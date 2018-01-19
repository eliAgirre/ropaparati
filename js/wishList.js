$(document).ready(function() {

	$(".btnMeGusta").click(function(event) {

		event.preventDefault();
		var meGusta=this;
		var id=$(meGusta).attr("value");
		// Se crea un objeto JSON para enviar a la página PHP
	   	var datosClick = {
	        codigoBarras : $(meGusta).attr("name"),
	        idUser : $(meGusta).attr("value") 
	    };

	    // Se envía el valor al archivo php
	    $.ajax({

	    	type: "POST", //método post
		  	url: "../model/gustarProducto.php", // archivo que va a recibir nuestro pedido
		  	dataType: "json", // indicamos que el formato utilizado es JSON
		  	data: datosClick, // el objeto JSON con los datos 

			// función que se ejecutará cuando obtengamos la respuesta
 		  	success:function(data){

 		  		if (data.exito != true){
 		  			
 		  			$('#message').css('background','url(../image/messages/tick.png ) no-repeat 0px 50%');
	             	$('#message').css('background-color','#E0FBCC');
	             	$('#message').css('border','1px solid #6DC70C');
	             	$('#message').html('<p style="margin-left:20px;color:#3C7500;padding-top:5px;">¡Fabuloso! Se ha añadido a tu lista de deseos</p>');
	             	$('#centroM').load('../include/recargarMujer.php?id='+id);
	             	$('#centro').load('../include/recargarVestidos.php?id='+id);
	            }
	            else{

	            	$("#message").css("background","url(../image/messages/help.png ) no-repeat 0px 50%");
	             	$("#message").css("background-color","#B0CEF5");
	             	$("#message").css("border","1px solid #82AEE7");
	             	$("#message").html("<p style='margin-left:20px;color:#1A3960;padding-top:5px;'>Ya has añadido, ve a tu perfil!</p>");
	            }

		  	}

        }); // Cierre ajax

	}); // Cierre función click

});// Cierre de jQuery