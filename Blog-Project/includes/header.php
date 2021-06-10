<?php require_once 'conexion.php' ; ?>
<?php require_once 'includes/helpers.php'; ?>

<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Index JPAS Blog Vedeojuegos</title>
    <link rel="stylesheet" href="./assets/css/style.css" type="text/css">   <!-- Importar los estilos de Diseño   -->
                  <!-- Ruta donde esta el archivo css   -->
  </head>
  <body>
    <!-- Cabecera-->
      <header id="cabecera">
        <!-- Logo -->
        <div id="logo">
          <a href="index.php">Blog Juan Pablo Ayala Sánchez
          </a>
        </div>

    <!-- Menú-->
        <nav id="menu">
              <ul>
                <li> <a href="index.php">Inicio</a> </li>
                <?php
                      $categorias = ConseguirCategorias($conexion_db);
                      if(!empty($categorias)):
                          while ($categoria = mysqli_fetch_assoc($categorias)):
                ?>
                              <li> <a href="categoria.php?id=<?=$categoria['id'];?>"> <?=$categoria['nombre']?> </a> </li>
                <?php
                          endwhile;
                      endif;
                ?>

                <li> <a href="index.php">Sobre mi</a> </li>
                <li> <a href="index.php">Contacto</a> </li>
              </ul>
          </nav>
          <div class="clearfix"> <!-- Borra los flotados -->
          </div>
      </header>
    <!--  Fin Cabecera  -->


    <!--  Inicio de Contenedor -->
      <div id="container">
