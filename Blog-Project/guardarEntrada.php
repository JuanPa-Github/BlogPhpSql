<?php

if (isset($_POST)) {
  require_once 'includes/conexion.php';

  if(!isset($_SESSION)){
    session_start();
  }


  $titulo = isset($_POST['titulo']) ? mysqli_real_escape_string($conexion_db, $_POST['titulo']):false;
  $descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($conexion_db, $_POST['descripcion']):false;
  $categoria = isset($_POST['categoria']) ? (int) $_POST['categoria']:false;
  $usuario = $_SESSION['usuario']['id'];

  // Validaciones

  $errores = array();

  if (empty($titulo)) {
    $errores['titulo'] = 'El titulo no es válido';
  }

  if (empty($descripcion)) {
    $errores['descripcion'] = 'La descripción no es válida';
  }

  if (empty($categoria) && !is_numeric($categoria)) {
    $errores['categoria'] = 'La categoría no es válida';
  }

  if (count($errores) == 0) {

    if(isset($_GET['editarEntrada'])){
      $entrada_id = $_GET['editarEntrada'];
      $sql = "UPDATE entradas SET titulo = '$titulo', ". 
      "descripcion = '$descripcion', categorias_id = '$categoria' ". 
      "WHERE id = '$entrada_id' AND usuarios_id = '$usuario' ;";
    }else{
      $sql = "INSERT INTO entradas VALUES (NULL, '$usuario', '$categoria', '$titulo', '$descripcion', CURDATE() );";
    }
    
    $guardarEntrada = mysqli_query($conexion_db, $sql);
    header ('Location: index.php');
  }else {
    $_SESSION['errores_entrada'] = $errores;

    if(isset($_GET['editarEntrada'])){
      header ('Location: editar_entrada.php?id='.$_GET['editarEntrada']);
    }else{
    header ('Location: crearEntradas.php');
    }
  }

}


?>
