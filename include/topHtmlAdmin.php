<?php
// Se requiere las sesiones para los mensajes flash
if( !session_id() ) session_start();
// Requiere la clase de mensajes y se instancia el objeto de tipo Messages
require_once('../../controller/class.messages.php');
$msg = new Messages();
// Se comprueba si es el administrador
if(!(isset($_SESSION['id_user']) && $_SESSION['user']!='' && $_SESSION['id_user']=='cdaw65n713ix28m')){
    // Redirecciona a la página principal si no es administrador
    header('Location: ../../index.php');
}
?>