<h2 class="dashboard__heading"><?php echo $title; ?></h2>
<div class="dashboard__container-button">
  <a class="dashboard__button" href="/admin/articles">
    <i class="fa-solid fa-circle-arrow-left"></i>
    Volver
  </a>
</div>

<div class="dashboard__formulario">
  <?php
    include_once __DIR__ . './../../templates/alerts.php';
  ?>

  <form method="POST" class="formulario">
    <?php include_once __DIR__ . '/form.php' ?>

    <input class="formulario__submit formulario__submit--registrar" type="submit" value="Actualizar artículo">
  </form>
</div>