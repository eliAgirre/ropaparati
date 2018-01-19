<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="es">
	<!-- Cabecera de toda la página -->
	<head>
        <title> Colecciones </title>
        <?php include("../include/elementsHead.html"); ?> <!-- Elementos de head -->
        <link rel="stylesheet" href="../css/colecciones.css" /> <!-- Diseño externo -->
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
                <h3>Colecciones</h3>
                <!-- Barra lateral -->
                <div id="leftBar">
                    <h2>COLECCIONES</h2>                    
                    <a href="mujer.php">MUJER</a>
                    <a href="hombre.php">HOMBRE</a>
                    <a href="#">ACCESORIOS</a>
                    <a href="#">OTROS</a>                    
                </div>
                <!-- Centro -->
                <div id="centro">
                    <div id="mujer">
                        <div class="text">Mujer</div>
                        <a href="mujer.php"><img id="imgMujer" src="../image/vestido_largo.jpg" alt="Colecciones"></a>
                    </div>
                    <div id="hombre">
                        <div class="text">Hombre</div>
                        <a href="hombre.php"><img id="imgHombre" src="../image/chaleco_hombre.jpg" alt="Colecciones"></a>                       
                    </div>
                </div>
                
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