<!-- Top HTML admin -->                    
<?php include_once("../../include/topHtmlAdmin.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="es">
	<!-- Cabecera de toda la página -->
	<head>
        <title> Añadir usuario </title>
        <?php include("../../include/elementsHeadAdmin.html"); ?>
	</head> <!-- Cierre del encabezado de la página -->
	
	<!-- Cuerpo de toda la página -->
	<body>
		<!-- Engloba todas las etiquetas -->
		<div id="container">
            <!-- Encabezado de toda la página -->                    
            <?php include("../../include/headerAdmin.html"); ?>
            <!-- Menú de toda la página -->                    
            <?php include("../../include/menuAdmin.html"); ?>

            <!-- Representa el apartado de contenido -->
            <section id="contenido"> 
                
                <?php echo $msg->display(); ?> <!-- Muestra el mensaje flash -->
                <h2> Añadir usuario </h2>
                <div id="formUser"><!-- Añadir usuario -->
                    <form method="post" role="form" action="../../../model/admin/anadirUser.php">
                        <!--Input email -->
                        <div class="form-group">
                            <label for="usr">Email</label>
                            <div class="input-group">
                                <input type="email" class="form-control" name="email" placeholder="Email" required>
                            </div>
                        </div><br/>
                        <!--Input nombre de usuario -->
                        <div class="form-group">
                            <label for="usr">Nombre de usuario</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="usr" name="username" maxlength="8" placeholder="Usuario" required>
                            </div>
                        </div><br/>
                        <!--Input contraseña -->
                        <div class="form-group">
                            <label for="usr">Contraseña</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="usr" name="password" min="8" maxlength="15" placeholder="Contraseña" required>
                            </div>
                        </div><br/>
                        <!--Input repetir contraseña -->
                        <div class="form-group">
                            <label for="usr">Repite la contraseña</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="usr" name="password2" min="8" maxlength="15" placeholder="Repite la contraseña" required>
                            </div>
                        </div><br/>
                        <button id="anadir" name="registro" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Añadir</button>
                        <br/>
                    </form>
                </div><!-- Cierre del formulario añadir usuario -->
                              
            </section> 
            <!--Ventana Modal del Inicio de sesión-->
            <?php include("../../include/iniciarSesion.html"); ?>
            <!--Ventana Modal del Dar de alta-->
            <?php include("../../include/darAlta.html"); ?>            
         </div> <!-- Cierre div del container -->
	</body>	
</html>