<fieldset class="formulario__fieldset">
  <legend class="formulario__legend">Informacion de la herramienta</legend>

    <div class="formulario__field">
    <label class="formulario__label" for="first_name">Nombre</label>
    <input 
      type="text" 
      name="title" 
      id="title" 
      class="formulario__input"
      placeholder="Nombre de la herramienta"
      value="<?php echo $tool->title ?? ''; ?>"
    >
    </div>

    <div class="formulario__field">
        <label for="description" class="formulario__label">Descripción</label>
        <textarea class="formulario__input" id="description" name="description" placeholder="Ingresar Descripción"
            rows="8"><?php echo $tool->description; ?></textarea>
    </div>

    
    <div class="formulario__field">
    <label class="formulario__label" for="image">Imagen</label>
    <input 
      type="file" 
      name="image" 
      id="image" 
      class="formulario__input formulario__input--file"
    >
    </div>
    <?php if(isset($tool->current_image)) { ?>
        <p class="formulario__text">Imagen actual:</p>
        <div class="formulario__image">
        <picture>
            <source srcset="<?php echo $_ENV['HOST'] . '/img/tools/' . $tool->image; ?>.webp" type="image/webp">
            <source srcset="<?php echo $_ENV['HOST'] . '/img/tools/' . $tool->image; ?>.png" type="image/png">
            <img src="<?php echo $_ENV['HOST'] . '/img/tools/' . $tool->image; ?>.png" alt="Imagen de expositor">
        </picture>
        </div>
    <?php } ?>
   
    <div class="formulario__field">
    <label class="formulario__label" for="first_name">Link</label>
    <input 
      type="text" 
      name="link" 
      id="link" 
      class="formulario__input"
      placeholder="Ingrese el link"
      value="<?php echo $tool->link ?? ''; ?>"
    >
    </div>

</fieldset>