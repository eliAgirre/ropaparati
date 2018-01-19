<?php
// Se importa la conexión con la base de datos
require_once '../config/database.php';
$db = new Database();
$db->connect();
// Se obtienen los datos desde POST Ajax
$image = $_POST['imgSrc'];
$id_usuario = $_POST['id_usuario'];
$usuario = $_POST['nombreUsuario'];
// Lee la imagen y convierte a base64
$imageData = base64_encode(file_get_contents($image));
// Formato de SRC:  data:{mime};base64,{data};
//{mime}--> El formato de la imagen, ej.:image/jpeg
$src = 'data: '.mime_content_type($image).';base64,'.$imageData;
// Sentencia UPDATE
$sql="UPDATE usuarios SET fotoUsu=? WHERE _id='".$id_usuario."';";
$update=$db->update($sql,$src);
// Devuelve el objeto JSON
echo json_encode($update);
?>