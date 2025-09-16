<main class="auth">
  <h2 class="auth__heading"><?php echo $title ?></h2>
  <p class="auth__text">Registrarse</p>

  <?php
    require_once __DIR__ . '/../templates/alerts.php'
  ?>

  <form method="POST" action="/register" class="formulario">
    <div class="formulario__field">
      <label for="first_name" class="formulario__label">Nombre</label>
      <input 
        type="text"
        class="formulario__input"
        placeholder = "Tu nombre"
        id = "first_name"
        name = "first_name"
        value= "<?php echo $usuario->first_name; ?>"
      >
    </div>
    
    <div class="formulario__field">
      <label for="last_name" class="formulario__label">Apellido</label>
      <input 
        type="text"
        class="formulario__input"
        placeholder = "Tu apellido"
        id = "last_name"
        name = "last_name"
        value= "<?php echo $usuario->last_name; ?>"
      >
    </div>

    <div class="formulario__field">
      <label for="email" class="formulario__label">Email</label>
      <input 
        type="text"
        class="formulario__input"
        placeholder = "Tu email"
        id = "email"
        name = "email"
        value= "<?php echo $usuario->email; ?>"
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

    <div class="formulario__field">
      <label for="password2" class="formulario__label">Repetir contraseña</label>
      <input 
        type="password"
        class="formulario__input"
        placeholder = "Repite tu contraseña"
        id = "password2"
        name = "password2"
      >
    </div>

    <input type="submit" class="formulario__submit formulario__submit--login" value="Crear cuenta">
  </form>

  <div class="actions">
    <a href="/login" class="actions__link">¿Ya tienes cuenta? Iniciar sesión</a>
    <a href="/forget" class="actions__link">¿Olvidaste tu contraseña?</a>
  </div>
</main>

