<!-- Top HTML admin -->                    
<?php include_once("../../include/topHtmlAdmin.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="es">
	<!-- Cabecera de toda la página -->
	<head>
        <title> Añadir colección </title>
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
                <h2> Añadir colección </h2>
                <div id="formColeccion"><!-- Añadir colección -->
                    <form method="post" role="form" action="../../../model/admin/anadirColeccion.php">
                        <!--Input Nombre colección -->
                        <div class="form-group">
                            <label for="colec">Nombre colección</label>
                            <div class="input-group">
                                <input ttype="text" class="form-control" name="nombreColeccion" placeholder="Nombre colección" required>
                            </div>
                        </div><br/>
                        <!--select año -->
                        <div class="form-group">
                            <label for="colec">Año</label>
                            <div class="input-group selection">
                            <?php 
                                $yearRange = 10; // Number of years to go ahead                                                         
                                // Generate Options
                                $thisYear = date('Y'); // this year
                                $startYear = ($thisYear + $yearRange);?>
                                <select name="ano" required> <option value="" selected="selected">Año</option>
                                <?php foreach (range($thisYear, $startYear) as $year) {
                                    echo "<option value=".$year." selected='selected;'>".$year."</option>";
                                } 
                            ?></select>
                            </div>
                        </div><br/>
                        <!--select temporada -->
                        <div class="form-group">
                            <label for="colec">Temporada</label>
                            <div class="input-group selection">
                                <select name="temporada" required>
                                    <option value="" selected="selected">Temporada</option>
                                    <option VALUE="pv"> Primavera-Verano </option>
                                    <option VALUE="oi"> Otoño-Invierno</option>
                                </select>
                            </div>
                        </div><br/>
                        <!--Radio genero -->
                        <div class="form-group">
                            <label for="colec">Género</label>
                            <div class="input-group">
                                <input type="radio" name="sex" value="H" checked> Hombre<br>                                  
                                <input type="radio" name="sex" value="M"> Mujer
                            </div>
                        </div><br/>
                        <button id="anadir" name="registro" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Añadir</button>
                        <br/>
                    </form>
                </div><!-- Cierre del formulario añadir colección -->
                              
            </section> 
            <!--Ventana Modal del Inicio de sesión-->
            <?php include("../../include/iniciarSesion.html"); ?>
            <!--Ventana Modal del Dar de alta-->
            <?php include("../../include/darAlta.html"); ?>            
         </div> <!-- Cierre div del container -->
	</body>	
</html>