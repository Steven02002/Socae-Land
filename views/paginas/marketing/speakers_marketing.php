<section class="speakers">
    <h2 class="speakers__heading">Expositores</h2>
    <p class="speakers__description">Conoce a nuestros expertos</p>
    <?php if (!empty($speakers)) { ?>
    <div class="speakers__grid">
      <?php foreach($speakers as $speaker) {?>
        <div <?php aos_animation(); ?> class="speaker">
          <picture>
            <source srcset="img/speakers/<?php echo $speaker->image; ?>.webp" type="image/webp">
            <source srcset="img/speakers/<?php echo $speaker->image; ?>.png" type="image/png">
            <img class="speaker__imagen" loading="lazy" width="200" height="300" src="img/speakers/<?php echo $speaker->image; ?>.png" alt="Imagen de expositor">
          </picture>
        

          <div class="speaker__information">
            <h4 class="speaker__name">
              <?php echo $speaker->first_name . ' ' . $speaker->last_name; ?>
            </h4>

            <p class="speaker__ubication">
              <?php echo $speaker->city . ', ' . $speaker->country; ?>
            </p>

            <nav class="speaker-sociales">
              <?php
                $social_medias = json_decode($speaker->social_medias);
              ?>
              <?php if(!empty($social_medias->facebook)) { ?>
                <a class="speaker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $social_medias->facebook; ?>">
                  <span class="speaker-sociales__ocultar">Facebook</span>
                </a>
              <?php } ?>
              <?php if(!empty($social_medias->twitter)) { ?>
                <a class="speaker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $social_medias->twitter; ?>">
                  <span class="speaker-sociales__ocultar">Twitter</span>
                </a>
              <?php } ?>

              <?php if(!empty($social_medias->youtube)) { ?>
                <a class="speaker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $social_medias->youtube; ?>">
                  <span class="speaker-sociales__ocultar">YouTube</span>
                </a>
              <?php } ?>
              
              <?php if(!empty($social_medias->instagram)) { ?>
                <a class="speaker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $social_medias->instagram; ?>">
                  <span class="speaker-sociales__ocultar">Instagram</span>
                </a>
              <?php } ?>

              <?php if(!empty($social_medias->tiktok)) { ?>
                <a class="speaker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $social_medias->tiktok; ?>">
                  <span class="speaker-sociales__ocultar">Tiktok</span>
                </a>
              <?php } ?>
              
              <?php if(!empty($social_medias->github)) { ?>
                <a class="speaker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $social_medias->github; ?>">
                  <span class="speaker-sociales__ocultar">GitHub</span>
                </a>
              <?php } ?>
            </nav>

            <ul class="speaker__list-skills">
              <?php 
                $tags = explode(',', $speaker->tags);
                foreach($tags as $tag) { ?>
                <li class="speaker__skill"> <?php echo $tag; ?> </li>
              <?php } ?>
            </ul>
          </div>
        </div>
      <?php }?>
    </div>
    <?php } else { ?>
      <p class="text-center">No hay noticias registradas aún</p>
    <?php } ?>
</section>