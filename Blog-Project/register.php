<?php

  if(isset($_POST)){
    //Conectar a la DB
    require_once 'includes/conexion.php';

    //INICIAR SESSION
    if(!isset($_SESSION)){
      session_start();
    }

    //RECOGER VALORES DEL FORMULARIO DEL REGISTRO
                    //METODO TRADICIONAL
      if(isset($_POST['nombre'])){
          $name = mysqli_real_escape_string($conexion_db, $_POST['nombre']);  // mysqli_real_escape_string es Para evitar el sql injection
        }else {
          $name = false;
        }
                    // METODO OPERADOR TERNARIO
                        //   condición if  ? valor_si_es_verdadero : valor_si_es_falso
      $surname = isset($_POST['apellidos']) ? mysqli_real_escape_string($conexion_db, $_POST['apellidos']): false;
      $email = isset($_POST['email']) ? mysqli_real_escape_string($conexion_db, trim($_POST['email'])) : false;
      $password = isset($_POST['password']) ? mysqli_real_escape_string($conexion_db, $_POST['password']) : false;

      //VALIDAR LA INFORMACIÓN ANTES DE GUARDARLA
          //***  Validar campo name
      if(!empty($name) && is_string($name) && !preg_match('/[0-9]/',$name)){
          $nameVal=true;
          echo "NOMBRE Correcto";
      }else {
          $nameVal=false;
          $errores['name']  = "nombre INcorrecto";
      }
      //***  Validar campo surname
      if(!empty($surname) && is_string($surname) && !preg_match('/[0-9]/',$surname)){
          $surnameVal=true;
          echo "APELLIDO Correcto";
      }else {
          $surnameVal=false;
          $errores['surname']  =  "apellido INcorrecto";
      }
      //***  Validar campo email
      if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
          $emailVal = true;
          echo "EMAIL Correcto";
      }else {
          $emailVal=false;
            $errores['email']  =  "email INcorrecto";
      }
      //***  Validar campo password
      if(!empty($password)){
          $passwordVal = true;
          echo "PASSWORD CON dATOS";
      }else {
          $passwordVal=false;
          $errores['email']  = "El campo PASSWORD is empty";
      }

        // ** INSERTAR DATOS EN LA DB
        $guardar_user = false;
        if(!isset ($errores) || count($errores) == 0){   //Valida si no hay errores o sea si todas las validaciones fueron OK. procedo a guardar el usuario nuevo
          // Insertar Usuario en DB tabla correspondiente
          $guardar_user=true;
          //CIFRAR CONTRASEÑ
          $password_segura = password_hash($password, PASSWORD_DEFAULT);  //'cost' es el numero de veces que cifra la contraseña
             //  var_dump(password_verify($password, $password_segura));   // Valida la contraseña
          $sql = "INSERT INTO usuarios VALUES(NULL, '$name', '$surname', '$email', '$password_segura', CURDATE());";
          $guardar = mysqli_query($conexion_db, $sql);

          /*
          var_dump(mysqli_error($conexion_db));   // Validar el problema cuando no inserta los datos
          die();
          */

          if($guardar){
            $_SESSION['completado'] = "El registro se ha completado con exito";
          }else {
            $_SESSION['errores']['general'] = "Fallo al guardar el usuario";
          }

      }else {
        $_SESSION['errores'] = $errores;
      }
}

header('Location: index.php');



?>
