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
        <title> Mi lista de deseos </title>
        <?php include("../include/elementsHead.html"); ?> <!-- Elementos de head --> 
        <link rel="stylesheet" type="text/css" href="../css/listaDeseos.css"> <!-- Diseño externo -->
        <script type="text/javascript" src="../js/borrarDeseo.js"></script> <!--  JS Canvas-->
        <script type="text/javascript">
            // JavaScript to set background color button eliminar lista de deseos
            function fondo(button){ button.style.backgroundColor = "red"; }
            function fondoBtn(button){ button.style.backgroundColor = "grey"; }
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
               
                <h1><u>Mi lista de deseos</u> <span class="glyphicon glyphicon-heart"></span></h1>
                <!-- Lista de deseos -->
                <div id="listaDeseos"> 
                        <?php
                            require_once '../config/database.php';
                            $db = new Database();
                            $db->connect();
                            // Sentencia SELECT
                            $sql="SELECT * FROM wishlist WHERE user='".$_GET['usuario']."';";
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
                                <a class="btn btn-primary noGustaProducto" onmouseover="fondo(this)" onmouseout="fondoBtn(this)" onclick="noGustaProducto('<?php echo htmlspecialchars($codigoBarras); ?>','<?php echo htmlspecialchars($_GET["usuario"]); ?>')">
                                    <span><img src="../image/delete.png"></span></a><?php
                                echo "<a  class='linkGustar' href='http://shop-proyectoapp.rhcloud.com/es/".$link."' target='_blank'>".$producto."</a><br>";
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