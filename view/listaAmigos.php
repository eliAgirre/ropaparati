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
        <title> Mis amigos</title>
        <?php include("../include/elementsHead.html"); ?> <!-- Elementos de head --> 
        <link rel="stylesheet" type="text/css" href="../css/listaAmigos.css"> <!-- Diseño externo -->
        <script type="text/javascript" src="../js/borrarAmigo.js"></script> <!--  JS Canvas-->
        <script type="text/javascript">
            // Set background color of friends
            function background(button){ button.style.backgroundColor = "#A0E7D7"; }
            function backgroundBtn(button){ button.style.backgroundColor = "grey"; }
        </script>
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
               
                <h1 id="tituloAmigos">Mis amigos <span class="glyphicon glyphicon-user" id="iconoUser"></span></h1>
                <!-- Lista de amigos -->
                <div id="listaAmigos">
                        <?php // Conectar bd
                            require_once '../config/database.php';
                            $db = new Database();
                            $db->connect();
                            // Sentencia SELECT
                            $sql="SELECT * FROM amigos WHERE username='".$_GET['usuario']."';";
                            $select=$db->select($sql);
                            // Se recore el array de la consulta
                            foreach ($select as $key => $valor) {
                                foreach ($valor as $campo => $value) {
                                    if($campo==="_idAmigo"){
                                        $idAmigo=$value;
                                    }
                                    if($campo==="amigo"){
                                        $amigo=$value;
                                    }
                                }
                                ?>
                                <a class="btn btn-primary noAmigo" onmouseover="background(this)" onmouseout="backgroundBtn(this)" onclick="noAmigo('<?php echo htmlspecialchars($idAmigo); ?>','<?php echo htmlspecialchars($_SESSION["user"]); ?>')">
                                    <span><img src="../image/delete.png"></span></a><?php
                                echo "<a  class='linkAmigo' href='../view/amigo.php?usuario=".$amigo."' target='_blank'>".$amigo."</a>";
                            } // Cierre foreach

                        ?>
                    </div> <!-- Cierre lista de amigos -->

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