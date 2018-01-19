<!-- Top HTML admin -->                    
<?php include_once("../../include/topHtmlAdmin.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="es">
	<!-- Cabecera de toda la página -->
	<head>
        <title> Borrar colección </title>
        <?php include("../../include/elementsHeadAdmin.html"); ?>
        <script type="text/javascript" src="../../js/borrarColec.js"></script> <!-- Ajax -->
        <style type="text/css"> #borrarColec { background-color:grey; border:none; outline:none;} </style>
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

                                <!-- Tabla para listar las colecciones -->
                <div class="container" style="position:relative;top:25px;">
                    <div class="panel panel-primary" style="border-color:grey;">
                        <div class="panel-heading" style="background:#4D4D4D;border:none;"> Borrar colección </div>
                        <table class="table table-striped table-hover table-bordered">
                            <!-- Cabecera -->
                            <tr class="info">
                                <th>Nombre de la colección</th>
                                <th>Año</th>
                                <th>Temporada</th>
                                <th class="thSex">Género</th>
                                <th></th>
                            </tr>
                            <!-- Datos de cada usuario -->
                            <?php
                                // Se importa la conexión con la base de datos
                                require_once '../../config/database.php';
                                $db = new Database();
                                $db->connect();
                                // Sentencia SELECT
                                $sql="SELECT * FROM colecciones";
                                $select=$db->select($sql);
                                $temporada;
                                $genero;
                                // Si la tabla tiene resultados
                                if($select){
                                    // Se muestran los datos de cada usuario
                                    foreach ($select as $key => $valor) {
                                        echo "<tr>";
                                        foreach ($valor as $campo => $value) {

                                            if($campo==="cod"){
                                                $cod=$value;
                                                echo "<tr id=fila_" . $cod .">";
                                            }
                                            if($campo==="nombreColeccion"){
                                                echo "<td>" . $value . "</td>";
                                            }
                                            if($campo==="ano"){
                                                echo "<td>" . $value . "</td>";
                                            }
                                            if($campo==="temporada"){

                                                if($value==="pv"){
                                                    $temporada="Primavera-Verano";
                                                }
                                                else{
                                                    $temporada="Otoño-Invierno";   
                                                }
                                                echo "<td>" . $temporada . "</td>";
                                            }
                                            if($campo==="genero"){
                                                if($value==="H"){
                                                    $genero="Hombre";
                                                }
                                                else{
                                                    $genero="Mujer";   
                                                }
                                                echo "<td class='thSex'>" . $genero . "</td>";
                                            }
                                        }
                                        echo "<td>"?><a id="borrarColec" name="borrarColec" onclick="borrarColec('<?php echo htmlspecialchars($cod); ?>')" class="btn btn-primary"><span class="glyphicon glyphicon-trash"></span></a> <?php "</td>";
                                        echo "</tr>";
                                    } // Cierre del foreach                                  
                                }
                            ?> 
                        </table>
                    </div>
                </div><!-- Cierre de la tabla de los usuarios -->
                              
            </section> 
            <!--Ventana Modal del Inicio de sesión-->
            <?php include("../../include/iniciarSesion.html"); ?>
            <!--Ventana Modal del Dar de alta-->
            <?php include("../../include/darAlta.html"); ?>            
         </div> <!-- Cierre div del container -->
	</body>	
</html>