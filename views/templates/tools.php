<article class="component positionImage">
    <img class="component__background" src="img/tools/<?php echo $tool->image; ?>.png" alt="Imagen"></img>
    <div class="component__content | flow">
        <div class="component__content--container | flow">
            <h2 class="component__title"><?php echo $tool->title; ?></h2>
            <p class="component__description">
                <?php echo $tool->description; ?>
            </p>
        </div>
        <button class="component__button" onclick="window.open('<?php echo $tool->link; ?>', '_blank')">Ver Más</button>
    </div>
</article>