<?php
// Se guarda la variable GET id
$id=$_GET['id'];
$user=$_GET['user'];
// Se importa la conexión con la base de datos
require_once '../config/database.php';
$db = new Database();
$db->connect();
// Sentencia SELECT
$sql="DELETE from wishlist WHERE codigoBarrasProduct='$id' AND user='$user'";
$delete=$db->delete($sql);
?>