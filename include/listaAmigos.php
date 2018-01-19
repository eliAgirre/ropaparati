<?php
	// Inicia sesión o reanudar la sesión	
	session_start();
	// Se guarda el user
	$username=$_SESSION["user"];
	// Si la variable no tiene valor se obtiene desde la variable GET
	if(!isset($username)){
	    $username=$_GET('usuario');
	}
	// Se importa la conexión con la base de datos
    require_once '../config/database.php';
    $db = new Database();
    $db->connect();
    // Sentencia SELECT
    $sql="SELECT * FROM amigos WHERE username='".$username."';";
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