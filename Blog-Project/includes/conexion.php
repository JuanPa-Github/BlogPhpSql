<?php

$server = "localhost";
$user = "root";
$password= "";
$db = "blog";

$conexion_db = mysqli_connect($server, $user, $password, $db);
mysqli_query($conexion_db, "SET NAMES 'utf8'");

//Inicaiar la session si no ha sido inicializada aún
if(!isset($_SESSION)){
session_start ();
}

/*   Código para validar la conexion a la DB

if(mysqli_connect_errno()){
  echo "La conexión a la Base de Datos MYSQL ha fallado". mysqli_connect_errno();
}else {
  echo "Conexión exitosa !!!!!!";
  echo "<hr>";
}


*/


?>
