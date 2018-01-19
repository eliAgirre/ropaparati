<script type="text/javascript" src="../js/appendUser.js"></script><!-- JS Lista user-->                   
<?php         
    $idUser=$_SESSION['id_user'];
    if(!(isset($idUser))){
        // Se guarda el valor de la variable GET
        $idUser=$_GET['id'];
    }
    // Se importa la conexión con la base de datos
    require_once '../config/database.php'; 
    $db = new Database();
    $db->connect();
    // Sentencia SELECT
    $sql="SELECT * FROM catalogo WHERE coleccion='Fendi-Pre-Fall' AND categoria='Tops'";
    $select=$db->select($sql);
    $codigoBarras=array();
    $enlace=array();
    $productos=array();
    $usersWish=array();
    $countWish=array();
    foreach ($select as $key => $valor) {
        foreach ($valor as $campo => $value) {
            if($campo==="codigoBarras"){
                array_push($codigoBarras, $value); // Se añade el valor del codigo
                $sqlWish="SELECT COUNT(*) FROM wishlist WHERE codigoBarrasProduct='".$value."'";
                $selectWish=$db->select($sqlWish);
                array_push($countWish, $selectWish); // Se guarda toda la consulta en otro array  
                $sqlUsers="SELECT * FROM wishlist WHERE codigoBarrasProduct='".$value."' GROUP BY idUser ORDER BY COUNT(codigoBarrasProduct);";
                $selectUsers=$db->select($sqlUsers);
                array_push($usersWish, $selectUsers);
            }
        }
    }
    // Se recorre el array de los numeros de lista de deseo de cada producto
    foreach ($countWish as $key => $valor) {
        foreach ($valor as $campo2 => $value2) {
            foreach ($value2 as $campo3 => $dato3) {
                $productos[$key]["wish"]=$dato3;
            }
        }
    }              
    foreach ($usersWish as $key => $valor) {
        foreach ($valor as $campo2 => $value2) {
            foreach ($value2 as $campo3 => $dato3) {
                if($campo3==="user"){
                    $productos[$key][$campo2]["user"]=$dato3; // Se añaden los usuarios
                }
            }
        }
    }
    // Join del array codigoBarras
    $ids = join(',',$codigoBarras);  
    // Sentencia SELECT with array
    $sql = "SELECT * FROM ps_product WHERE reference IN ($ids) ORDER BY id_miCatalogo asc";
    $select2=$db->select($sql);
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
    // Se recore el array de la consulta
    foreach ($select as $key => $valor) {
        foreach ($valor as $campo => $value) {
            if($campo==="codigoBarras"){
                $codigoBarras=$value;
                $productos[$key]["codigoBarras"]=$codigoBarras;
            }
            if($campo==="producto"){
                $nombre=$value;
                $productos[$key]["producto"]=$nombre;
            }
            if($campo==="precio"){
                $precio=$value;
                $productos[$key]["precio"]=$precio;
            }
            if($campo==="fotoProducto"){
                $fotoProducto=$value;
                $productos[$key]["fotoProducto"]=$fotoProducto;
            }
        }
    }
    $link;
    foreach ($productos as $key => $value) {
         echo "<div class='producto'>";
        foreach ($value as $campo => $valor) {
            if($campo==="wish"){
                $nWish=$valor;
            }
            if (is_array($valor)) {
                foreach ($valor as $columna => $dato) {
                    if($columna==="user"){ ?>
                        <div id="<?php echo htmlspecialchars($key); ?>" 
                        class="dataUser" value="<?php echo htmlspecialchars($dato); ?>">
                        </div><?php
                    }
                }
            }
            if($campo==="codigoBarras"){
                $codigoBarras=$valor;
            }
            if($campo==="producto"){
                $nombre=$valor;
            }
            if($campo==="precio"){
                $precio=$valor;
            }
            if($campo==="fotoProducto"){ // Muestra la foto
                echo "<div class='descrip'>";
                    echo "<a class='shop' href='http://shop-proyectoapp.rhcloud.com/es/".$link."' target='_blank'>
                    <span class='tienda'><b>Ir a la tienda</b></span>
                    <img width='150' height='250' src='data:image;base64,".$valor."' /></a>";
                    //echo "<a href='ropa.php?ropa=$nombre'>
                    //<img width='150' height='250' src='data:image;base64,".$valor."' /></a>";
                    echo "<h5>$nombre</h5>";
                    echo "<h6>$precio € </h6>";
                    if($idUser!=''):?>
                        <button class="btnMeGusta" name="<?php echo htmlspecialchars($codigoBarras); ?>"
                        value="<?php echo htmlspecialchars($idUser); ?>">
                        <span class="glyphicon glyphicon-heart"></span> Me gusta 
                        </button><a id="<?php echo htmlspecialchars($key); ?>" class="numWish"><?php echo " ".$nWish." "; ?>
                        <div class="divCount"></div></a><?php
                    endif;
                echo "</div>";                                
            }
            if($campo==="enlace"){
                $link=$valor;
            }
        }
        echo "</div>";
    }
?>