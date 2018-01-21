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
        <title> Mi perfil </title>
        <?php include("../include/elementsHead.html"); ?> <!-- Elementos de head --> 
        <link rel="stylesheet" type="text/css" href="../css/profile.css"> <!-- Diseño externo -->
        <link rel="stylesheet" type="text/css" href="../css/mensajes.css"> <!-- Mensajes flash -->
        <script type="text/javascript" src="../js/validarEditarDatos.js"></script> <!-- JS valida campos -->
        <script type="text/javascript" src="../js/canvas.js"></script> <!--  JS Canvas-->
        <script type="text/javascript" src="../js/borrarDeseo.js"></script> <!--  JS Canvas-->
        <script type="text/javascript" src="../js/borrarAmigo.js"></script> <!--  JS Canvas-->
        <script type="text/javascript">
            // JavaScript to set background color button eliminar lista de deseos
            function fondo(button){ button.style.backgroundColor = "red"; }
            function fondoBtn(button){ button.style.backgroundColor = "grey"; }
            // Set background color of friends
            function background(button){ button.style.backgroundColor = "#A0E7D7"; }
            function backgroundBtn(button){ button.style.backgroundColor = "grey"; }
        </script>
        <style type="text/css">
            @media screen and (min-width: 320px){ #perfilTitulo { margin-top: 30px; } }
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
                <div id="messages"> <?php echo $msg->display(); ?> </div>
                <!-- Perfil del usuario -->
                <div class="profile">
                    <?php   echo "<h1 id='perfilTitulo'><u>".$_SESSION["user"]."</u></h1>"; ?>
                    <!-- Foto usuario -->
                    <div id="avatarUser" class="box">
                        <h4 id="fotoPerfil"><b>Foto de perfil</b></h4>
                        <div id="recargaImagen" style="width:200px;">
                            <?php                            
                                // Se importa la conexión con la base de datos
                                require_once '../config/database.php'; 
                                $db = new Database();
                                $db->connect();
                                // Sentencia SELECT
                                $sql="SELECT fotoUsu FROM usuarios WHERE _id='".$_SESSION["id_user"]."';";
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
                        <!-- Añadir foto -->
                        <div id="div_file">
                            <p style="height:0px;width:200px;"><span><img src='../image/masIcono.png'></span><b> Añade una foto</b></p>
                            <input type="file" id="subirfoto" style="width:200px;" />
                        </div>
                        <!-- Area Canvas -->
                        <canvas id="areaCanvas" style="width:20%;height:20%;"></canvas><br /><br />
                        <!--<button id="bnw" disabled>Grayscale</button>
                        <button id="colour" disabled>Color</button><br /><br />-->
                        <!-- Boton para guardar la foto en la bd -->
                        <button id="enviar" name="<?php echo htmlspecialchars($_SESSION['id_user']); ?>" 
                        value="<?php echo htmlspecialchars($_SESSION['user']); ?>" disabled> Subir foto </button><br /><br />
                        
                    </div> <!-- Cierre de avatar -->
                    <!-- Editar nombre de usuario y el email -->
                    <div class="box editarDatos">

                        <!--Ventana Modal del editar usuario-->
                        <?php include("../include/editarUsuario.html"); ?> 
                        <!-- Muestra la variable de sesión del user -->
                        <?php if (isset($_SESSION['user'])) { echo "<p id='infoUser'>Usuario: <b>". $_SESSION["user"] ."</b>"; } ?>
                        <!-- Botón para que aparezca la ventana modal cambio de nombre -->
                        <button class="btn btn-info" data-toggle="modal" data-target="#editarUsuario" 
                        style="background-color:grey; color:#fff; border:none; opacity:0.7; padding-left:10px;margin-right:10px;
                        outline:none;"><span class="glyphicon glyphicon-pencil"></span></button><br /></p>

                        <!--Ventana Modal del editar email-->
                        <?php include("../include/editarEmail.html"); ?>
                        <!-- Muestra la variable de sesión del email -->
                        <?php if (isset($_SESSION['email'])) { echo "<p id='infoUser'>Email: <b>". $_SESSION["email"] ."</b>"; } ?>
                        <!-- Botón para que aparezca la ventana modal cambio del email -->
                        <button class="btn btn-info" data-toggle="modal" data-target="#editarEmail" 
                        style="background-color:grey; color:#fff; border:none; opacity:0.7; padding-left:10px;
                        margin-right:10px; outline:none;"><span class="glyphicon glyphicon-pencil"></span></button><br /></p>

                        <!-- Url responsive ver patrones & wishlist-->
                        <h4 id="tituloListaUrl"><a href="../view/listaPatrones.php?usuario=<?php echo htmlspecialchars($_SESSION['user']); ?>">Ver mis patrones</a></h4>
                        <h4 id="tituloListaDeseos"><a href="../view/listaDeseos.php?usuario=<?php echo htmlspecialchars($_SESSION['user']); ?>">Lista de deseos <span class="glyphicon glyphicon-heart"></span></a></h4>
                        <h4 id="tituloListaAmigos"><a href="../view/listaAmigos.php?usuario=<?php echo htmlspecialchars($_SESSION['user']); ?>">Mis amigos <span class="glyphicon glyphicon-user" id="iconoUser"></span></a></h4>

                    </div> <!-- Cierre de editarDatos -->
                    <!-- Añadir un patrón -->
                    <div id="patron">
                        <div id="div_patron">
                            <p style="height: 0px;width: 200px;"><span><img src='../image/glyphicons-dress-black.png'></span><b> Sube un patrón </b></p>
                            <input type="file" id="subirPatron" style="width:200px" />
                        </div>
                        <!-- Area Canvas -->
                        <canvas id="canvasPatron" style="width:60%;height:60%;"></canvas>
                        <!-- Hacer publico o no el patron -->
                        <div class="row" id="radios">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="" class="col-md-6 control-label">Hacer público su patrón: </label>
                                    <div class="col-md-6">
                                        <input id="radioInput" name="radio" type='hidden' value="Si"/>
                                        <div class="btn-group patron" data-toggle="buttons">
                                            <button type="button" class="btn btn-default active" data-radio-name="radio">Si</button>
                                            <button type="button" class="btn btn-default" data-radio-name="radio">No</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- Cierre de los radios -->
                        <!-- Boton para guardar la foto en la bd -->
                        <button id="enviarPatron" name="<?php echo htmlspecialchars($_SESSION['id_user']); ?>" 
                        value="<?php echo htmlspecialchars($_SESSION['user']); ?>" disabled> Subir patrón </button>
                    </div> <!-- Cierre de añadir patron -->
                    <!-- Lista de patrones -->
                    <h4 id="tituloLista">Lista de patrones</h4>
                    <div id="listaPatrones">
                        <?php 
                            require_once '../config/database.php';
                            $db = new Database();
                            $db->connect();
                            // Sentencia SELECT
                            $sql="SELECT * FROM patrones WHERE _idUsuario='".$_SESSION["id_user"]."'ORDER BY id DESC LIMIT 2;";
                            $select=$db->select($sql);
                            $sql2="SELECT * FROM patrones WHERE _idUsuario='".$_SESSION["id_user"]."';";
                            $select2=$db->select($sql2);
                            $nPatrones=count($select2);
                            // Se recore el array de la consulta
                            if($nPatrones!=0){
                                foreach ($select as $key => $valor) {
                                    foreach ($valor as $campo => $value) {
    
                                        if($campo==="patron"){ // Muestra la foto
                                            echo "<a href='../view/listaPatrones.php?usuario=".$_SESSION["user"]."'><img src='".$value."' alt='patron'/></a><br /><br />";
                                        }
                                    }
                                }
                            }
                            if($nPatrones>2){
                                echo "<p id='masPatrones'><a href='../view/listaPatrones.php?usuario=".$_SESSION["user"]."'>Ver mis patrones</a><p>";
                            }
                        ?>
                    </div> <!-- Cierre lista de patrones -->
                    <!-- Ver lista de deseos -->
                    <h4 id="tituloDeseos">Lista de deseos <span class="glyphicon glyphicon-heart"></span></h4>
                    <div id="listaDeseos"> 
                        <?php
                            require_once '../config/database.php';
                            $db = new Database();
                            $db->connect();
                            // Sentencia SELECT
                            $sql="SELECT * FROM wishlist WHERE idUser='".$_SESSION["id_user"]."' LIMIT 3;";
                            $select=$db->select($sql);
                            $codigoBarras=array();
                            $sql2="SELECT * FROM wishlist WHERE idUser='".$_SESSION["id_user"]."' LIMIT 3;";
                            $select2=$db->select($sql2);
                            $nWish=count($select2);
                            // Se recore el array de la consulta
                            if($nWish!=0){
                                foreach ($select as $key => $valor) {
                                    foreach ($valor as $campo => $value) {
                                        if($campo==="codigoBarrasProduct"){
                                            array_push($codigoBarras, $value);
                                        }
                                    }
                                }
                            
                                $ids = join(',',$codigoBarras);
                                //echo "<script>console.log( 'Debug Objects: " . $ids . "' );</script>";
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
                                    echo "<div class='deseo'>";                                 
                                    foreach ($valor as $campo => $value) {
                                        if($campo==="enlace"){
                                            $link=$value;
                                        }
                                        if($campo==="codigoBarras"){
                                            $codigoBarras=$value;
                                            echo "<div id=fila_".$codigoBarras."></div>";
                                        }
                                        if($campo==="producto"){
                                            $producto=$value;
                                        }
                                    } 
                                    ?>
                                    <a class="btn btn-primary noGustaProducto" onmouseover="fondo(this)" onmouseout="fondoBtn(this)" onclick="noGustaProducto('<?php echo htmlspecialchars($codigoBarras); ?>','<?php echo htmlspecialchars($_SESSION["user"]); ?>')">
                                        <span><img src="../image/delete.png"></span></a><?php
                                    echo "<a  class='linkGustar' href='http://shop-proyectoapp.rhcloud.com/es/".$link."' target='_blank'>".$producto."</a><br>";
                                    echo "</div>";
                                
                                }
                                if($nWish=3){
                                    echo "<br><p id='masWish'><a href='../view/listaDeseos.php?usuario=".$_SESSION["user"]."'>Mi wishlist </a><p>";
                                }
                            }
                        ?>
                    </div> <!-- Cierre de wishlist -->

                    <!-- Lista de amigos -->
                    <h4 id="tituloAmigos">Lista de amigos <span class="glyphicon glyphicon-user" id="iconoUser"></span></h4>
                    <div id="listaAmigos">
                        <?php // Conectar bd
                            require_once '../config/database.php';
                            $db = new Database();
                            $db->connect();
                            // Sentencia SELECT
                            $sql="SELECT * FROM amigos WHERE _idUser='".$_SESSION["id_user"]."';";
                            $select=$db->select($sql);
                            if($select!=null){
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
                            }
                        ?>
                    </div> <!-- Cierre lista de amigos -->

                </div><!-- Cierre del profile -->
                              
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
