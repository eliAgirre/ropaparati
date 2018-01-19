<?php
// Se requiere las sesiones para los mensajes flash
if( !session_id() ) session_start();
// Requiere la clase de mensajes y se instancia el objeto de tipo Messages
require_once('../controller/class.messages.php');
$msg = new Messages();
// Importar funciones de usuarios
include_once("../function/usuarios.php");
// Iniciar una nueva sesión o reanudar una sesión
session_start();
// Se obtienen los datos de la ventana modal
$email=$_POST['email'];
$password=$_POST['password'];
// Si los campos email, username, password o password2 están vacíos
if($_POST['email']==NULL or $_POST['password']==NULL){

	// Mensaje de error a mostrar
	$msg->add('e', 'ERROR: Los campos estan vacios');
	// Redirecciona a la página de login
	header('Location: ../view/login.php');
	// Imprime un mensaje y termina el script actual
	exit();
	
}
else{ // Si los campos no están vacíos

	// Se comprueba la estructura del email
	if(!preg_match("/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/",$email)){

		// Mensaje de error a mostrar
		$msg->add('e', 'ERROR: El email no tiene formato correcto, debe de ser ejemplo@ejemplo.com');
		// Redirecciona a la página de login
		header('Location: ../view/login.php');
		// Imprime un mensaje y termina el script actual
		exit();
	}
	else{

		if(usuarioExiste($_POST['email'])==="false"){
			// Mensaje de error a mostrar
			$msg->add('e', 'ERROR: Los datos no son validos');
			// Redirecciona a la página de login
			header('Location: ../view/login.php');
			// Imprime un mensaje y termina el script actual
			exit();

		}
		else{ // Si el usuario existe en la bd

			// Se comprueba si la contraseña coincide
			if(comprobarPassword($_POST['email'],md5($_POST['password']))==="true"){ //Si la contraseña coincide

				// Si el email coincide con el del administrador
				if($_POST['email']=="admin@admin.com"){
					// Se obtiene el id del usuario desde la bd
					$id_usuario=obtenerIdUsuario($_POST['email']);
					//Se establece la variable de sesión del usuario, que será el id.
					$_SESSION['id_user']=$id_usuario;				
					//Se establece la variable de sesión del usuario, que será el nombre de usuario.
					$_SESSION['user']="admin";							
					//Se establece la variable de sesión del usuario, que será el nombre de usuario.
					$_SESSION['email']="admin@admin.com";							
					// Redirecciona al perfil admin
					header("location: ../view/admin/admin.php");

				}
				else{ // Si no es administrador

					// Se obtiene el id del usuario desde la bd
					$id_usuario=obtenerIdUsuario($_POST['email']);
					// Se obtienen los datos del usuario mediante el id
					$datosUsuario=obtenerDatosUsuario($id_usuario);

					$nombreUsuario;
					// Recorremos los datos del usuario
					foreach ($datosUsuario as $key => $valor) {							
					    foreach ($valor as $campo => $value) {
					    	// Se obtiene el nombre de usuario
					    	if($campo==="usuario"){
					    		$nombreUsuario=$value;
					    	}
					    }
					}
					//Se establece la variable de sesión id_user
					$_SESSION['id_user']=$id_usuario;							
					//Se establece la variable de sesión user
					$_SESSION['user']=$nombreUsuario;							
					//Se establece la variable de sesión email
					$_SESSION['email']=$email;				

					// Redirecciona a la pagina anterior  ya logueado
					header("location:".$_SERVER['HTTP_REFERER']);					
				}
			}
			else{ // Si la contraseña no coincide

				// Mensaje de error a mostrar
				$msg->add('e', 'ERROR: La clave no es correcta');

				// Redirecciona a la página de login
				header('Location: ../view/login.php');

				// Imprime un mensaje y termina el script actual
				exit();

			} // Cierre del else porque la contraseña no coincide
		} // Cierre del else si el usuario existe
	} // Cierre del else si la estructura del mail no es correcta
} // Cierre del else porque los campos no están vacíos
?>