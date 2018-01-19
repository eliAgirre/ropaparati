<?php
$codigoBarra=$_POST['codBarra'];
// Se importa la conexión con la base de datos
require_once '../../config/database.php';
$db = new Database();
$db->connect();
// Sentencia SELECT
$sql="SELECT * from catalogo WHERE codigoBarras='$codigoBarra'";
$select=$db->select($sql);
echo json_encode($select);
?>