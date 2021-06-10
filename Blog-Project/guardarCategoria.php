<?php
if (isset($_POST)) {
  // INICIAR SESSION Y LA CONEXION A LA BD
      require_once 'includes/conexion.php';
      if(!isset($_SESSION)){
        session_start();
      }

      $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string ($conexion_db, $_POST['nombre']) : false;
                                          //evita el sql injection

  //VALIDAR LA INFORMACIÓN ANTES DE GUARDARLA
        $errores = array();
          //***  Validar campo nombre
      if(!empty($nombre) && is_string($nombre) && !preg_match('/[0-9]/',$nombre)){
          $nameVal=true;
          echo "Nombre Correcto";
      }else {
          $nameVal=false;
          $errores = "Nombre No Válido para Categoria";
      }

      if(count($errores)==0){
        $sql = "INSERT INTO categorias VALUES(NULL, '$nombre');";
        $guardarCategoria = mysqli_query($conexion_db, $sql);
        $_SESSION['guardado'] = "Categoría Creada con Exito";
        header ('Location:index.php');
      }else {
        $_SESSION['error'] = $errores;
        header ('Location:crearCategoria.php');
      }

  }


?>
