<?php
// Se requiere las sesiones para los mensajes flash
if( !session_id() ) session_start();
if(!(isset($_GET['ropa']) && $_GET['ropa']!='')){
    header('Location: ../index.php');
}
// Requiere la clase de mensajes y se instancia el objeto de tipo Messages
require_once('../controller/class.messages.php');
$msg = new Messages();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="es">
	<!-- Cabecera de toda la página -->
	<head>
        <title><?php echo $_GET['ropa']; ?> </title>
        <?php include("../include/elementsHead.html"); ?> <!-- Elementos de head -->
        <link rel="stylesheet" href="../css/ropa.css" /> <!-- Diseño externo -->
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

                <div id="sidebar">

                    <h3><?php echo $_GET['ropa']; ?></h3>

                </div>
                
                <div id="centro">

                    <?php
                        // Se importa la conexión con la base de datos
                        require_once '../config/database.php'; 
                        $db = new Database();
                        $db->connect();
                        // Sentencia SELECT
                        $sql="SELECT * FROM catalogo WHERE producto='".$_GET['ropa']."';";
                        $select=$db->select($sql);
                        // Se recore el array de la consulta
                        foreach ($select as $key => $valor) {
                            foreach ($valor as $campo => $value) {
                                if($campo==="descripcion"){ 
                                    $descripcion=$value;                              
                                }
                                if($campo==="precio"){ 
                                    $precio=$value;                               
                                }
                                if($campo==="fotoProducto"){

                                    echo "<img width='150' height='250' src='data:image;base64,".$value."'/><br>";
                                    echo "<p id='descrip'>".$descripcion."</p>";  
                                    echo "<p>".$precio."</p>";  
                                }  
                            }
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