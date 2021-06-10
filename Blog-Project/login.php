<?php
// INICIAR SESSION Y LA CONEXION A LA BD
    require_once 'includes/conexion.php';

//REGOGER DATOS DEL FORMULARIO
    if (isset($_POST)) {

      //Borrar error antiguo
      if (isset($_SESSION['error_login'])) {
        unset($_SESSION['error_login']);
      }

      //Recoger datos del formulario
      $email = trim($_POST['email']);
      $password = $_POST['password'];

      //CONSULTA PARA COMPROBAR LAS CREDENCIALES DEL USUARIO
      $sql= "SELECT * FROM usuarios where email = '$email'";
      $login = mysqli_query($conexion_db, $sql);

      if ($login && mysqli_num_rows($login) == 1) {
          $usuarioLogin = mysqli_fetch_assoc($login); // Capturo todo el array de la fila del usuario
          $has = $usuarioLogin['password'];
          $verify = password_verify( $password, $has); // Compruebo contraseña  ***  //var_dump(password_verify($password, $ingreso_pass_segura)); die();   // Valida la contraseña

  //var_dump(password_verify($password, $usuarioLogin['password'] )); die();
        if ($verify) {
          //UTILIZAR SESSION PARA GUARDAR USUARIO LOGUEADO
          $_SESSION['usuario'] = $usuarioLogin;
        }else {
          $_SESSION['error_login'] = "Login Incorrecto";
        }
      }else {
        $_SESSION['error_login'] = "Login Incorrecto";
      }
    }
//REDIRIGIR AL INDEX
 header ('Location: index.php');

?>
