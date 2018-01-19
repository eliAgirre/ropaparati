<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="es">
	<!-- Cabecera de toda la página -->
	<head>
        <title> Campañas </title>
        <?php include("../include/elementsHead.html"); ?> <!-- Elementos de head -->
        <link rel="stylesheet" href="../css/campanas.css" /> <!-- Diseño externo -->
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
                <div id="leftBar">
                 <!--   <h2>CAMPAÑAS</h2>                    
                    <a href="#">2013</a>-->                  
                </div>
                <!-- Centro -->
                <div id="centro">
                    <p>Primavera/Verano 2013</p>
                    <a href="slider.php"><img id="a1" src="../image/campana2013_1a.jpg" alt="Campaña 2013"/></a>
                    <a href="slider.php"><img id="a2" src="../image/campana2013_2a.jpg" alt="Campaña 2013"/></a><br><br>
                    <a href="slider.php"><img id="img03" src="../image/img_03.jpg" alt="Campaña 2013"/></a>
                    <a href="slider.php"><img id="img04" src="../image/img_04.jpg" alt="Campaña 2013"/></a>
                    <a href="slider.php"><img id="img05" src="../image/img_05.jpg" alt="Campaña 2013"/></a>
                    <a href="slider.php"><img id="img06" src="../image/img_06.jpg" alt="Campaña 2013"/></a>
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