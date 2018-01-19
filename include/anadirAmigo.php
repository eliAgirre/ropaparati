<?php
$username=$_SESSION['user'];
if(!(isset($username))){
    // Se guarda el valor de la variable GET
    $username=$_GET['user'];
}

$amigo=$_GET['usuario'];
// Se requiere las sesiones para los mensajes flash
if( !session_id() ) session_start();
// Requiere la clase de mensajes y se instancia el objeto de tipo Messages
require_once('../controller/class.messages.php');
$msg = new Messages();
// Se importa la conexión con la base de datos
require_once '../config/database.php';
$db = new Database();
$db->connect();
// Sentencia SELECT
$sql="SELECT * FROM amigos WHERE username='".$username."' AND amigo='".$amigo."';";
$select=$db->select($sql);
if(!$select){ // Si no existe la relacion de amigos
	// Aparece el boton para añadir amigo
?><button class="btn btn-success" id="anadirAmigo" name="<?php echo htmlspecialchars($_GET['usuario']); ?>"
   value="<?php echo htmlspecialchars($_SESSION['user']); ?>">Añadir amigo</button><?php
}
else{ // Si tienen una relacion de amigos
	// Aparece el boton de amigo
	echo "<button class='btn btn-success' id='amigo'>Amigo <span><img src='../image/check.png'></span></button>";
}
?>