<?php  require_once 'includes/redireccion.php'; ?> <!--   Solo permite usuarios logueados -->
    <!-- Barra header-->
<?php  require_once 'includes/header.php'; ?>
    <!-- Barra Lateral-->
<?php  require_once 'includes/side.php'; ?>


    <!-- Caja principal-->
<div id="principal">
  <h1>Crear Categoria</h1>
  <p>
      Añade nuevas categorias al blog para que los usuarios puedan usarlas al crear sus entradas.
  </p>
  <br>
    <form class="" action="guardarCategoria.php" method="POST">
      <label for="nombre">Nombre de la Categoría:</label>
      <input type="text" name="nombre" value="">
      <input type="submit" name="" value="Guardar">
    </form>

    <!--  -->
    <!--  Mostrar Errores  -->
    <?php if(isset($_SESSION['error'])):  ?>
          <div class="alerta alerta-error categoria">
              <?= $_SESSION['error'];  ?>
          </div>
      <?php endif; ?>
      <!--  -->

</div>


    <?php if(isset($_SESSION['error'])):  ?>
    <?php delectErrors(); ?>
    <?php endif; ?>


<?php require_once 'includes/footer.php'; ?>
