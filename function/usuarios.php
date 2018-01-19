<?php

/*
* usuarioExiste. Para comprobar si un usuario existe con un email.
* parans --> $email. Se obtiene del formulario.
* return --> Si el usuario existe retorna true, sino false.
*/
function usuarioExiste($email){

    // Se importa la conexión con la base de datos
    require_once '../config/database.php';
    $db = new Database();
    $db->connect();
    // Sentencia SELECT
	$sql="SELECT * FROM usuarios WHERE email='". $email ."'";
	$select=$db->select($sql);
    // Variable local 
    $existe="true"; // Se establece el valor true
    // Si no devuelve ningún resultado
    if(!$select){
        $existe="false"; // El valor es false
    }
    // Devuelve el valor de la variable local
    return $existe;

} // Cierre de la función usuarioExiste

/*
* comprobarPassword. Para comprobar si un usuario existe con esos datos.
* parans --> $email. Se obtiene del formulario.
*        --> $password. Se obtiene password cifrado del formulario.
* return --> Si el la contraseña coincide devolverá true, sino false.
*/
function comprobarPassword($email,$password){

    // Se importa la conexión con la base de datos
    require_once '../config/database.php';
    $db = new Database();
    $db->connect();
    // Sentencia SELECT
	$sql="SELECT * FROM usuarios WHERE email='". $email ."' AND password='". $password ."'";
	$select=$db->select($sql);
    // Variables local
    $correcto="true"; // Se establece el valor true
     // Si no devuelve ningún resultado
    if(!$select){
        $correcto="false"; // El valor es false
    }
	// Devuelve el valor de la variable local
    return $correcto;

} // Cierre de la función comprobarPassword

/*
* obtenerIdUsuario. Se obtiene el campo id de la bd.
* parans --> $email. Se obtiene del formulario.
* return --> El id en String.
*/
function obtenerIdUsuario($email){

    // Se importa la conexión con la base de datos
    require_once '../config/database.php';
    $db = new Database();
    $db->connect();
    // Sentencia SELECT
	$sql="SELECT * FROM usuarios WHERE email='". $email ."'";
	$select=$db->select($sql);
    // Se recore el array de la consulta
    foreach ($select as $key => $valor) {
        foreach ($valor as $campo => $value) {

            if($campo==="_id"){
                $id=$value; // Se guarda la id
            }
        }
    }
    // Devuelve la variable local en String
    return $id;

} // Cierre de la función obtenerIdUsuario

/*
* obtenerDatosUsuario. Se obtiene los datos del usuario.
* parans --> $id_usuario. Se obtiene desde la función obtenerIdUsuario.
* return --> Devuelve el array de datos del usuario.
*/
function obtenerDatosUsuario($id_usuario){

    // Se importa la conexión con la base de datos
    require_once '../config/database.php';
    $db = new Database();
    $db->connect();
    // Sentencia SELECT
    $sql="SELECT * FROM usuarios WHERE _id='". $id_usuario ."'";
    $select=$db->select($sql);
    // Devuelve los datos del usuario en un
    return $select;

} // Cierre de la función obtenerDatosUsuario

/*
* verificarPassword. Para comprobar si el usuario ha introducido la contraseña correcta.
* parans --> $usuario. Se obtiene del formulario.
*        --> $password. Se obtiene password cifrado del formulario.
* return --> Si el la contraseña coincide con la de bd devolverá true, sino false.
*/
function verificarPassword($usuario,$password){

    // Se importa la conexión con la base de datos
    require_once '../config/database.php';
    $db = new Database();
    $db->connect();
    // Sentencia SELECT
    $sql="SELECT * FROM usuarios WHERE usuario='". $usuario ."' AND password='". $password ."'";
    $select=$db->select($sql);
    // Variables local
    $correcto="true"; // Se establece el valor true
     // Si no devuelve ningún resultado
    if(!$select){
        $correcto="false"; // El valor es false
    }
    // Devuelve el valor de la variable local
    return $correcto;

} // Cierre de la función verificarPassword

/*
* usernameExiste. Para comprobar si un usuario existe con un nombre de usuario.
* parans --> $email. Se obtiene del formulario.
* return --> Si el usuario existe retorna true, sino false.
*/
function usernameExiste($usuario){

    // Se importa la conexión con la base de datos
    require_once '../config/database.php';
    $db = new Database();
    $db->connect();
    // Sentencia SELECT
    $sql="SELECT * FROM usuarios WHERE usuario='". $usuario ."'";
    $select=$db->select($sql);
    // Variables local
    $existe="true"; // Se establece el valor true
     // Si no devuelve ningún resultado
    if(!$select){
        $existe="false"; // El valor es false
    }
    // Devuelve el valor de la variable local
    return $existe;

} // Cierre de la función usuarioExiste

/*
* obtenerUsuario. Se obtiene el nombre del usuario a través del id del usuario.
* parans --> id_usuario. Parámetro para buscar el nombre del usuario.
* return --> Devuelve el nombre del usuario.
*/
function obtenerUsuario($id_usuario){

    // Se importa la conexión con la base de datos
    require_once '../config/database.php';
    $db = new Database();
    $db->connect();
    // Sentencia SELECT
    $sql="SELECT * FROM usuarios WHERE _id='". $id_usuario ."'";
    $select=$db->select($sql);
    // Se recore el array de la consulta
    foreach ($select as $key => $valor) {
        foreach ($valor as $campo => $value) {

            if($campo==="usuario"){
                $usuario=$value; // Se guarda la usuario
            }
        }
    }
    // Devuelve la variable local en String
    return $usuario;
    
} // Cierre del obtenerUsuario

/*
* obtenerEmail. Se obtiene el campo email de la bd.
* parans --> $usuario. Se obtiene del formulario.
* return --> El email en String.
*/
function obtenerEmail($id_usuario){

// Se importa la conexión con la base de datos
    require_once '../config/database.php';
    $db = new Database();
    $db->connect();
    // Sentencia SELECT
    $sql="SELECT * FROM usuarios WHERE _id='". $id_usuario ."'";
    $select=$db->select($sql);
    // Variable local 
    $email=''; // Se establece el valor vacío de String
    // Se recore el array de la consulta
    foreach ($select as $key => $valor) {
        foreach ($valor as $campo => $value) {

            if($campo==="email"){
                $email=$value; // Se guarda la usuario
            }
        }
    }
    // Devuelve la variable local en String
    return $email;

} // Cierre de la función obtenerEmail

?>