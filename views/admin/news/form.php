<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información de la actividad</legend>

    <div class="formulario__field">
        <label for="event_name" class="formulario__label">Título Noticia</label>
        <input type="text" class="formulario__input" id="title" name="title" placeholder="Ingresar Titulo"
            value="<?php echo $new->title; ?>">
    </div>
    <div class="formulario__field">
        <label for="description" class="formulario__label">Descripción</label>
        <textarea class="formulario__input" id="description" name="description" placeholder="Ingresar Descripción"
            rows="8"><?php echo $new->description; ?></textarea>
    </div>

    <div class="formulario__field">
        <label for="category" class="formulario__label">Sección de la noticia</label>
        <select
            class="formulario__select"
            id="newsCategory"
            name="category_id"
        >
            <option value="">- Seleccionar -</option>
            <?php foreach ($newsCategory as $newsCat) { ?>
                <option <?php echo ($new->category_id === $newsCat->id) ? 'selected' : '' ?> value="<?php echo $newsCat->id; ?>"> <?php echo $newsCat->category_name?> </option>
            <?php } ?>
        </select>
    </div>

    <div class="formulario__field">
        <label class="formulario__label" for="image">Imagen</label>
        <input type="file" name="image" id="image" class="formulario__input formulario__input--file">
    </div>
    
    <?php if (isset($new->current_image)) { ?>
        <p class="formulario__text">Imagen actual:</p>
        <div class="formulario__image">
            <picture>
                <source srcset="<?php echo $_ENV['HOST'] . '/img/news/' . $new->image; ?>.webp" type="image/webp">
                <source srcset="<?php echo $_ENV['HOST'] . '/img/news/' . $new->image; ?>.png" type="image/png">
                <img src="<?php echo $_ENV['HOST'] . '/img/news/' . $new->image; ?>.png" alt="Imagen de la Noticia">
            </picture>
        </div>
    <?php } ?>

    <div class="formulario__field">
            <label for="link" class="formulario__label">Ingrese el link de la noticia</label>
            <input type="text" class="formulario__input" id="link" name="link" placeholder="Ingrese el link"
                value="<?php echo $new->link; ?>">
        </div>
</fieldset>