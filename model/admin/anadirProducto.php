<?php
// Se requiere las sesiones para los mensajes flash
if( !session_id() ) session_start();
// Requiere la clase de mensajes y se instancia el objeto de tipo Messages
require_once('../../controller/class.messages.php');
$msg = new Messages();
// Data from form POST 
$nombreProducto=$_POST['nombreProducto'];
$descripcion=$_POST['descripcion'];
$nameColec=$_POST['nameColec'];
$categoria=$_POST['categoria'];
$precio=$_POST['precio'];
// Obtiene el nombre de la imagen
$name="default.png";
// Lee la imagen y convierte a base64
$imageData= file_get_contents("../../image/products/default.png");
$imagen= base64_encode($imageData);
// Importar funciones de usuarios
include_once("../../function/productos.php");
// Se importa la conexión con la base de datos
require_once '../../config/database.php';
$db = new Database();
$db->connect();
// Sentencia SELECT
$sql="SELECT * FROM catalogo;";
$select=$db->select($sql);
// Se recore el array de la consulta
foreach ($select as $key => $valor) {
    foreach ($valor as $campo => $value) {

    	if($campo==="id"){
        	$id=$value; // Se guarda la id de la última
        }
        if($campo==="id_img"){
        	$id_img=$value; // Se guarda la id_img de la última
        }
	}
}
// Si los campos del formulario están vacíos
if($_POST['nombreProducto']==NULL or $_POST['descripcion']==NULL or $_POST['nameColec']==NULL or $_POST['precio']==NULL or $_POST['categoria']==NULL){

	// Mensaje de error a mostrar
	$msg->add('e', 'ERROR: Los campos estan vacios');
	// Redirecciona a la página de añadir producto
	header('Location: ../../view/admin/anadirProducto.php');
	// Imprime un mensaje y termina el script actual
	exit();
}
else{ // Si los campos no están vacíos

	// Si no hay resultados en la tabla de catalogo, inserta directamente el producto
	if(!$select){

		$id=0;
		$id++; // Aumenta el número de id
		$precio=floatval($precio); // El precio se convierte en decimal
		$nSystem="84";
		$codEmpresa="01055";
		$codProducto = sprintf("%05d", $id); // Se añaden zeros por delante de la id, siempre teniendo 5 dígitos
		$digitos=$nSystem."".$codEmpresa."".$codProducto; // Se concatenan para formar los dígitos
		$checkDigit=ean13_DigitoControl($digitos); // Se obtiene el dígito del control
		$codigoBarras=$nSystem."".$codEmpresa."".$codProducto."".$checkDigit; // Se concatenan para formar el código de barras
		$sql="INSERT INTO catalogo (id,codigoBarras, producto, descripcion, precio, coleccion, name_img, fotoProducto, categoria) 
				VALUES ($id,'$codigoBarras', '$nombreProducto', '$descripcion', $precio, '$nameColec', '$name', '$imagen', '$categoria');";
		$insert=$db->insert($sql);
		// Mensaje de error a mostrar
		$msg->add('s', '¡FABULOSO! Producto añadido');
		// Redirecciona a la página de añadir producto
		header('Location: ../../view/admin/anadirProducto.php');
	}
	else{ // Si la tabla tiene datos

		$id++; // Aumenta el número de id
		$id_img++;
		$precio=floatval($precio); // El precio se convierte en decimal
		$nSystem="84";
		$codEmpresa="01055";
		$codProducto = sprintf("%05d", $id); // Se añaden zeros por delante de la id, siempre teniendo 5 dígitos
		$digitos=$nSystem."".$codEmpresa."".$codProducto; // Se concatenan para formar los dígitos
		$checkDigit=ean13_DigitoControl($digitos); // Se obtiene el dígito del control
		$codigoBarras=$nSystem."".$codEmpresa."".$codProducto."".$checkDigit; // Se concatenan para formar el código de barras
		$sql="INSERT INTO catalogo (id,codigoBarras, producto, descripcion, precio, coleccion, name_img, fotoProducto, categoria) 
				VALUES ($id,'$codigoBarras', '$nombreProducto', '$descripcion', $precio, '$nameColec', '$name', '$imagen', '$categoria');";
		$insert=$db->insert($sql);					
		// Mensaje de error a mostrar
		$msg->add('s', '¡FABULOSO! Producto añadido');
		// Redirecciona a la página de añadir producto
		header('Location: ../../view/admin/anadirProducto.php');

	} // Cierre del else si la tabla tiene datos
} // Cierre del else porque los campos no están vacíos

?>