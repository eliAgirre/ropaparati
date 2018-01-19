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
// Se obtienen los datos mediante ajax
$codigoBarras=$_POST['codigoBarras'];
$idUser=$_POST['idUser'];
// Sentencia SELECT
$sql="SELECT * FROM wishlist";
$select=$db->select($sql);
$id;
$existe;
// Se recore el array de la consulta
foreach ($select as $key => $valor) {
    foreach ($valor as $campo => $value) {

        if($campo==="idWish"){
        	$id=$value;
        }
    }
}
// Sentencia SELECT
$sql2="SELECT * FROM usuarios WHERE _id='".$idUser."';";
$select2=$db->select($sql2);
$usuario;
// Se recore el array de la consulta
foreach ($select2 as $key => $valor) {
    foreach ($valor as $campo => $value) {

        if($campo==="usuario"){
        	$usuario=$value;
        }
    }
}
// Si no hay resultados en la tabla de wishlist, inserta directamente el wishlist
if(!$select){
	$id=0; // Se establece el valor 0
	$id++;
	// Se inserta el usuario en la bd
	$sql="INSERT INTO wishlist (idWish, codigoBarrasProduct, idUser, user) 
		VALUES ($id,'$codigoBarras', '$idUser', '$usuario');";
	$insert=$db->insert($sql);
	$existe=false;
}
else{ // Si la tabla ya contiene datos

	$datos=array();
	$idWish;
	// Sentencia SELECT
	$sql2="SELECT * FROM wishlist WHERE codigoBarrasProduct='".$codigoBarras."' AND idUser='".$idUser."';";
	$select2=$db->select($sql2);
	if(!$select2){
		// Si no existe esa fila, se añade a me gusta
		$id++;
		// Se inserta el usuario en la bd
		$sql="INSERT INTO wishlist (idWish, codigoBarrasProduct, idUser, user) 
			VALUES ($id,'$codigoBarras', '$idUser', '$usuario');";
		$insert=$db->insert($sql);
		$existe=false;
	}
	else{
		// Ya existe, y no se guarda en la bd
		$existe=true;
	}

} // Cierre else
// Devuelve el objeto JSON
echo json_encode(array('exito'=>$existe));
?>