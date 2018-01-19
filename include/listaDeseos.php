<?php
	// Inicia sesión o reanudar la sesión	
	session_start();
	// Se guarda el user
	$nombreUsuario = $_SESSION["user"];
	// Si la variable no tiene valor se obtiene desde la variable GET
	if(!isset($nombreUsuario)){
	    $nombreUsuario=$_GET('usuario');
	}
	// Se importa la conexión con la base de datos
    require_once '../config/database.php';
    $db = new Database();
    $db->connect();
    // Sentencia SELECT
	$sql="SELECT * FROM wishlist WHERE user='".$nombreUsuario."';";
	$select=$db->select($sql);
	$codigoBarras=array();
    if($select!=null){
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
            <a class="btn btn-primary noGustaProducto" onmouseover="fondo(this)" onmouseout="fondoBtn(this)" onclick="noGustaProducto('<?php echo htmlspecialchars($codigoBarras); ?>')">
                <span><img src="../image/delete.png"></span></a><?php
            echo "<a  class='linkGustar' href='http://shop-proyectoapp.rhcloud.com/es/".$link."' target='_blank'>".$producto."</a><br>";
            echo "</div>";
        }
    }
?>