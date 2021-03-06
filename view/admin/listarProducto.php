<!-- Top HTML admin -->                    
<?php include_once("../../include/topHtmlAdmin.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="es">
	<!-- Cabecera de toda la página -->
	<head>
        <title> Listar producto </title>
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

                <!-- Tabla para listar los productos -->
                <div class="container" style="position:relative;top:25px;">
                    <div class="panel panel-primary" style="border-color:grey;">
                        <div class="panel-heading" style="background:#4D4D4D;border:none;">Lista de productos</div>
                        <table class="table table-striped table-hover table-bordered">
                            <!-- Cabecera -->
                            <tr class="info">
                                <th>Nombre del producto</th>
                                <th class="thDescrip">Descripción</th>
                                <th>Precio</th>
                                <th>Colección</th>
                                <th>Imagen del producto</th>
                            </tr>
                            <!-- Datos de cada coleccion -->
                            <?php
                                // Se importa la conexión con la base de datos
                                require_once '../../config/database.php';
                                $db = new Database();
                                $db->connect();
                                // Sentencia SELECT
                                $sql="SELECT * FROM catalogo";
                                $select=$db->select($sql);
                                $temporada;
                                $genero;
                                // Si la tabla tiene resultados
                                if($select){
                                    // Se muestran los datos de cada usuario
                                    foreach ($select as $key => $valor) {
                                        echo "<tr>";
                                        foreach ($valor as $campo => $value) {
                                            if($campo==="producto"){
                                                echo "<td>" . $value . "</td>";
                                            }
                                            if($campo==="descripcion"){
                                                echo "<td class='thDescrip'>" . $value . "</td>";
                                            }
                                            if($campo==="precio"){ 
                                                echo "<td>" . $value . "</td>";
                                            }
                                            if($campo==="coleccion"){
                                                if($value=="The"){
                                                    $value="The Row";
                                                }
                                                echo "<td>" . $value . "</td>";
                                            }
                                            if($campo==="fotoProducto"){

                                                echo "<td> <img width='150' height='250' src='data:image;base64,".$value."'/></td>";
                                            }                                           
                                        }
                                        //ho "<td> <img width='150' height='250' src='data:image;base64,".$imagen."'/></td>";
                                        echo "</tr>";
                                    } // Cierre del foreach                                  
                                }

                            ?> 
                        </table>
                    </div>
                </div><!-- Cierre de la tabla de los productos -->
                              
            </section> 
            <!--Ventana Modal del Inicio de sesión-->
            <?php include("../../include/iniciarSesion.html"); ?>
            <!--Ventana Modal del Dar de alta-->
            <?php include("../../include/darAlta.html"); ?>            
         </div> <!-- Cierre div del container -->
	</body>	
</html>