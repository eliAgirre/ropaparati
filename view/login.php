<!-- Top HTML -->                    
<?php include("../include/topHtmlUser.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="es">
	<!-- Cabecera de toda la página -->
	<head>
        <title> Login </title>
        <?php include("../include/elementsHead.html"); ?> <!-- Elementos de head -->
        <link rel="stylesheet" type="text/css" href="../css/responsiveMain.css"> <!-- Responsive css -->
        <link rel="stylesheet" type="text/css" href="../css/mensajes.css"> <!-- Mensajes flash -->
        <style type="text/css">
            .messages{ width: 80%; border-radius: 5px; }
            #contenido{ padding-top: 30px; padding-bottom: 40px; }
        </style>
	</head> <!-- Cierre del encabezado de la página -->
	
	<!-- Cuerpo de toda la página -->
	<body>
		<!-- Engloba todas las etiquetas -->
		<div id="container">
            <!-- Encabezado de toda la página -->                    
            <?php include("../include/header.html"); ?>
            <!-- Menú de toda la página -->                    
            <?php include("../include/menuInicio.html"); ?>

            <!-- Representa el apartado de contenido -->
            <section id="contenido"> 
            	<!-- Mostrar el mensaje flash -->
                <?php echo "<div id='message'>"; echo $msg->display(); echo "</div>"; ?>

                <center><table border="2" bordercolor="white">                    
                    <tr><!-- Fila 1 -->
                        <td>
                            <a href="colecciones.php">
                                <img src="../image/coleccionesA.jpg" id="coleccionesA" height="207" width="226" alt="Colecciones">
                            </a>
                        </td>
                        <td>
                            <a href="campanas.php">
                                <img src="../image/campanas.jpg" id="campanas" width="226" height="207" alt="Campañas">
                            </a>
                        </td><!--
                        <td rowspan="2">
                            <a href="rsc.php">
                                <img src="../image/rsc.jpg" id="rsc" width="250" height="416" alt="RSC">
                            </a>
                        </td> -->       
                    </tr>                    
                    <tr><!-- Fila 2 -->
                        <td>
                            <a href="colecciones.php">
                                <img src="../image/coleccionesB.jpg" id="coleccionesB" height="207" width="226" alt="Colecciones">
                            </a>
                            </td>
                        <td>
                            <a href="blog.php">
                                <img src="../image/blog.jpg" id="blog" align="center" width="226" height="207" alt="Blog">
                            </a>
                        </td>
                        
                    </tr>
                </table></center>                
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