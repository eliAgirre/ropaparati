<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="es">
	<!-- Cabecera de toda la página -->
	<head>
        <title> Política de privacidad </title>
        <?php include("../include/elementsHead.html"); ?> <!-- Elementos de head -->
        <link rel="stylesheet" href="../css/politicaPrivacidad.css" /> <!-- Diseño externo -->
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
                <div id="column1"></div>

                <div id="column2">
                    <h2>Política de privacidad</h2>

                    <p>Bienvenido a nuestro sitio web. Rogamos que leas atentamente nuestra política de privacidad. 
                        Esta política de privacidad se aplica tanto en el caso de que decidas simplemente navegar por el sitio sin 
                        comprar producto alguno como en el caso de que te registres y decidas utilizar sus servicios y comprar los productos. </p>
                        
                    <p> Utilizando el sitio aceptas los términios descritos en la política de privacidad. Si no deseas aceptar 
                        los términios descritos en la Política de Privacidad, te invitamos a no hacer uso de la página.
                        Dado que los datos personales de los usuarios los guardaremos. </p>

                    <p> Tus datos personales son recopilados y tratados para proporcionarte los servicios a los que te hayas suscrito o reservados
                        a los usuarios registrados, para facilitarte la navegación y las compras desde este sitio web.</p>
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