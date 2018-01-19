<!-- Top HTML -->                    
<?php  include("../include/topHtmlUser.php"); 
if($_GET['usuario']===$_SESSION['user']){
    header('Location: ../view/profile.php');
}
// Se comprueba si la variable de sesión contiene el valor y si es nulo
if(!(isset($_SESSION['id_user']) && $_SESSION['user']!='')){
    header('Location: ../index.php');
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="es">
	<!-- Cabecera de toda la página -->
	<head>
        <title> Perfil de <?php echo $_GET["usuario"]; ?> </title>
        <?php include("../include/elementsHead.html"); ?> <!-- Elementos de head --> 
        <link rel="stylesheet" type="text/css" href="../css/profile.css"> <!-- Diseño externo -->
        <link rel="stylesheet" type="text/css" href="../css/mensajes.css"> <!-- Mensajes flash -->
        <script type="text/javascript" src="../js/anadirAmigo.js"></script> <!--  jQuery Amigo-->
        <style type="text/css">
            @media screen and (min-width: 320px){ #perfilTitulo { margin-top: 20px; } }
        </style>
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
                <!-- Mostrar el mensaje flash -->
                <?php echo "<div id='message'>"; echo $msg->display(); echo "</div>"; ?>
                <!-- Perfil del usuario -->
                <div class="profileAmigo">
                    <?php   echo "<h1 id='perfilTitulo'><u>Perfil de ". $_GET["usuario"] . "</u></h1>"; ?>
                    <!-- Foto usuario -->
                    <div id="avatar" class="box">
                        <div id="recargaImagen">
                            <?php                            
                                // Se importa la conexión con la base de datos
                                require_once '../config/database.php'; 
                                $db = new Database();
                                $db->connect();
                                // Sentencia SELECT
                                $sql="SELECT fotoUsu FROM usuarios WHERE usuario='".$_GET["usuario"]."';";
                                $select=$db->select($sql);
                                // Se recore el array de la consulta
                                foreach ($select as $key => $valor) {
                                    foreach ($valor as $campo => $value) {

                                        if($campo==="fotoUsu"){ // Muestra la foto
                                            echo "<img id='fotoUsuario' src='".$value."' alt='Avatar'/><br /><br />";
                                        }
                                    }
                                }
                            ?>
                        </div> <!-- Cierre de recargar imagen -->
                        <!-- Boton amigo -->
                        <div id='botonAmigo'>
                            <?php include('../include/anadirAmigo.php'); ?>
                        </div>
                    </div> <!-- Cierre de avatar -->

                    <!-- Lista de patrones -->
                    <h4 id="tituloListaAmigo">Lista de patrones</h4>
                    <h4 id="tituloListaUrlAmigo"><a href="../view/patronesAmigo.php?usuario=<?php echo htmlspecialchars($_GET["usuario"]); ?>">Ver sus patrones</a></h4>
                    <div id="listaPatronesAmigo">
                        <?php 
                            require_once '../config/database.php';
                            $db = new Database();
                            $db->connect();
                            // Sentencia SELECT
                            $sql="SELECT * FROM patrones WHERE usuario='".$_GET["usuario"]."'AND publico='Si' ORDER BY id DESC LIMIT 2;";
                            $select=$db->select($sql);
                            $sql2="SELECT * FROM patrones WHERE usuario='".$_GET["usuario"]."'AND publico='Si';";
                            $select2=$db->select($sql2);
                            $nPatrones=count($select2);
                            // Se recore el array de la consulta
                            foreach ($select as $key => $valor) {
                                foreach ($valor as $campo => $value) {

                                    if($campo==="patron"){ // Muestra la foto
                                        echo "<a href='../view/patronesAmigo.php?usuario=".$_GET["usuario"]."'><img src='".$value."' alt='patron'/></a><br /><br />";
                                    }
                                }
                            }
                            if($nPatrones>2){
                                echo "<p id='masPatrones'><a href='../view/patronesAmigo.php?usuario=".$_GET["usuario"]."'>Ver patrones</a><p>";
                            }
                        ?>
                    </div> <!-- Cierre lista de patrones -->

                    <!-- Ver lista de deseos -->
                    <h4 id="tituloDeseosAmigo">Lista de deseos <span class="glyphicon glyphicon-heart"></span></h4>
                    <div id="listaDeseosAmigo"> 
                        <?php
                            require_once '../config/database.php';
                            $db = new Database();
                            $db->connect();
                            // Sentencia SELECT
                            $sql="SELECT * FROM wishlist WHERE user='".$_GET["usuario"]."';";
                            $select=$db->select($sql);
                            $codigoBarras=array();
                            // Se recore el array de la consulta
                            foreach ($select as $key => $valor) {
                                foreach ($valor as $campo => $value) {
                                    if($campo==="codigoBarrasProduct"){
                                        array_push($codigoBarras, $value);
                                    }
                                }
                            }
                            $ids = join(',',$codigoBarras);
                            $enlace=array();
                            $productos=array();
                            $sql2= "SELECT * FROM ps_product WHERE reference IN ($ids) ORDER BY id_miCatalogo asc";
                            $select2=$db->select($sql2);
                            // Array codigoBarras
                            foreach ($select2 as $key2 => $valor2) {
                                foreach ($valor2 as $campo2 => $value2) {
                                    if($campo2==="id_product"){
                                        $ps_idProduct=$value2;
                                    }
                                    if($campo2==="link_rewrite"){
                                        $ps_link=$value2;
                                    }
                                    if($campo2==="category"){
                                        $category=$value2;
                                    }
                                }
                                array_push($enlace, $category."/".$ps_idProduct."-".$ps_link.".html");
                            }
                            foreach ($enlace as $key => $value) {
                                $productos[$key]["enlace"]=$value; //Se añade el enlace al array de productos
                            }
                            // Sentencia SELECT with array
                            $sql3 = "SELECT * FROM catalogo WHERE codigoBarras IN ($ids)";
                            $select3=$db->select($sql3);
                            foreach ($select3 as $key => $valor) {
                                foreach ($valor as $campo => $value) {
                                    if($campo==="codigoBarras"){
                                        $productos[$key]["codigoBarras"]=$value;
                                    }
                                    if($campo==="producto"){
                                        $productos[$key]["producto"]=$value;
                                    }
                                }
                            }

                             // Se recore el array de la consulta
                            foreach ($productos as $key => $valor) {                                 
                                foreach ($valor as $campo => $value) {
                                    if($campo==="enlace"){
                                        $link=$value;
                                    }
                                    if($campo==="codigoBarras"){
                                        $codigoBarras=$value;
                                    }
                                    if($campo==="producto"){
                                        $producto=$value;
                                    }
                                } 
                                echo "<a  class='linkGustar' href='http://shop-proyectoapp.rhcloud.com/es/".$link."' target='_blank'>".$producto."</a><br>";
                            }
                        
                        ?>
                    </div> <!-- Cierre de wishlist -->

                    <!-- Lista de amigos -->
                    <h4 id="tituloAmigosAmigo">Amigos de <?php echo $_GET['usuario']." "; ?><span class="glyphicon glyphicon-user" id="iconoUser"></span></h4>
                    <div id="listaAmigosAmigo">
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
                                    if($campo==="amigo"){
                                        $amigo=$value;
                                    }
                                }
                                echo "<a  class='linkAmigo' href='../view/amigo.php?usuario=".$amigo."' target='_blank'>".$amigo."</a>";
                            } // Cierre foreach

                        ?>
                    </div> <!-- Cierre lista de amigos -->

                </div> <!-- Cierre de profile -->
            
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