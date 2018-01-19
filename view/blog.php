<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="es">
	<!-- Cabecera de toda la página -->
	<head>
        <title> Blog </title>
        <?php include("../include/elementsHead.html"); // Elementos de head ?>
        <link rel="stylesheet" href="../css/blog.css" /> <!-- Diseño externo -->
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
                <div id="leftBar"></div>
                <div id="centroB">
                <?php
                    // Se importa la conexión con la base de datos
                    require_once '../config/database.php'; 
                    $db = new Database();
                    $db->connect();
                    // Sentencia SELECT
                    $sql="SELECT * FROM wp_posts WHERE post_type='post' AND post_status='publish' ORDER BY ID DESC LIMIT 5;";
                    $select=$db->select($sql);
                    $postDate;
                    $postTitle;
                    $postContent;                    
                    // Se recore el array de la consulta
                    foreach ($select as $key => $valor) {
                        foreach ($valor as $campo => $value) {

                            if($campo==="post_date"){
                                $postDate=$value;
                            }
                            if($campo==="post_title"){
                                $postTitle=$value;
                            }
                            if($campo==="post_content"){
                                $postContent=$value;
                            }
                        }
                    
                    //format date
                    $postDate = strtotime($postDate);
                    $postDate = strftime("%b %e %Y", $postDate);                    
                

                    echo "<div class='post'><br /><br />";
                        echo "<span class='date'>".$postDate."</span><br /><br />";
                        echo "<a class='title' href='http://blog-proyectoapp.rhcloud.com/' target='_blank'> $postTitle </a>";
                        echo "<br /><br />$postContent<br />";
                        echo "<a href='http://blog-proyectoapp.rhcloud.com/' target='_blank'>Más artículos</a>";
                    echo "</div><br />";
                    }
                ?>
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