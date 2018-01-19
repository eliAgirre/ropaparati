<?php
// Se requiere las sesiones para los mensajes flash
if( !session_id() ) session_start();
// Requiere la clase de mensajes y se instancia el objeto de tipo Messages
require_once('../controller/class.messages.php');
$msg = new Messages();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="es">
	<!-- Cabecera de toda la página -->
	<head>
        <title> Mujer </title>
        <?php include("../include/elementsHead.html"); ?> <!-- Elementos de head -->
        <link rel="stylesheet" href="../css/mujer.css" /> <!-- Diseño externo -->
        <script type="text/javascript" src="../js/wishList.js"></script><!-- JS Me gusta-->
        <script type="text/javascript" src="../js/appendUser.js"></script><!-- JS Lista user-->
	</head> <!-- Cierre del encabezado de la página -->
	
	<!-- Cuerpo de toda la página -->
	<body>
		<!-- Engloba todas las etiquetas -->
		<div id="container">
            <!-- Encabezado de toda la página -->                    
            <?php include("../include/header.html"); ?>
            <!-- Menú de toda la página -->                    
            <?php include("../include/menu.html"); ?>

            <!-- Representa el apartado de contenido -->
            <section id="contenido"> 

                <!-- Barra lateral -->
                <?php include("../include/leftBar_mujer.html"); ?> 
                <!-- Mostrar el mensaje flash -->
                <div id="message"> <?php echo $msg->display(); ?> </div>
                <!-- Centro -->
                <div id="centroM">
                    <?php
                        // Se importa la conexión con la base de datos
                        require_once '../config/database.php'; 
                        $db = new Database();
                        $db->connect();
                        // Sentencia SELECT
                        $sql="SELECT * FROM catalogo WHERE coleccion='Fendi-Pre-Fall' AND categoria='Tops'";
                        $select=$db->select($sql);
                        $codigoBarras=array();
                        $enlace=array();
                        $productos=array();
                        $usersWish=array();
                        $countWish=array();
                        foreach ($select as $key => $valor) {
                            foreach ($valor as $campo => $value) {
                                if($campo==="codigoBarras"){
                                    array_push($codigoBarras, $value); // Se añade el valor del codigo
                                    $sqlWish="SELECT COUNT(*) FROM wishlist WHERE codigoBarrasProduct='".$value."'";
                                    $selectWish=$db->select($sqlWish);
                                    array_push($countWish, $selectWish); // Se guarda toda la consulta en otro array  
                                    $sqlUsers="SELECT * FROM wishlist WHERE codigoBarrasProduct='".$value."' GROUP BY idUser ORDER BY COUNT(codigoBarrasProduct);";
                                    $selectUsers=$db->select($sqlUsers);
                                    array_push($usersWish, $selectUsers);
                                }
                            }
                        }
                        // Se recorre el array de los numeros de lista de deseo de cada producto
                        foreach ($countWish as $key => $valor) {
                            foreach ($valor as $campo2 => $value2) {
                                foreach ($value2 as $campo3 => $dato3) {
                                    $productos[$key]["wish"]=$dato3;
                                }
                            }
                        }              
                        foreach ($usersWish as $key => $valor) {
                            foreach ($valor as $campo2 => $value2) {
                                foreach ($value2 as $campo3 => $dato3) {
                                    if($campo3==="user"){
                                        $productos[$key][$campo2]["user"]=$dato3; // Se añaden los usuarios
                                    }
                                }
                            }
                        }
                        // Join del array codigoBarras
                        $ids = join(',',$codigoBarras);  
                        // Sentencia SELECT with array
                        $sql = "SELECT * FROM ps_product WHERE reference IN ($ids) ORDER BY id_miCatalogo asc";
                        $select2=$db->select($sql);
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
                                if($campo==="codigoBarras"){
                                    $codigoBarras=$value;
                                    $productos[$key]["codigoBarras"]=$codigoBarras;
                                }
                                if($campo==="producto"){
                                    $nombre=$value;
                                    $productos[$key]["producto"]=$nombre;
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
                                if($campo==="wish"){
                                    $nWish=$valor;
                                }
                                if (is_array($valor)) {
                                    foreach ($valor as $columna => $dato) {
                                        if($columna==="user"){ ?>
                                            <div id="<?php echo htmlspecialchars($key); ?>" 
                                            class="dataUser" value="<?php echo htmlspecialchars($dato); ?>">
                                            </div><?php
                                        }
                                    }
                                }
                                if($campo==="codigoBarras"){
                                    $codigoBarras=$valor;
                                }
                                if($campo==="producto"){
                                    $nombre=$valor;
                                }
                                if($campo==="precio"){
                                    $precio=$valor;
                                }
                                if($campo==="fotoProducto"){ // Muestra la foto
                                    echo "<div class='descrip'>";
                                        echo "<a class='shop' href='http://shop-proyectoapp.rhcloud.com/es/".$link."' target='_blank'>
                                        <span class='tienda'><b>Ir a la tienda</b></span>
                                        <img width='150' height='250' src='data:image;base64,".$valor."' /></a>";
                                        //echo "<a href='ropa.php?ropa=$nombre'>
                                        //<img width='150' height='250' src='data:image;base64,".$valor."' /></a>";
                                        echo "<h5>$nombre</h5>";
                                        echo "<h6>$precio € </h6>";
                                        if($_SESSION['id_user']!=''):?>
                                            <button class="btnMeGusta" name="<?php echo htmlspecialchars($codigoBarras); ?>"
                                            value="<?php echo htmlspecialchars($_SESSION['id_user']); ?>">
                                            <span class="glyphicon glyphicon-heart"></span> Me gusta 
                                            </button><a id="<?php echo htmlspecialchars($key); ?>" class="numWish"><?php echo " ".$nWish." "; ?>
                                            <div class="divCount"></div></a><?php
                                        endif;
                                    echo "</div>";                                
                                }
                                if($campo==="enlace"){
                                    $link=$valor;
                                }
                            }
                            echo "</div>";
                        }
                    ?>
                </div>
                <!-- Si el usuario no está logueado no tiene la cesta -->

                <?php

                    if(!(isset($_SESSION['id_user']) && $_SESSION['id_user']!='')){

                ?>
                <!-- El usuario logueado tiene cesta -->
                <?php
                    }
                    else{ 
                        include("../include/rightBar.html");  // Barra lateral dcha
                    }
                ?>             

            </section> <!--Cierre de la contenido -->

            <!-- Representa el pie de toda la página -->
            <?php include("../include/footer.html"); ?>
            <!--Ventana Modal del Inicio de sesión-->
            <?php include("../include/iniciarSesion.html"); ?>
            <!--Ventana Modal del Dar de alta-->
            <?php include("../include/darAlta.html"); ?>             
         </div> <!-- Cierre div del container -->
	</body>	
</html>