<main class="auth">
  <h2 class="auth__heading"><?php echo $title ?></h2>
  <p class="auth__text">Inicia sesión</p>

  <?php
    require_once __DIR__ . '/../templates/alerts.php';
  ?>

  <form method="POST" action="/login" class="formulario">
    <div class="formulario__field">
      <label for="email" class="formulario__label">Email</label>
      <input 
        type="text"
        class="formulario__input"
        placeholder = "Tu email"
        id = "email"
        name = "email"
      >
    </div>

    <div class="formulario__field">
      <label for="password" class="formulario__label">Contraseña</label>
      <input 
        type="password"
        class="formulario__input"
        placeholder = "Tu contraseña"
        id = "password"
        name = "password"
      >
    </div>

    <input type="submit" class="formulario__submit formulario__submit--login" value="Iniciar Sesión">
  </form>

  <div class="actions">
    <a href="/register" class="actions__link">¿Aún no tienes cuenta? Obtener una</a>
    <a href="/forget" class="actions__link">¿Olvidaste tu contraseña?</a>
  </div>
</main>