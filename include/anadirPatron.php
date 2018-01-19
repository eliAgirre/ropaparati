<?php
	// Inicia sesión o reanudar la sesión	
	session_start();
	// Se guarda el user
	$nombreUsuario = $_SESSION["user"];
	// Si la variable no tiene valor se obtiene desde la variable GET
	if(!isset($nombreUsuario)){
	    $nombreUsuario=$_GET('usuario');
	}
	// Se importa la conexión con la base de datos
    require_once '../config/database.php';
    $db = new Database();
    $db->connect();
    // Sentencia SELECT
    $sql="SELECT * FROM patrones WHERE usuario='".$nombreUsuario."' ORDER BY id DESC LIMIT 2;";
    $select=$db->select($sql);
    $sql2="SELECT * FROM patrones WHERE _idUsuario='".$_SESSION["id_user"]."';";
    $select2=$db->select($sql2);
    $nPatrones=count($select2);
    // Se recore el array de la consulta
    foreach ($select as $key => $valor) {
        foreach ($valor as $campo => $value) {

            if($campo==="patron"){ // Muestra la foto
                echo "<a href='../view/listaPatrones.php?usuario=".$nombreUsuario."'><img src='".$value."' alt='patron'/></a><br /><br />";
            }
        }
    }
    if($nPatrones>2){
        echo "<p id='masPatrones'><a href='../view/listaPatrones.php?usuario=".$nombreUsuario."'>Ver mis patrones</a><p>";
    }
?>