<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="es">
	<!-- Cabecera de toda la página -->
	<head>
        <title> Hombre </title>
        <?php include("../include/elementsHead.html"); ?> <!-- Elementos de head -->
        <link rel="stylesheet" href="../css/colecciones.css" /> <!-- Diseño externo -->
        <style type="text/css"> #centro{ height: 200px; } </style>
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
                <?php include("../include/leftBar_hombre.html"); ?> 

                <!-- Centro -->
                <div id="centro">


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