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
	$sql="SELECT * FROM patrones WHERE usuario='".$nombreUsuario."';";
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
        ?><center><a id="eliminar" name="eliminar" onclick="borrarPatron('<?php echo htmlspecialchars($id); ?>','<?php echo htmlspecialchars($_GET["usuario"]); ?>')" class="btn btn-primary"><span class="glyphicon glyphicon-trash"></span></a></center><?php
    	echo "</div>";
    }
?>