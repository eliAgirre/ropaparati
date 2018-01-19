<?php
// Se guarda la variable GET id
$id=$_GET['id'];
// Se importa la conexión con la base de datos
require_once '../config/database.php';
$db = new Database();
$db->connect();
// Sentencia SELECT
$sql="DELETE from patrones WHERE id='$id'";
$delete=$db->delete($sql);
?>