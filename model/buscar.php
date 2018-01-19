<?php
// Se importa la conexión con la base de datos
require_once '../config/database.php';
$db = new Database();
$db->connect();
// Se requiere las sesiones para los mensajes flash
if( !session_id() ) session_start();
// Requiere la clase de mensajes y se instancia el objeto de tipo Messages
require_once('../controller/class.messages.php');
$msg = new Messages();
// Se importa los archivos css
echo "<link href=\"../css/mensajes.css\" rel=\"stylesheet\" type=\"text/css\" >";
// Se convierte a minúsculas
$ropaUsuario=strtolower($_POST['ropa']);
// Se eliminan los espacios del inicio y final
$ropaUsuario=trim($ropaUsuario);
$array=array(); // Array vacio
$nombre;
$minuscula;
// Sentencia SELECT
$sql="SELECT * FROM catalogo";
$select=$db->select($sql);
// Se recorre el array bidimensional de catalogo
foreach($select as $campos => $values){
	foreach($values as $campo => $datos){			
		if($campo=="producto"){
			// Se guarda el nombre de cada producto
			$nombre=$datos;
			// Se convierte a minúsculas
			$minuscula=strtolower($datos);
			// Encuentra la posición de la película del usuario en el nombre convertido a minúsculas
			$encontrado = strpos($minuscula, $ropaUsuario);
			// Si coincide
			if($encontrado !== FALSE){
				// Si son iguales
				if(strtolower($nombre)==$minuscula){
					// Se guarda el nombre en el array
					array_push($array,$nombre);
				}
			}	
		}
	}
} // Cierre del foreach de catalogo
// Si el array está vacío
if(count($array)==0){
	
	// Mensaje de error a mostrar
	$msg->add('e', 'ERROR: No existe');
	// Muestra el mensaje por pantalla
	echo $msg->display();
	// Imprime un mensaje y termina el script actual
	exit();
}
else{

	// Se recorre el array guardado los títulos que han coincidido
	foreach($array as $values){

		// Se realiza una SELECT por cada nombre coincidido
		$sql="SELECT * FROM catalogo WHERE producto='".$values."';";
		$select=$db->select($sql);
		$codigoBarras=array();
		$enlace=array();
		$productos=array();
		// Se recorre la consulta para obtener cada codigo de barras
		foreach ($select as $key => $valor) {
            foreach ($valor as $campo => $value) {
                if($campo==="codigoBarras"){
                    array_push($codigoBarras, $value); // Se añade cada codigoBarras al array
                }
            }
        }
		$ids = join(',',$codigoBarras);  
        // Sentencia SELECT with array
        $sql = "SELECT * FROM ps_product WHERE reference IN ($ids) ORDER BY id_miCatalogo asc";
        $select2=$db->select($sql);
        /*print_r($codigoBarras);
        print_r($select2);
        echo "<br />";*/
        // Array codigoBarras
        foreach ($select2 as $key2 => $valor2) {
            foreach ($valor2 as $campo2 => $value2) {
                if($campo2==="id_product"){
                    $ps_idProduct=$value2;
                }
                if($campo2==="link_rewrite"){
                    $ps_link=$value2;
                }
                if($campo2==="category"){
                    $category=$value2;
                }
            }
            array_push($enlace, $category."/".$ps_idProduct."-".$ps_link.".html");
        }
		foreach ($enlace as $key => $value) {
			$productos[$key]["enlace"]=$value; //Se añade el enlace al array de productos
		}
        // Se recore el array de la consulta
        foreach ($select as $key => $valor) {
            foreach ($valor as $campo => $value) {
                if($campo==="producto"){
                    $nombre=$value;
                    $productos[$key]["producto"]=$nombre;
                }
                if($campo==="descripcion"){
                    $descripcion=$value;
                    $productos[$key]["descripcion"]=$descripcion;
                }
                if($campo==="precio"){
                    $precio=$value;
                    $productos[$key]["precio"]=$precio;
                }
                if($campo==="fotoProducto"){
                    $fotoProducto=$value;
                    $productos[$key]["fotoProducto"]=$fotoProducto;
                }
            }
        }
        $link;
	    foreach ($productos as $key => $value) {
	         echo "<div class='producto'>";
	        foreach ($value as $campo => $valor) {
				if($campo==="producto"){
					$producto=$valor;					
				}
				if($campo==="descripcion"){
                    $descripcion=$valor;
                }
	            if($campo==="precio"){
	                $precio=$valor;
	            }
	            if($campo==="fotoProducto"){ // Muestra la foto

	                echo "<div class='primary'>";
	                echo "<a href='http://shop-proyectoapp.rhcloud.com/es/".$link."' target='_blank'> <img width='150' height='250' src='data:image;base64,".$valor."' /></a>";
					//echo "<a href='ropa.php?ropa=$producto'><img width='150' height='250' src='data:image;base64,".$dato."' /></a>";
					echo "</div>";                             
	            }
	            if($campo==="enlace"){
	                $link=$valor;
	            }
	        }
	        echo "<div class='secondary'>";
				echo "<h4><a href='http://shop-proyectoapp.rhcloud.com/es/".$link."' target='_blank'> " . $producto. "</a></h4>";
				echo "<p><u>Descripcion</u>: " .$descripcion." </p>";
				echo "<p><u>Precio</u>: " . $precio." € </p>";
			echo "</div>";
	    }

	} // Cierre del array
}
?>