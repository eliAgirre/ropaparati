<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="es">
	<!-- Cabecera de toda la página -->
	<head>
        <title> Atención al cliente </title>
        <?php include("../include/elementsHead.html"); ?> <!-- Elementos de head -->
        <link rel="stylesheet" href="../css/contacto.css" /> <!-- Diseño externo -->
	</head> <!-- Cierre del encabezado de la página -->
	
	<!-- Cuerpo de toda la página -->
	<body>
		<!-- Engloba todas las etiquetas -->
		<div id="container">
            <!-- Encabezado de toda la página -->                    
            <?php include("../include/header.html"); ?>
            <!-- Menú de toda la página -->                    
            <?php include("../include/menu.html"); ?>
            <h3>Contacto</h3>
            <!-- Representa el apartado de contenido -->
            <section id="contenido"> 
                <!--style="position:relative;left:350px;"-->
                <div id="formulario">
                    <form method="post" role="form" action="../model/contacto.php">
                        <!--Input titulo -->
                        <div class="form-group">
                            <label for="usr" style="text-align: left;">Asunto</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Asunto" name="asunto" style="border-radius: 5px;" required>
                            </div>
                        </div>
                        <!--Input nombre -->
                        <div class="form-group">
                            <label for="usr">Nombre</label>
                            <div class="input-group">
                                <input class="form-control" placeholder="Nombre" name="nombre" style="border-radius: 5px;" required>
                            </div>
                        </div>
                        <!--Input apellido -->
                        <div class="form-group">
                            <label for="usr">Apellido</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="usr" placeholder="Apellido" name="apellido" style="border-radius: 5px;" required>
                            </div>
                        </div>
                        <!--Input email-->
                        <div class="form-group">
                            <label for="usr">Email</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="usr" placeholder="Email" name="email" style="border-radius: 5px;" required>
                            </div>
                        </div>
                        <!--Input mensaje-->
                        <div class="form-group">
                            <label for="usr">Mensaje</label>
                            <div class="input-group">
                                <textarea type="text" class="form-control" rows="3" id="usr" placeholder="Escriba el mensaje, por favor" name="mensaje" style="border-radius: 5px;" required></textarea>
                            </div>
                        </div>
                        <br/>
                        <button id="enviarContact" name="enviar" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> Envíar </button>
                        <br/>
                    </form>
                </div>
                <div id="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2902.6554438902617!2d-1.9824573845129976!3d43.321471779134086!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd51a5502fd0b501%3A0x738093e3b8570da9!2sCamino+Kalea%2C+2%2C+20004+Donostia%2C+Gipuzkoa!5e0!3m2!1sen!2ses!4v1450638360359" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
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