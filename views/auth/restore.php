<main class="auth">
  <h2 class="auth__heading"><?php echo $title ?></h2>
  <p class="auth__text">Ingrese su nueva contraseña</p>

  <?php
    require_once __DIR__ . '/../templates/alerts.php'
  ?>

  <?php
    if ($token_valido) {
  ?>
  <form method="POST" class="formulario">
    <div class="formulario__field">
      <label for="password" class="formulario__label">Nueva contraseña</label>
      <input 
        type="password"
        class="formulario__input"
        placeholder = "Tu nueva contraseña"
        id = "password"
        name = "password"
      >
    </div>

    <input type="submit" class="formulario__submit formulario__submit--login" value="Guardar contraseña">
  </form>
  <?php } ?>

  <div class="actions">
    <a href="/login" class="actions__link">¿Ya tienes cuenta? Iniciar sesión</a>
    <a href="/register" class="actions__link">¿Aún no tienes cuenta? Obtener una</a>
  </div>
</main>

