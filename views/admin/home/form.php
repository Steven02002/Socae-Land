<fieldset class="formulario__fieldset">
    
    <div class="formulario__field">
        <label class="formulario__label" for="first_name">Título</label>
        <input 
        type="text" 
        name="title" 
        id="title" 
        class="formulario__input"
        value="<?php echo $content->title ?? ''; ?>">
    </div>
    <div class="formulario__field">
        <label for="event_name" class="formulario__label">Información</label>
        <textarea
            class="formulario__input"
            rows="8"
            id="description"
            name="description"
            ><?php echo $content->description; ?></textarea>
    </div>
    <div class="formulario__field">
        <label class="formulario__label" for="image1">Imagen</label>
        <input 
        type="file" 
        name="image1" 
        id="image1" 
        class="formulario__input formulario__input--file"
        >
    </div>
    <?php if(isset($content->current_image)) { ?>
        <p class="formulario__text">Imagen actual:</p>
        <div class="formulario__image">
        <picture>
            <source srcset="<?php echo $_ENV['HOST'] . '/img/content/' . $content->image1; ?>.webp" type="image/webp">
            <source srcset="<?php echo $_ENV['HOST'] . '/img/content/' . $content->image1; ?>.png" type="image/png">
            <img src="<?php echo $_ENV['HOST'] . '/img/content/' . $content->image1; ?>.png" alt="Imagen de contenido">
        </picture>
        </div>
    <?php } ?>
</fieldset>