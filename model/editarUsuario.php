<?php
// Se requiere las sesiones para los mensajes flash
if( !session_id() ) session_start();
// Requiere la clase de mensajes y se instancia el objeto de tipo Messages
require_once('../controller/class.messages.php');
$msg = new Messages();
// Se importa la conexión con la base de datos
require_once '../config/database.php';
$db = new Database();
$db->connect();
// Se importan las funciones para comprobar u obtener datos
include_once("../function/usuarios.php");
// Iniciar una nueva sesión o reanudar una sesión
session_start();	
// Si los campos username o password están vacíos
if($_POST['nombre']==NULL or $_POST['password']==NULL){

	// Mensaje de error a mostrar
	$msg->add('e', 'ERROR: Los campos estan vacios');
	// Redirecciona al perfil del usuario
	header('Location: ../view/profile.php');
	// Imprime un mensaje y termina el script actual
	exit();

}
else{ // Si los campos no están vacíos

	// Se comprueba si la contraseña coincide
	if(verificarPassword($_SESSION["user"],md5($_POST['password']))==="true"){ //Si la contraseña coindice
		// Se establece la variable mediante el valor de la variable de sesión
		$id_usuario=$_SESSION["id_user"];
		// Si existe un usuario con el mismo nombre de usuario introducido
		if(usernameExiste($_POST['nombre'])==="true"){
			// Mensaje de error a mostrar
			$msg->add('e', 'ERROR: El nombre de usuario ya existe.');
			// Redirecciona al perfil del usuario
			header('Location: ../view/profile.php');
			// Imprime un mensaje y termina el script actual
			exit();

		}
		else{

			// Sentencia UPDATE
            $sql="UPDATE usuarios SET usuario=? WHERE _id='".$id_usuario."';";
            $update=$db->update($sql,$_POST['nombre']);
			// Se obtiene el nombre de usuario de la BD
			$nombreUsuario=obtenerUsuario($id_usuario);
			// Se establece la variable de sesión del nombre de usuario
			$_SESSION["user"]=$nombreUsuario;
   			// Muestra mensaje exitoso
			$msg->add('s', 'Cambio realizado');
			// Redirecciona al perfil del usuario
			header('Location: ../view/profile.php');
			// Se realizan el mismo cambio en otras tablas de la BD
			$sqlPatrones="UPDATE patrones SET usuario=? WHERE _idUsuario='".$id_usuario."';";
            $updatePatrones=$db->update($sqlPatrones,$_POST['nombre']);
            $sqlWish="UPDATE wishlist SET user=? WHERE idUser='".$id_usuario."';";
            $updateWish=$db->update($sqlWish,$_POST['nombre']);
            $sqlUser="UPDATE amigos SET username=? WHERE _idUser='".$id_usuario."';";
            $updateUser=$db->update($sqlUser,$_POST['nombre']);
            $sqlAmigo="UPDATE amigos SET amigo=? WHERE _idAmigo='".$id_usuario."';";
            $updateAmigo=$db->update($sqlAmigo,$_POST['nombre']);
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
} // Cierre del else si los campos no están vacíos
?>