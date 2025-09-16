<div class="event swiper-slide">
    <p class="event__hour">Hora: <?php echo $event->hour ?></p>
    <div class="event__information">
        <a href="<?php echo $event->link; ?>" target="_blank">
            <h4 class="event__name"><?php echo $event->event_name; ?></h4>

            <p class="event__introduction"><?php echo $event->description; ?></p>

            <p class="event__day">Día: <?php echo $formattedDate ?></p>
            <p class="event__location">Ubicacion: <?php echo $event->location; ?></p>
        </a>
        <div class="event__author-info">
            <picture>
                <source srcset="img/speakers/<?php echo $event->speaker->image; ?>.webp" type="image/webp">
                <source srcset="img/speakers/<?php echo $event->speaker->image; ?>.png" type="image/png">
                <img class="event__image-author" loading="lazy" width="200" height="300" src="img/speakers/<?php echo $event->speaker->image; ?>.png" alt="Imagen de expositor">
            </picture>

            <p class="event__author-name">
                <?php echo $event->speaker->first_name . " " . $event->speaker->last_name; ?>
            </p>
        </div>
    </div>
</div>
