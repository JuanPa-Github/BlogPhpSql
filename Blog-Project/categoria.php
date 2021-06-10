<?php  require_once 'includes/conexion.php'; ?>
<?php  require_once 'includes/helpers.php'; ?>

<?php
$categoriaActual = ConseguirCategoriaEspecifica($conexion_db, $_GET['id']);

if(!isset($categoriaActual['id'])){
  header ('Location: index.php');
}
?>

<?php  require_once 'includes/header.php'; ?>
<?php  require_once 'includes/side.php'; ?>

          <!-- Caja Principal-->
          <div id="principal">

              <h1> Entradas de <?= $categoriaActual['nombre']; ?></h1>

                <?php

                  $entrada = ConseguirEntradaEspecifica($conexion_db, $categoriaActual['id']);

                  if (!empty($entrada) && mysqli_num_rows($entrada)>=1):   //mysqli_num_rows($) Quiere decir que si hay filas por recorrer O sea que si la variable trae información
                    while ($entradas = mysqli_fetch_assoc($entrada)):
                ?>
                      <article class="entrada">
                        <a href="entrada.php?id=<?= $entradas['id']?>">
                        <h2><?= $entradas['titulo'] ?></h2>
                        <p>
                            <?= substr($entradas['descripcion'],0, 180).'...' ?> <!--Reducir la cantidad de palabras a mostrar -->
                        </p>
                        </a>
                      </article>
                <?php
                    endwhile;
                  else:
                ?>
              <div class="alerta">No hay entradas en esta categoría</div>
            <?php endif; ?>
            <div id="ver-todas">
                <a href="index.php">Ver Ultimas Entradas</a>
              </div>

          </div>  <!-- FIN DE PRINCIPAL  -->

      <!-- Pie de Página-->
      <?php require_once 'includes/footer.php'; ?>
