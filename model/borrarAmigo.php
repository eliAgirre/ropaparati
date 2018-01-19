<?php
// Se guarda la variable GET id
$idAmigo=$_GET['id'];
$username=$_GET['user'];
// Se importa la conexión con la base de datos
require_once '../config/database.php';
$db = new Database();
$db->connect();
// Sentencia SELECT
$sql="DELETE from amigos WHERE username='$username' AND _idAmigo='$idAmigo'";
$delete=$db->delete($sql);
?>