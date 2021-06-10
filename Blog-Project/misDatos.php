<?php  require_once 'includes/redireccion.php'; ?> <!--   Solo permite usuarios logueados -->
    <!-- Barra header-->
<?php  require_once 'includes/header.php'; ?>
    <!-- Barra Lateral-->
<?php  require_once 'includes/side.php'; ?>


<div id="principal">
<h1>Mis Datos</h1>

<?php if(isset($_SESSION['completado'])):  ?>
      <div class="alerta alerta-exito">
          <?= $_SESSION['completado'];  ?>
      </div>
  <?php elseif(isset($_SESSION['errores']['general'])): ?>
    <div class="alerta alerta-error">
        <?= $_SESSION['errores']['general'];  ?>
    </div>
  <?php endif; ?>

<form action="actualizar-datos.php" method="post">

  <label for="nombre">Nombre</label>
  <input type="text" name="nombre" pattern="[a-zA-Z ]+" value="<?= $_SESSION['usuario']['nombre'] ?>" style="color:grey">
  <?php echo isset($_SESSION['errores']) ? showError($_SESSION['errores'], 'nombre'): ''; ?>

  <label for="apellidos">Apellidos</label>
  <input type="text" name="apellidos" value="<?= $_SESSION['usuario']['apellidos'] ?>" style="color:grey">
  <?php echo isset($_SESSION['errores']) ? showError($_SESSION['errores'], 'apellidos'): ''; ?>

  <label for="email">Email</label>
  <input type="email" name="email" value="<?= $_SESSION['usuario']['email'] ?>" style="color:grey">
  <?php echo isset($_SESSION['errores']) ? showError($_SESSION['errores'], 'email'): ''; ?>

  <input type="submit" name="submit" value="Actualizar">

</form>
<?php delectErrors(); ?>

</div>





<?php require_once 'includes/footer.php'; ?>
