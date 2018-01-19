<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="es">
	<!-- Cabecera de toda la página -->
	<head>
        <title> RSC </title>
        <?php include("../include/elementsHead.html"); ?> <!-- Elementos de head -->
        <style type="text/css">
            #linkRsc{ font-weight: bold; }
            #home{ font-weight: normal; }
        </style>
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
            <section id="contenido" style="margin-left:440px;"> 

                <iframe width="500" height="315" src="http://www.youtube.com/embed/m-1tKEsPnXw" frameborder="0" allowfullscreen></iframe>
                
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