<?php  require_once 'includes/header.php'; ?>

    <?php  require_once 'includes/side.php'; ?>

          <!-- Caja Principal-->
          <div id="principal">
              <h1> Todas las Entradas</h1>

                <?php
                  $entradas = ConseguirTodasEntradas($conexion_db, false);
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
                <a href="index.php">Ver Ultimas Entradas</a>
              </div>

          </div>  <!-- FIN DE PRINCIPAL  -->

      <!-- Pie de Página-->
      <?php require_once 'includes/footer.php'; ?>
