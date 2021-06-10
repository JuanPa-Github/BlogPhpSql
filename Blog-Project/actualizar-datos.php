<?php

  if(isset($_POST)){
    //Conectar a la DB
    require_once 'includes/conexion.php';

    //RECOGER VALORES DEL FORMULARIO DEL ACTUALIZACIÓN
                // METODO OPERADOR TERNARIO
                        //   condición if  ? valor_si_es_verdadero : valor_si_es_falso
      $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($conexion_db, $_POST['nombre']): false;
      $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($conexion_db, $_POST['apellidos']): false;
      $email = isset($_POST['email']) ? mysqli_real_escape_string($conexion_db, trim($_POST['email'])) : false;
      $id = $_SESSION['usuario']['id'];

      //VALIDAR LA INFORMACIÓN ANTES DE GUARDARLA
      $errores = array();
      //Validar información antes de guardarla

      if(!empty($nombre) && is_string($nombre) && !preg_match('/[0-9]/',$nombre)){
          $nameVal=true;
      }else {
          $nameVal=false;
          $errores['nombre']  = "nombre Incorrecto";
      }

      if(!empty($apellidos) && is_string($apellidos) && !preg_match('/[0-9]/',$apellidos)){
          $surnameVal=true;
      }else {
          $surnameVal=false;
          $errores['apellidos']  =  "apellido Incorrecto";
      }

      if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
          $emailVal = true;
      }else {
          $emailVal=false;
            $errores['email']  =  "email Incorrecto";
      }


        //  ACTUALIZAR USUARIO
        $guardar_user = false;
        if(!isset ($errores) || count($errores) == 0){   //Valida si no hay errores o sea si todas las validaciones fueron OK. procedo a guardar el usuario nuevo
          // Insertar Usuario en DB tabla correspondiente
          $guardar_user=true;

          //COMPROBAR SI EL EMAIL YA EXISTE EN DB Para que no repita el email
            $sql = "SELECT id, email FROM usuarios WHERE email = '$email'";
            $isset_email  = mysqli_query($conexion_db, $sql);
            $isset_user = mysqli_fetch_assoc($isset_email);

          if($isset_user['id']== $ususario['id'] || empty($isset_user)){ //Si no existe el email en la DB actualiza los datos

          $sql = "UPDATE usuarios SET ".
                  "nombre = '$nombre', apellidos = '$apellidos', email = '$email'".
                  "WHERE id='$id';";
          $guardar = mysqli_query($conexion_db, $sql);
          /*var_dump(mysqli_error($conexion_db));die();*/   // Validar el problema cuando no inserta los datos
          if($guardar){
            $_SESSION['usuario']['nombre'] = $nombre;
            $_SESSION['usuario']['apellidos'] = $apellidos;
            $_SESSION['usuario']['email'] = $email;
            $_SESSION['completado'] = "Tus Datos se han actualizado  con exito";
          }else {
            $_SESSION['errores']['general'] = "Fallo al actualizar tus datos";
          }
        }else {
          $_SESSION['errores']['general'] = "El usuario ya existe";
        }
      }else {
        $_SESSION['errores'] = $errores;
      }
}

header('Location: misDatos.php');



?>
