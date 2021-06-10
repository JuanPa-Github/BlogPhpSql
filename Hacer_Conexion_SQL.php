<?php
// CONECTAR A LA DB
$_conexion = mysqli_connect("localhost", "root", "", "phpmysql");
//                          "Servidor","Usuario","password","DB name"


// COMPROBAR SI LA CONEXION ES EXITOSA
if(mysqli_connect_errno()){
  echo "La conexión a la Base de Datos MYSQL ha fallado". mysqli_connect_errno();
}else {
  echo "Conexión exitosa !!!!!!";
  echo "<hr>";
}

// CONSULTA PARA CONFIGURAR LA CODIFICACIÓN DE CARACTERES
mysqli_query($_conexion, "SET NAMES 'utf8'");

//CONSULTA SELECT DESDE PHP
$query = mysqli_query($_conexion, "SELECT * FROM notas");
while ($nota = mysqli_fetch_assoc($query)) {
            /*echo "<pre>";
            var_dump($nota);
            echo "</pre>";
            */
  echo "<h2>".$nota['titulo']. '<br></h2>';
  echo $nota['descripcion']."<br>";
  echo "<hr>";
}


//INSERTAR EN LA BASE DE DATOS SQL DESDE PHP
$sql= "INSERT INTO notas VALUES(NULL, 'Nota 3 - Desde PHP', 'Esta nota se insertó desde PHP', 'Black')";
$insert = mysqli_query($_conexion, $sql);

if($insert){
  echo "Datos insertados en la DB desde PHP correctamente";
} else {
  echo "ERROR: ". mysqli_error($_conexion);
}

?>
