<section class="materials">
    <h2 class="materials__heading">Materiales recomendados</h2>
    <p class="speakers__description">Descubre una fuente de conocimiento: Recomendaciones seleccionadas para tu crecimiento personal y profesional</p>
    <?php if (!empty($materials)) { ?>
    <div class="materials__grid">
      <?php foreach($materials as $material) {?>
        <div <?php aos_animation(); ?> class="material">
          <picture>
            <source srcset="img/materials/<?php echo $material->image; ?>.webp" type="image/webp">
            <source srcset="img/materials/<?php echo $material->image; ?>.png" type="image/png">
            <img class="material__imagen" loading="lazy" width="200" height="300" src="img/materials/<?php echo $material->image; ?>.png" alt="Imagen de miembro">
          </picture>
        

          <div class="material__content">
            <a rel="noopener noreferrer" target="_blank" href="<?php echo $material->url_material; ?>">
              <i class="fa-solid fa-arrow-right material__button"></i>
            </a>
          </div>
        </div>
      <?php }?>
    </div>
    <?php } else { ?>
      <p class="text-center">No hay noticias registradas aún</p>
    <?php } ?>
</section>