<main class="auth">
  <h2 class="auth__heading"><?php echo $title ?></h2>
  <p class="auth__text">Recupera tu acceso</p>

  <?php
    require_once __DIR__ . '/../templates/alerts.php'
  ?>

  <form method="POST" action="/forget" class="formulario">
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

    <input type="submit" class="formulario__submit formulario__submit--login" value="Enviar instrucciones">
  </form>

  <div class="actions">
    <a href="/login" class="actions__link">¿Ya tienes cuenta? Iniciar sesión</a>
    <a href="/register" class="actions__link">¿Aún no tienes cuenta? Obtener una</a>
  </div>
</main>