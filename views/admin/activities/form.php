<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información de la actividad</legend>

    <div class="formulario__field">
        <label class="formulario__label" for="description">Descripción</label>
        <input type="text" name="description" id="description" class="formulario__input"
            placeholder="Descripcion de la actividad" value="<?php echo $activity->description ?? ''; ?>">
    </div>

    <div class="formulario__field">
        <label class="formulario__label" for="image">Imágen</label>
        <input type="file" name="image" id="image" class="formulario__input formulario__input--file">
    </div>
    <div>
        <?php if (isset($activity->current_image)) { ?>
            <p class="formulario__text">Imagen actual:</p>
            <div class="formulario__image">
                <picture>
                    <source srcset="<?php echo $_ENV['HOST'] . '/img/activities/' . $activity->image; ?>.webp"
                        type="image/webp">
                    <source srcset="<?php echo $_ENV['HOST'] . '/img/activities/' . $activity->image; ?>.png" type="image/png">
                    <img src="<?php echo $_ENV['HOST'] . '/img/activities/' . $activity->image; ?>.png"
                        alt="Imagen de la actividad">
                </picture>
            </div>
        <?php } ?>
    </div>

</fieldset>