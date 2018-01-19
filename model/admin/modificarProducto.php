<?php
// Se importa la conexión con la base de datos
require_once '../../config/database.php';
$db = new Database();
$db->connect();
// Se obtienen los datos desde el formulario de la ventana modal
$codigo=$_POST["codigo"];
/*$nombreProducto=$_POST["nombreProduct"];
$descripcion=$_POST["descripcion"];
$coleccion=$_POST["nameColec"];
$precio=$_POST["precio"];*/
// Image 
$image= addslashes($_FILES['subirProducto']['tmp_name']);
$name= addslashes($_FILES['subirProducto']['name']);
$image= file_get_contents($image);
$image= base64_encode($image);
//echo $codigo." ".$nombreProducto." ".$descripcion." ".$coleccion." ".$precio." ".$imagen;
// Sentencia UPDATE
$sql="UPDATE catalogo SET name_img=?,fotoProducto=? WHERE codigoBarras='".$codigo."';";
$update=$db->updateImg($sql,$name, $image);
// Redirecciona a la pagina anterior 
header("location:".$_SERVER['HTTP_REFERER']);
?>