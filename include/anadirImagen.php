<?php
    // Inicia sesión o reanudar la sesión	
    session_start();
    // Se guarda el user
    $nombreUsuario = $_SESSION["user"];
    // Si la variable no tiene valor se obtiene desde la variable GET
    if(!isset($nombreUsuario)){
        $nombreUsuario=$_GET('nombreUsuario');
    }
    // Se importa la conexión con la base de datos
    require_once '../config/database.php';
    $db = new Database();
    $db->connect();
    // Sentencia SELECT
    $sql="SELECT fotoUsu FROM usuarios WHERE usuario='".$nombreUsuario."';";
    $select=$db->select($sql);
    // Se recore el array de la consulta
    foreach ($select as $key => $valor) {
        foreach ($valor as $campo => $value) {

            if($campo==="fotoUsu"){ // Muestra la foto
                echo "<img id='fotoUsuario' src='".$value."' alt='Avatar'/><br /><br />";
            }
        }
    }
?>