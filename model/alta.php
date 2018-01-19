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
// Iniciar una nueva sesión o reanudar una sesión
session_start();
// Se obtienen los datos de la ventana modal
$email=$_POST['email'];
$usuario=$_POST['username'];
$password=$_POST['password'];
$password2=$_POST['password2'];
$id; // Declaración variable global
$emails=array(); // Array vacío
$select=array(); // Array vacío
// Sentencia SELECT
$sql="SELECT * FROM usuarios";
$select=$db->select($sql);
// Se recore el array de la consulta
foreach ($select as $key => $valor) {
    foreach ($valor as $campo => $value) {

        if($campo==="id"){
        	$id=$value;
        }
        if($campo==="email"){
        	array_push($emails, $value);
        }
    }
}
// Si los campos email, username, password o password2 están vacíos
if($_POST['email']==NULL or $_POST['username']==NULL or $_POST['password']==NULL or $_POST['password2']==NULL){

	// Mensaje de error a mostrar
	$msg->add('e', 'ERROR: Los campos estan vacios');
	// Redirecciona a la página de alta
	header('Location: ../view/alta.php');
	// Imprime un mensaje y termina el script actual
	exit();
	
}
else{ // Si los campos no están vacíos

	// Se comprueba la estructura del email
	if(!preg_match("/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/",$email)){

		// Mensaje de error a mostrar
		$msg->add('e', 'ERROR: El email no tiene formato correcto, debe de ser ejemplo@ejemplo.com');
		// Redirecciona a la página de alta
		header('Location: ../view/alta.php');
		// Imprime un mensaje y termina el script actual
		exit();
	}
	else{

		// Se comprueba si las contraseñas coinciden
		if(!($_POST["password"]==$_POST["password2"])){

			// Mensaje de error a mostrar
			$msg->add('e', 'ERROR: Las claves no coinciden');
			// Redirecciona a la página de alta
			header('Location: ../view/alta.php');
			// Imprime un mensaje y termina el script actual
			exit();

		}
		else{ // Si las contraseñas coinciden

			// Si no hay resultados en la tabla de usuarios, inserta directamente el usuario
			if(!$select){
				$id=0; // Se establece el valor 0
				// Lee la imagen y convierte a base64
				$imageData = base64_encode(file_get_contents("../image/users/default.jpg"));
				// Formato de SRC:  data:{mime};base64,{data};
				//{mime}--> El formato de la imagen, ej.:image/jpeg
				$src = 'data: '.mime_content_type("../image/users/default.jpg").';base64,'.$imageData;
				// random ID del usuario
				$seed = str_split('abcdefghijklmnopqrstuvwxyz0123456789'); //caracteres
			    shuffle($seed); // probably optional since array_is randomized; this may be redundant
			    $rand = '';
			    foreach (array_rand($seed, 15) as $k) $rand .= $seed[$k];
				$password_encrypt=md5($password); // password encriptado
				$id++;
			    // Se inserta el usuario en la bd
				$sql="INSERT INTO usuarios (id,_id, email, usuario, password, fotoUsu) 
					VALUES ($id,'$rand', '$email', '$usuario', '$password_encrypt', '$src');";
				$insert=$db->insert($sql);
				if($insert==="true"){
					// Si la variable de sesión de user no tiene valor
					if (!isset($_SESSION["user"])){ 
						// Se establece la variable de sesión usuario
						$_SESSION["user"] = $usuario; 
						// Se establece la variable de sesión id
						$_SESSION["id_user"] = $rand;
						$_SESSION["email"]=$email;
					}				
					// Redirecciona al perfil del usuario
					header("location: ../view/profile.php");
				}
			}
			else{
				// Se recorre el array de emails
				foreach ($emails as $key => $value) {
					if($value===$email){
						// Mensaje de error a mostrar
						$msg->add('e', 'ERROR: El usuario ya existe');
						// Redirecciona a la página de alta
						header('Location: ../view/alta.php');
						// Imprime un mensaje y termina el script actual
						exit();
					}
				}
				$id++;
				// Lee la imagen y convierte a base64
				$imageData = base64_encode(file_get_contents("../image/users/default.jpg"));
				// Formato de SRC:  data:{mime};base64,{data};
				//{mime}--> El formato de la imagen, ej.:image/jpeg
				$src = 'data: '.mime_content_type("../image/users/default.jpg").';base64,'.$imageData;
				// random ID del usuario
				$seed = str_split('abcdefghijklmnopqrstuvwxyz0123456789'); //caracteres
			    shuffle($seed); // probably optional since array_is randomized; this may be redundant
			    $rand = '';
			    foreach (array_rand($seed, 15) as $k) $rand .= $seed[$k];
			    $password_encrypt=md5($password); // password encriptado
			    // Se inserta el usuario en la bd
				$sql="INSERT INTO usuarios (id,_id, email, usuario, password, fotoUsu) 
					VALUES ($id,'$rand', '$email', '$usuario', '$password_encrypt', '$src');";
				$insert=$db->insert($sql);
				if($insert==="true"){
					$_SESSION["user"]=NULL;
					// Si la variable de sesión de user no tiene valor
					if (!isset($_SESSION["user"])){ 
						// Se establece la variable de sesión usuario
						$_SESSION["user"] = $usuario; 
						// Se establece la variable de sesión id
						$_SESSION["id_user"] = $rand;
						$_SESSION["email"]=$email;
					}
					// Redirecciona al perfil del usuario
					header("location: ../view/profile.php");
				}
			    
			} // Cierre del else si en la tabla hay datos
		} // // Cierre del else si las contraseñas coinciden
	} // Cierre del else si la estructura del mail no es correcta
} // Cierre del else porque los campos no están vacíos

?>