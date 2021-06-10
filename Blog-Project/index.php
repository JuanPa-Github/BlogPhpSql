<?php  require_once 'includes/header.php'; ?>

    <!--  Inicio de Contenedor -->
      <!--  ubicaciíon finalizando el header -->

    <!-- Barra Lateral-->
    <?php  require_once 'includes/side.php'; ?>

          <!-- Caja Principal-->
          <div id="principal">
              <h1> Ultimas Entradas</h1>

                <?php
                  $entradas = ConseguirUltimasEntradas($conexion_db);
                                  
                  if (!empty($entradas)):
                    while ($entrada = mysqli_fetch_assoc($entradas)):
                ?>
                      <article class="entrada">
                        <a href="entrada.php?id=<?= $entrada['id']?>">
                        <h2><?= $entrada['titulo'] ?></h2>
                        <p>
                            <?= substr($entrada['descripcion'],0, 180).'...' ?> <!--Reducir la cantidad de palabras a mostrar -->
                        </p>
                        </a>
                      </article>
                <?php
                    endwhile;
                  endif;
                ?>

            <div id="ver-todas">
                <a href="entradas.php">Ver todas las entradas</a>
              </div>

          </div>  <!-- FIN DE PRINCIPAL  -->

      <!-- Pie de Página-->
      <?php require_once 'includes/footer.php'; ?>
