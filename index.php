<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="es">
	<!-- Cabecera de toda la página -->
	<head>
        <title> ropa para ti </title>
        <?php include("include/elementsHeadIndex.html"); ?> <!-- Elementos de head Index -->
        <link rel="stylesheet" type="text/css" href="css/responsiveMain.css"> <!-- Responsive css -->
        <script type="text/javascript" src="../js/setMenu.js"></script> <!--  jQuery set Menu-->
        <style type="text/css">
            #contenido{ padding-top: 30px; padding-bottom: 40px; }
            #home{ font-weight: bold; }
        </style>
	</head> <!-- Cierre del encabezado de la página -->
	<!-- Cuerpo de toda la página -->
	<body>
		<!-- Engloba todas las etiquetas -->
		<div id="container">
            <!-- Encabezado de toda la página -->                    
            <?php include("include/headerIndex.html"); ?>
            <!-- Menú de toda la página -->                    
            <?php include("include/menuInicio.html"); ?>

            <!-- Representa el apartado de contenido -->
            <section id="contenido"> 
                <center><table border="2" bordercolor="white">
                    <tr><!-- Fila 1 -->
                        <td>
                            <a href="view/colecciones.php"><img src="../image/web/coleccionesA.jpg" id="coleccionesA" alt="Colecciones"></a>
                        </td>
                        <td>
                            <a href="view/campanas.php"><img src="../image/web/campanas.jpg" id="campanas" alt="Campañas"></a>
                        </td> 
                        <!--<td rowspan="2">
                            <a href="rsc.php"><img id="rsc" alt="RSC"></a>
                        </td> -->      
                    </tr>
                    <tr><!-- Fila 2 -->
                        <td>
                            <a href="view/colecciones.php"><img src="../image/web/coleccionesB.jpg" id="coleccionesB" alt="Colecciones"></a>
                            </td>
                        <td>
                            <a href="view/blog.php"><img src="../image/web/blog.jpg" id="blog" align="center" alt="Blog"></a>
                        </td>                        
                    </tr>
                </table></center>
                
            </section> <!--Cierre de la contenido -->

            <!-- Representa el pie de toda la página -->
            <?php include("include/footerIndex.html"); ?>
            <!--Ventana Modal del Inicio de sesión-->
            <?php include("include/iniciarSesion.html"); ?>
            <!--Ventana Modal del Dar de alta-->
            <?php include("include/darAlta.html"); ?>
         </div> <!-- Cierre div del container -->
        <!-- Para las ventanas modales -->
        <script type="text/javascript" src="https://code.jquery.com/jquery.js"></script> <!-- jQuery -->
        <script type="text/javascript" src="css/dist/js/bootstrap.min.js"></script>
	</body>	
</html>