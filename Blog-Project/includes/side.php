
<!-- Barra Lateral-->
  <aside id="sidebar">


  <div id="buscador" class="bloque">
      <h3>Buscar</h3>

       <form  action="buscar.php" method="POST">
        <label for="buscador">Buscar</label>
        <input type="text" name="buscador">

        <input type="submit" name="" value="Buscar">
      </form>
    </div>

    <?php if(isset($_SESSION['usuario'])): ?>
    <div id="usuario-logueado" class="bloque">

      <h3>Bienvenido, <?= $_SESSION['usuario']['nombre']. ' ' . $_SESSION['usuario']['apellidos']; ?></h3>
      <!-- Botones cerrar session  -->
      <a href="crearEntradas.php" class="boton boton-verde">Crear Entradas</a>
      <a href="crearCategoria.php" class="boton">Crear Categorías</a>
      <a href="misDatos.php" class="boton boton-naranja">Mis Datos</a>
      <a href="cerrarSession.php" class="boton boton-rojo">Cerrar Session</a>

      <!--  -->
      <!--  Mostrar Aviso de guardado de Categoría con exito  -->
      <?php if(isset($_SESSION['guardado'])):  ?>
            <div class="alerta alerta-exito categoria">
                <?= $_SESSION['guardado'];  ?>
            </div>
        <?php endif; ?>
        <!--  -->

    </div>
    <?php endif; ?>


    <?php if(!isset($_SESSION['usuario'])): ?> <!-- Validacion para ocultar bloques de requistro y loguin  -->
    <div id="login" class="bloque">
      <h3>Identificate</h3>

      <?php if(isset($_SESSION['error_login'])): ?>
      <div class="alerta alerta-error">
        <?= $_SESSION['error_login']; ?>
      </div>
      <?php endif; ?>

      <form  action="login.php" method="POST">
        <label for="email">Email</label>
        <input type="email" name="email">

        <label for="password">Contraseña</label>
        <input type="password" name="password">

        <input type="submit" name="" value="Entrar">
      </form>
    </div>


    <div id="registro" class="bloque">
      <h3>Registrate</h3>

      <!--  Mostrar Errores  -->
      <?php if(isset($_SESSION['completado'])):  ?>
            <div class="alerta alerta-exito">
                <?= $_SESSION['completado'];  ?>
            </div>
        <?php elseif(isset($_SESSION['errores']['general'])): ?>
          <div class="alerta alerta-error">
              <?= $_SESSION['errores']['general'];  ?>
          </div>
        <?php endif; ?>
      <form action="register.php" method="post">

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" pattern="[a-zA-Z ]+">
        <?php echo isset($_SESSION['errores']) ? showError($_SESSION['errores'], 'name'): ''; ?>

        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos">
        <?php echo isset($_SESSION['errores']) ? showError($_SESSION['errores'], 'surname'): ''; ?>

        <label for="email">Email</label>
        <input type="email" name="email">
        <?php echo isset($_SESSION['errores']) ? showError($_SESSION['errores'], 'email'): ''; ?>

        <label for="password">Contraseña</label>
        <input type="password" name="password">
        <?php echo isset($_SESSION['errores']) ? showError($_SESSION['errores'], 'password'): ''; ?>

        <input type="submit" name="submit_registro" value="Registrar">

      </form>
      <?php delectErrors(); ?>
    </div>
    <?php endif; ?> <!-- Cerrar validacion de ucultamiento de bloques de login y registro  -->

    <?php if(isset($_SESSION['guardado'])):  ?>
    <?php delectErrors(); ?>
    <?php endif; ?>


  </aside>
