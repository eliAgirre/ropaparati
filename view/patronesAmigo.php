<!-- Top HTML -->                    
<?php  include("../include/topHtmlUser.php"); 
// Se comprueba si la variable de sesión contiene el valor y si es nulo
if(!(isset($_SESSION['id_user']) && $_SESSION['user']!='')){
    header('Location: ../index.php');
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="es">
	<!-- Cabecera de toda la página -->
	<head>
        <title> Lista de patrones </title>
        <?php include("../include/elementsHead.html"); ?> <!-- Elementos de head --> 
        <link rel="stylesheet" type="text/css" href="../css/listaPatrones.css"> <!-- Diseño externo -->
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
               
               <h1><u>Patrones de <?php $usuario=$_GET["usuario"];
               echo "<a id='urlAmigo' href='../view/amigo.php?usuario=$usuario'>".$_GET["usuario"]; ?></a></u></h1>
               <!-- Lista de patrones -->
               <div id="misPatrones">
					<?php 
						require_once '../config/database.php';
						$db = new Database();
						$db->connect();
						// Sentencia SELECT
						$sql="SELECT * FROM patrones WHERE usuario='".$_GET["usuario"]."'AND publico='Si';";
						$select=$db->select($sql);
						$idPatron;
						$imagen;
						// Se recore el array de la consulta
					    foreach ($select as $key => $valor) {
					    	echo "<div class='patron'>";
					        foreach ($valor as $campo => $value) {
					        	if($campo==="id"){
					        		$id=$value;
					        		echo "<div id=fila_".$id."></div>";
					        	}
					            if($campo==="patron"){ // Muestra la foto
					            	$imagen=$value;
					                echo "<img class='imgPatron' src='".$value."' alt='patron'/>";
					            }
					        }
                        	echo "</div>";
					    }
					?>
               </div>

            </section> 
            <!-- Representa el pie de toda la página -->
            <?php include("../include/footer.html"); ?>
            <!--Ventana Modal del Inicio de sesión-->
            <?php include("../include/iniciarSesion.html"); ?>
            <!--Ventana Modal del Dar de alta-->
            <?php include("../include/darAlta.html"); ?>             
        </div> <!-- Cierre div del container -->
    </body>	
</html>