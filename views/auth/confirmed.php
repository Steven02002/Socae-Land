<main class="auth">
  <h2 class="auth__heading"><?php echo $title ?></h2>
  <p class="auth__text">Tu cuenta</p>
  <?php
    require_once __DIR__ . '/../templates/alerts.php'
  ?>

  <?php if (isset($alerts['exito'])) {?>
    <div class="actions--center">
      <a href="/login" class="actions__link">Iniciar sesión</a>
    </div>
  <?php } ?>
</main>