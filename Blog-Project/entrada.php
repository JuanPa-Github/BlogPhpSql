<?php  require_once 'includes/conexion.php'; ?>
<?php  require_once 'includes/helpers.php'; ?>

<?php

$entrada_Actual = Conseguir_Entrada_Categoria_Especifica($conexion_db, $_GET['id']);


if(!isset($entrada_Actual['id'])){
  header ('Location: index.php');
}
?>

<?php  require_once 'includes/header.php'; ?>
<?php  require_once 'includes/side.php'; ?>

          <!-- Caja Principal-->
          <div id="principal">
              <h1> <?= $entrada_Actual['titulo']; ?></h1>

              <a href="categoria.php?id=<?= $entrada_Actual['categorias_id'] ?>">
              <h2><?= $entrada_Actual['categoria']; ?></h2>
              </a>
              <h2><?= $entrada_Actual['fecha']; ?> | <?= $entrada_Actual['Usuario'] ?> </h2>
                <p>
                  <?= $entrada_Actual['descripcion']; ?>
                </p>

                 
                <?php if(isset ( $_SESSION['usuario']) && $entrada_Actual['usuarios_id']== $_SESSION['usuario']['id']): ?>
                    <a href="editar_entrada.php?id=<?=$entrada_Actual['id']?>" class="boton boton-verde">Editar Entrada</a>
                    <a href="borrar_entrada.php?id=<?=$entrada_Actual['id']?>" class="boton">Eliminar Entrada</a>
                <?php endif; ?>
                

             </div>  <!-- FIN DE PRINCIPAL  -->

      <!-- Pie de Página-->
      <?php require_once 'includes/footer.php'; ?>
