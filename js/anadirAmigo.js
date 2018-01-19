$(document).ready(function() {

	$("#anadirAmigo").click(function(event) {

		event.preventDefault();
		var amigo=this;
		var nombre=$(amigo).attr("name");
		var username=$(amigo).attr("value");
		// Se crea un objeto JSON para enviar a la página PHP
	   	var datosClick = {
	        amigo : nombre,
	        user : username 
	    };

	    // Se envía el valor al archivo php
	    $.ajax({

	    	type: "POST", //método post
		  	url: "../model/anadirAmigo.php", // archivo que va a recibir nuestro pedido
		  	dataType: "json", // indicamos que el formato utilizado es JSON
		  	data: datosClick, // el objeto JSON con los datos 

			// función que se ejecutará cuando obtengamos la respuesta
 		  	success:function(data){

 		  		if (data.exito != true){
 		  			
 		  			$('#botonAmigo').load('../include/anadirAmigo.php?usuario='+nombre+'&user='+username);
 		  			//alert("¡Fabuloso! Se ha añadido a tu lista de amigos");	
 		  			$('#message').css('background','url(../image/messages/tick.png ) no-repeat 0px 50%');
	             	$('#message').css('background-color','#E0FBCC');
	             	$('#message').css('border','1px solid #6DC70C');
	             	$('#message').html('<p style="margin-left:20px;color:#3C7500;padding-top:5px;">¡Fabuloso! Se ha añadido a tu lista de amigos</p>');	  			
	            }
	            else{

	            	$('#botonAmigo').load('../include/anadirAmigo.php?usuario='+nombre);
				    $("#message").css("opacity", 0.8);
			     	$("#message").css("background-color","#A0E7D7");
			     	$("#message").html("<p style='margin-left:20px;color:white;padding-top:5px;opacity:1;'>Ya es tú amigo, ve a tu perfil!</p>");
	            }

		  	}

        }); // Cierre ajax

	}); // Cierre función click

	$("#amigo").click(function() {

	    $("#message").css("opacity", 0.8);
     	$("#message").css("background-color","#A0E7D7");
     	$("#message").html("<p style='margin-left:20px;color:white;padding-top:5px;opacity:1;'>Ya es tú amigo, ve a tu perfil!</p>");

	}); // Cierre función click

});// Cierre de jQuery