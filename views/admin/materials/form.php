<fieldset class="formulario__fieldset">
  <legend class="formulario__legend">Información</legend>

  <div class="formulario__field">
    <label class="formulario__label" for="name_material">Nombre</label>
    <input 
      type="text" 
      name="name_material" 
      id="name_material" 
      class="formulario__input"
      placeholder="Ingrese el nombre del material"
      value="<?php echo $material->name_material ?? ''; ?>"
    >
  </div>

  <div class="formulario__field">
    <label class="formulario__label" for="url_material">Enlace</label>
    <input 
      type="text" 
      name="url_material" 
      id="url_material" 
      class="formulario__input"
      placeholder="Ingrese el enlace del material"
      value="<?php echo $material->url_material ?? ''; ?>"
    >
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
  <?php if(isset($material->current_image)) { ?>
    <p class="formulario__text">Imagen actual:</p>
    <div class="formulario__image">
      <picture>
        <source srcset="<?php echo $_ENV['HOST'] . '/img/materials/' . $material->image; ?>.webp" type="image/webp">
        <source srcset="<?php echo $_ENV['HOST'] . '/img/materials/' . $material->image; ?>.png" type="image/png">
        <img src="<?php echo $_ENV['HOST'] . '/img/materials/' . $material->image; ?>.png" alt="Imagen de miembro">
      </picture>
    </div>
  <?php } ?>

</fieldset>
