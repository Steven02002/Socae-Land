<section class="speakers">
    <h2 class="speakers__heading">Miembros</h2>
    <p class="speakers__description">Conoce a los miembros de la sociedad científica</p>
    <?php if (!empty($members)) { ?>
    <div class="speakers__grid">
      <?php foreach($members as $member) {?>
        <div <?php aos_animation(); ?> class="speaker">
          <picture>
            <source srcset="img/members/<?php echo $member->image; ?>.webp" type="image/webp">
            <source srcset="img/members/<?php echo $member->image; ?>.png" type="image/png">
            <img class="speaker__imagen" loading="lazy" width="200" height="300" src="img/members/<?php echo $member->image; ?>.png" alt="Imagen de miembro">
          </picture>
        

          <div class="speaker__information members">
            <h4 class="speaker__name">
              <?php echo $member->first_name . ' ' . $member->last_name; ?>
            </h4>

            <p class="speaker__ubication">
              <?php echo $member->area->name_area; ?>
            </p>

            <nav class="speaker-sociales nav-members">
              <?php
                $social_medias = json_decode($member->social_medias);
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
          </div>
        </div>
      <?php }?>
    </div>
    <?php } else { ?>
      <p class="text-center">No hay miembros registrados aún</p>
    <?php } ?>
</section>