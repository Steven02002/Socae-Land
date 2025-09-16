<fieldset class="formulario__fieldset">
  <legend class="formulario__legend">Información personal</legend>

  <div class="formulario__field">
    <label class="formulario__label" for="first_name">Nombre</label>
    <input 
      type="text" 
      name="first_name" 
      id="first_name" 
      class="formulario__input"
      placeholder="Nombre Expositor"
      value="<?php echo $speaker->first_name ?? ''; ?>"
    >
  </div>

  <div class="formulario__field">
    <label class="formulario__label" for="last_name">Apellido</label>
    <input 
      type="text" 
      name="last_name" 
      id="last_name" 
      class="formulario__input"
      placeholder="Apellido Expositor"
      value="<?php echo $speaker->last_name ?? ''; ?>"
    >
  </div>

  <div class="formulario__field">
    <label class="formulario__label" for="city">Ciudad</label>
    <input 
      type="text" 
      name="city" 
      id="city" 
      class="formulario__input"
      placeholder="Ciudad Expositor"
      value="<?php echo $speaker->city ?? ''; ?>"
    >
  </div>

  <div class="formulario__field">
    <label class="formulario__label" for="country">País</label>
    <input 
      type="text" 
      name="country" 
      id="country" 
      class="formulario__input"
      placeholder="País Expositor"
      value="<?php echo $speaker->country ?? ''; ?>"
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
  <?php if(isset($speaker->current_image)) { ?>
    <p class="formulario__text">Imagen actual:</p>
    <div class="formulario__image">
      <picture>
        <source srcset="<?php echo $_ENV['HOST'] . '/img/speakers/' . $speaker->image; ?>.webp" type="image/webp">
        <source srcset="<?php echo $_ENV['HOST'] . '/img/speakers/' . $speaker->image; ?>.png" type="image/png">
        <img src="<?php echo $_ENV['HOST'] . '/img/speakers/' . $speaker->image; ?>.png" alt="Imagen de expositor">
      </picture>
    </div>
  <?php } ?>

</fieldset>

<fieldset class="formulario__fieldset">
  <legend class="formulario__legend">Información extra</legend>

  <div class="formulario__field">
    <label class="formulario__label" for="tags_input">Áreas de experiencia (separadas por coma)</label>
    <input 
      type="text" 
      id="tags_input" 
      class="formulario__input"
      placeholder="Ej. Node.js, PHP, CSS, Laravel, UX / UI"
    >

    <div id="tags" class="formulario__listado"></div>
    <input type="hidden" name="tags" value="<?php echo $speaker->tags ?? ''; ?>">
  </div>
</fieldset>

<fieldset class="formulario__fieldset">
  <legend class="formulario__legend">Redes sociales</legend>

  <div class="formulario__field">
    <div class="formulario__contenedor-icono">
      <div class="formulario__icono">
        <i class="fa-brands fa-facebook"></i>
      </div>
      <input 
        type="text" 
        name="social_medias[facebook]" 
        class="formulario__input--sociales"
        placeholder="Facebook"
        value="<?php echo $social_medias->facebook ?? ''; ?>"
      >
    </div>
  </div>

  <div class="formulario__field">
    <div class="formulario__contenedor-icono">
      <div class="formulario__icono">
        <i class="fa-brands fa-twitter"></i>
      </div>
      <input 
        type="text" 
        name="social_medias[twitter]" 
        class="formulario__input--sociales"
        placeholder="Twitter"
        value="<?php echo $social_medias->twitter ?? ''; ?>"
      >
    </div>
  </div>

  <div class="formulario__field">
    <div class="formulario__contenedor-icono">
      <div class="formulario__icono">
        <i class="fa-brands fa-youtube"></i>
      </div>
      <input 
        type="text" 
        name="social_medias[youtube]" 
        class="formulario__input--sociales"
        placeholder="YouTube"
        value="<?php echo $social_medias->youtube ?? ''; ?>"
      >
    </div>
  </div>

  <div class="formulario__field">
    <div class="formulario__contenedor-icono">
      <div class="formulario__icono">
        <i class="fa-brands fa-instagram"></i>
      </div>
      <input 
        type="text" 
        name="social_medias[instagram]" 
        class="formulario__input--sociales"
        placeholder="Instagram"
        value="<?php echo $social_medias->instagram ?? ''; ?>"
      >
    </div>
  </div>

  <div class="formulario__field">
    <div class="formulario__contenedor-icono">
      <div class="formulario__icono">
        <i class="fa-brands fa-tiktok"></i>
      </div>
      <input 
        type="text" 
        name="social_medias[tiktok]" 
        class="formulario__input--sociales"
        placeholder="Tiktok"
        value="<?php echo $social_medias->tiktok ?? ''; ?>"
      >
    </div>
  </div>

  <div class="formulario__field">
    <div class="formulario__contenedor-icono">
      <div class="formulario__icono">
        <i class="fa-brands fa-github"></i>
      </div>
      <input 
        type="text" 
        name="social_medias[github]" 
        class="formulario__input--sociales"
        placeholder="GitHub"
        value="<?php echo $social_medias->github ?? ''; ?>"
      >
    </div>
  </div>

</fieldset>