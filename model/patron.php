<?php
// Se importa la conexión con la base de datos
require_once '../config/database.php';
$db = new Database();
$db->connect();
// Se obtienen los datos desde POST Ajax
$id_usuario = $_POST['id_usuario'];
$usuario = $_POST['usuario'];
$image = $_POST['imgSrc'];
$publico = $_POST['publico'];
// Lee la imagen y convierte a base64
$imageData = base64_encode(file_get_contents($image));
// Formato de SRC:  data:{mime};base64,{data};
//{mime}--> El formato de la imagen, ej.:image/jpeg
$src = 'data: '.mime_content_type($image).';base64,'.$imageData;
// Sentencia SELECT
$sql="SELECT * FROM patrones";
$select=$db->select($sql);
$id;
// Se recore el array de la consulta
foreach ($select as $key => $valor) {
    foreach ($valor as $campo => $value) {

        if($campo==="id"){
        	$id=$value;
        }
    }
}
if(!$select){
	$id=0;
}
else{
	$id++;
}
// Sentencia INSERT
$sql="INSERT INTO patrones (id,_idUsuario, usuario, patron, publico) 
	VALUES ($id,'$id_usuario', '$usuario', '$src', '$publico');";
$insert=$db->insert($sql);
// Devuelve el objeto JSON
echo json_encode($insert);
?>