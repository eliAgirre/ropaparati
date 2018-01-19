<?php
// Se requiere las sesiones para los mensajes flash
if( !session_id() ) session_start();
// Requiere la clase de mensajes y se instancia el objeto de tipo Messages
require_once('../../controller/class.messages.php');
$msg = new Messages();
$id;
$nombreColeccion=$_POST['nombreColeccion'];
$ano=$_POST['ano'];
$temporada=$_POST['temporada'];
$genero=$_POST['sex'];
$ano2=substr($ano, -2); // Se obtiene los dos últimos dígitos del año
$cod=$temporada."".$ano2."".$genero;
// Se importa la conexión con la base de datos
require_once '../../config/database.php';
$db = new Database();
$db->connect();
// Sentencia SELECT
$sql="SELECT * FROM colecciones;";
$select=$db->select($sql);
// Se recore el array de la consulta
foreach ($select as $key => $valor) {
    foreach ($valor as $campo => $value) {

    	if($campo==="id"){
        	$id=$value; // Se guarda la id de la última
        }
	}
}
// Si los campos nombreColeccion, ano, temporada o sex están vacíos
if($_POST['nombreColeccion']==NULL or $_POST['ano']==NULL or $_POST['temporada']==NULL or $_POST['sex']==NULL){

	// Mensaje de error a mostrar
	$msg->add('e', 'ERROR: Los campos estan vacios');
	// Redirecciona a la página de añadir colecciones
	header('Location: ../../view/admin/anadirColeccion.php');
	// Imprime un mensaje y termina el script actual
	exit();
}
else{ // Si los campos no están vacíos

	// Si no hay resultados en la tabla de usuarios, inserta directamente el usuario
	if(!$select){

		$id=0;
		$id++; // Aumenta el número de id
		$sql="INSERT INTO colecciones (id,cod, nombreColeccion, ano, temporada, genero) 
				VALUES ($id,'$cod', '$nombreColeccion', '$ano', '$temporada', '$genero');";
		$insert=$db->insert($sql);					
		// Mensaje de error a mostrar
		$msg->add('s', '¡FABULOSO! Colección añadido');
		// Redirecciona a la página de añadir colecciones
		header('Location: ../../view/admin/anadirColeccion.php');
	}
	else{ // Si la tabla tiene datos

		$id++; // Aumenta el número de id
		$sql="INSERT INTO colecciones (id,cod, nombreColeccion, ano, temporada, genero) 
				VALUES ($id,'$cod', '$nombreColeccion', '$ano', '$temporada', '$genero');";
		$insert=$db->insert($sql);					
		// Mensaje de error a mostrar
		$msg->add('s', '¡FABULOSO! Colección añadido');
		// Redirecciona a la página de añadir colecciones
		header('Location: ../../view/admin/anadirColeccion.php');

	} // Cierre del else si la tabla tiene datos
} // Cierre del else porque los campos no están vacíos

?>