<?php
// Se requiere las sesiones para los mensajes flash
if( !session_id() ) session_start();
// Requiere la clase de mensajes y se instancia el objeto de tipo Messages
require_once('../controller/class.messages.php');
$msg = new Messages();
// Se importan las funciones para comprobar u obtener datos
include_once("../function/usuarios.php");
// Se importa la conexión con la base de datos
require_once '../config/database.php';
$db = new Database();
$db->connect();
// Iniciar una nueva sesión o reanudar una sesión
session_start();	
// Si los campos username o password están vacíos
if($_POST['email']==NULL or $_POST['password']==NULL){

	// Mensaje de error a mostrar
	$msg->add('e', 'ERROR: Los campos estan vacios');
	// Redirecciona al perfil del usuario
	header('Location: ../view/profile.php');
	// Imprime un mensaje y termina el script actual
	exit();

}
else{ // Si los campos no están vacíos

	$email=$_POST['email'];
	// Se comprueba la estructura del email
	if(!preg_match("/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/",$email)){

		// Mensaje de error a mostrar
		$msg->add('e', 'ERROR: El email no tiene formato correcto, debe de ser ejemplo@ejemplo.com');
		// Redirecciona al perfil del usuario
		header('Location: ../view/profile.php');
		// Imprime un mensaje y termina el script actual
		exit();


	}else{

		// Se comprueba si la contraseña coincide
		if(verificarPassword($_SESSION["user"],md5($_POST['password']))==="true"){ //Si la contraseña coindice

			// Se establece la variable mediante el valor de la variable de sesión
			$id_usuario=$_SESSION["id_user"];

			// Si existe un usuario con el mismo email introducido
			if(usuarioExiste($_POST['email'])==="true"){

				// Mensaje de error a mostrar
				$msg->add('e', 'ERROR: Ya existe un usuario');
				// Redirecciona al perfil del usuario
				header('Location: ../view/profile.php');
				// Imprime un mensaje y termina el script actual
				exit();

			}
			else{

				// Sentencia UPDATE
	            $sql="UPDATE usuarios SET email=? WHERE _id='".$id_usuario."';";
	            $update=$db->update($sql,$email);
				// Se obtiene el nombre de usuario de la BD
				$email=obtenerEmail($id_usuario);
				// Se establece la variable de sesión del nombre de usuario
				$_SESSION["email"]=$email;
	   			// Muestra mensaje exitoso
				$msg->add('s', 'Cambio realizado');
				// Redirecciona al perfil del usuario
				header('Location: ../view/profile.php');
				// Imprime un mensaje y termina el script actual
				exit();

			}
		
		}
		else{ // Si la contraseña no coincide

			// Mensaje de error a mostrar
			$msg->add('e', 'ERROR: La clave no es correcta');
			// Redirecciona al perfil del usuario
			header('Location: ../view/profile.php');
			// Imprime un mensaje y termina el script actual
			exit();

		} // Cierre del else porque la contraseña no coincide

	} // Si la contraseña coincide
	
} // Cierre del else si los campos no están vacíos
?>