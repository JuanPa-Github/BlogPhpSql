<?php  require_once 'includes/redireccion.php'; ?> <!--   Solo permite usuarios logueados -->
    <!-- Barra header-->
<?php  require_once 'includes/header.php'; ?>
    <!-- Barra Lateral-->
<?php  require_once 'includes/side.php'; ?>

<!-- Caja principal-->
<div id="principal">
<h1>Crear Entradas</h1>
<p>
  Añade nuevas Entradas al blog para que los usuarios puedan leerlas y disfrutar de nuestro contenido.
</p>
<br>
<form class="" action="guardarEntrada.php" method="POST">

  <label for="titulo">Titulo:</label>
  <input type="text" name="titulo" value="">
  <?php echo isset($_SESSION['errores_entrada']) ? showError($_SESSION['errores_entrada'], 'titulo'): ''; ?>

  <label for="descripcion">Descripcion:</label>
  <textarea name="descripcion" rows="8" cols="101"></textarea>
  <?php echo isset($_SESSION['errores_entrada']) ? showError($_SESSION['errores_entrada'], 'descripcion'): ''; ?>

  <label for="categoria">Categoría:</label>
  <select class="" name="categoria">
  <?php echo isset($_SESSION['errores_entrada']) ? showError($_SESSION['errores_entrada'], 'categoria'): ''; ?>

      <?php $categorias = ConseguirCategorias($conexion_db);
          if(!empty($categorias)):
              while ($categoria = mysqli_fetch_assoc($categorias)):

      ?>
          <option value="<?= $categoria['id'] ?>">
            <?= $categoria['nombre']?>
          </option>
      <?php
              endwhile;
          endif;
      ?>
  </select>

  <input type="submit" name="" value="Guardar">
</form>
</div>


<?php if(isset($_SESSION['errores_entrada'])):  ?>
<?php delectErrors(); ?>
<?php endif; ?>


<?php require_once 'includes/footer.php'; ?>
