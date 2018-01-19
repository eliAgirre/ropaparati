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
$amigo=$_POST['amigo'];
$username=$_POST['user'];
$idUser;
$idAmigo;
// Sentencia SELECT
$sqlUser = "SELECT * FROM usuarios WHERE usuario='".$username."'";
$selectUser=$db->select($sqlUser);
foreach ($selectUser as $key => $valor) {
    foreach ($valor as $campo => $value) {
    	if($campo==="_id")
    		$idUser=$value;
    }
}
// Sentencia SELECT
$sqlAmigo = "SELECT * FROM usuarios WHERE usuario='".$amigo."'";
$selectAmigo=$db->select($sqlAmigo);
foreach ($selectAmigo as $key => $valor) {
    foreach ($valor as $campo => $value) {
    	if($campo==="_id")
    		$idAmigo=$value;
    }
}
/*echo $idUser." ".$username."<br>";
echo $idAmigo." ".$amigo;*/
// Sentencia SELECT
$sql="SELECT * FROM amigos";
$select=$db->select($sql);
$id;
$existe;
// Se recore el array de la consulta
foreach ($select as $key => $valor) {
    foreach ($valor as $campo => $value) {

        if($campo==="id"){
        	$id=$value;
        }
    }
}
// Si no hay resultados en la tabla de wishlist, inserta directamente el wishlist
if(!$select){
	$id=0; // Se establece el valor 0
	$id++;
	// Se inserta el usuario en la bd
	$sql="INSERT INTO amigos (id, _idUser, username, _idAmigo, amigo) 
		VALUES ($id,'$idUser', '$username', '$idAmigo', '$amigo');";
	$insert=$db->insert($sql);
	$existe=false;
}
else{ // Si la tabla ya contiene datos	

	$datos=array();
	$idFila;
	// Sentencia SELECT
	$sql2="SELECT * FROM amigos WHERE username='".$username."' AND amigo='".$amigo."';";
	$select2=$db->select($sql2);
	if(!$select2){
		// Si no existe esa fila, se añade a me gusta
		$id++;
		// Se inserta el usuario en la bd
		$sql="INSERT INTO amigos (id, _idUser, username, _idAmigo, amigo) 
			VALUES ($id,'$idUser', '$username', '$idAmigo', '$amigo');";
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