
<?php

function showError($errores, $campo){
  $alerta = '';
  if(isset($errores[$campo]) && !empty($campo)){
    $alerta = "<div class='alerta alerta-error'>".$errores[$campo].'</div>';
  }
return $alerta;
}

function delectErrors(){
  $borrado = false;
  if(isset($_SESSION['errores'])){
          $_SESSION['errores'] = null;
          $borrado = true;
  }
  if(isset($_SESSION['completado'])){
          $_SESSION['completado'] = null;
          $borrado = true;
  }
  if(isset($_SESSION['guardado'])){
          $_SESSION['guardado'] = null;
          $borrado = true;
  }
  if(isset($_SESSION['error'])){
          $_SESSION['error'] = null;
          $borrado = true;
  }
  if(isset($_SESSION['errores_entrada'])){
          $_SESSION['errores_entrada'] = null;
          $borrado = true;
  }
    return $borrado;
}

function ConseguirCategorias($conexion){
  $sql = "SELECT * FROM categorias ORDER BY id ASC ;";
  $categorias = mysqli_query($conexion, $sql);
  $resultado = array();
  if ($categorias && mysqli_num_rows($categorias) >= 1) {
    $resultado = $categorias;
  }
  return $resultado;
}


function ConseguirUltimasEntradas($conexion){
  $sql = "SELECT e.*, c.id AS 'id_categoria', c.nombre AS 'nombre_categoria' FROM entradas e
          INNER JOIN categorias c ON e.categorias_id = c.id
          ORDER BY e.id DESC LIMIT 3";
  $entradas = mysqli_query($conexion, $sql);
  $resultado = array();
  if($entradas && mysqli_num_rows($entradas)>= 1){
    $resultado = $entradas;
  }

  return $entradas;
}

function ConseguirUsuario($conexion, $id){
  $sql= "SELECT * FROM usuarios where id = '$id';";
  $login = mysqli_query($conexion, $sql);

  if ($login && mysqli_num_rows($login) == 1) {
      $usuarioLogin = mysqli_fetch_assoc($login); // Capturo todo el array de la fila del usuario
      if ($usuarioLogin) {
      $_SESSION['usuarioValidado'] = $usuarioLogin;
    }
  }
}


function ConseguirTodasEntradas($conexion, $limite, $busqueda = null ){
  $sql = "SELECT e.*, c.id AS 'id_categoria', c.nombre AS 'nombre_categoria' FROM entradas e ".
          "INNER JOIN categorias c ON e.categorias_id = c.id ";
         

if($limite == true){
  //  $sql=$sql.LIMIT 4   ****** CONCATENARLE A SQL el LIMIT 4
  $sql.= "LIMIT 4";
}

if(!empty($busqueda)){
  $sql.= "WHERE e.titulo LIKE '%$busqueda%' ";
}

$sql.= "ORDER BY e.id DESC ";

  $entradas = mysqli_query($conexion, $sql);
  $resultado = array();
  if($entradas && mysqli_num_rows($entradas)>= 1){
    $resultado = $entradas;
  }
  return $entradas;
}



function ConseguirCategoriaEspecifica($conexion,$id){
  $sql = "SELECT * FROM categorias WHERE id='$id';";
  $categorias = mysqli_query($conexion, $sql);
  $resultado = array();

  if ($categorias && mysqli_num_rows($categorias) >= 1) {
    $resultado = mysqli_fetch_assoc($categorias);
  }
  return $resultado;
}


function ConseguirEntradaEspecifica($conexion, $id){
  $sql = "SELECT * FROM entradas WHERE categorias_id = '$id' ORDER BY id DESC ;";
  $entradaEspecifica = mysqli_query($conexion, $sql);

  $resultado = array();
  if($entradaEspecifica && mysqli_num_rows($entradaEspecifica)>= 1){
    $resultado = $entradaEspecifica;
  }
  return $entradaEspecifica;
}


function Conseguir_Entrada_Categoria_Especifica($conexion, $id){
  $sql = "SELECT e.*, c.nombre AS 'categoria', CONCAT(u.nombre, '  ', u.apellidos) AS 'Usuario' FROM entradas e ".
  "INNER JOIN categorias c ON e.categorias_id = c.id ".
  "INNER JOIN usuarios u ON e.usuarios_id = u.id ".
  "WHERE e.id = '$id';";

  
  $entrada_Categoria_Especifica = mysqli_query($conexion, $sql);

  $resultado = array();
  if($entrada_Categoria_Especifica && mysqli_num_rows($entrada_Categoria_Especifica)>= 1){
    $resultado = mysqli_fetch_assoc($entrada_Categoria_Especifica);
  }
  return $resultado;
}

 ?>
