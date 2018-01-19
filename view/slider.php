<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="es">
	<!-- Cabecera de toda la página -->
	<head>
        <title>Campañas</title>
        <?php include("../include/elementsHead.html"); ?> <!-- Elementos de head -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
		<script src="../galleria/galleria-1.2.9.min.js"></script>
		<link rel="stylesheet" href="../css/slider.css" /> <!-- Diseño externo -->
	</head> <!-- Cierre del encabezado de la página -->
	<!-- Cuerpo de toda la página -->
	<body>
		<!-- Engloba todas las etiquetas -->
		<div id="container">
            <!-- Encabezado de toda la página -->                    
            <?php include("../include/header.html"); ?>
            <!-- Menú de toda la página -->                    
            <?php include("../include/menu.html"); ?>

            <!-- Representa el apartado de contenido del main-->
            <section id="contenido"> 
                <center>
	                <div id="galleria">
						<img src="../image/campana2013_1a.jpg" alt="Campaña 2013" /> 
						<img src="../image/campana2013_2a.jpg" alt="Campaña 2013" /> 
						<img src="../image/img_03.jpg" alt="Campaña 2013" /> 
						<img src="../image/img_04.jpg" alt="Campaña 2013" />
						<img src="../image/img_05.jpg" alt="Campaña 2013" />
						<img src="../image/img_06.jpg" alt="Campaña 2013" />
					</div>
					<div id="atras">
						<a href="campanas.php" ><img src="../image/atras.png" alt="atras" /></a>
					</div>
				</center>              
            </section> <!--Cierre de la contenido -->

            <!-- Representa el pie de toda la página -->
            <?php include("../include/footer.html"); ?>
            <!--Ventana Modal del Inicio de sesión-->
            <?php include("../include/iniciarSesion.html"); ?>
            <!--Ventana Modal del Dar de alta-->
            <?php include("../include/darAlta.html"); ?>
            <!-- Slider -->
            <script> 
			    Galleria.loadTheme('../galleria/themes/classic/galleria.classic.min.js');
			    Galleria.run('#galleria');
			</script>             
         </div> <!-- Cierre div del container -->
	</body>	
</html>