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
      value="<?php echo $member->first_name ?? ''; ?>"
    >
  </div>

  <div class="formulario__field">
    <label class="formulario__label" for="last_name">Apellido</label>
    <input 
      type="text" 
      name="last_name" 
      id="last_name" 
      class="formulario__input"
      placeholder="Apellido del miembro"
      value="<?php echo $member->last_name ?? ''; ?>"
    >
  </div>

  <div class="formulario__field">
    <label for="category" class="formulario__label">Área</label>
    <select
        class="formulario__select"
        id="area"
        name="area_id"
    >
        
        <option value="">- Seleccionar -</option>
        <?php foreach ($areas as $area) { ?>
            <option <?php echo ($member->area_id === $area->id) ? 'selected' : '' ?> value="<?php echo $area->id; ?>"> <?php echo $area->name_area?> </option>
        <?php } ?>
    </select>
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
  <?php if(isset($member->current_image)) { ?>
    <p class="formulario__text">Imagen actual:</p>
    <div class="formulario__image">
      <picture>
        <source srcset="<?php echo $_ENV['HOST'] . '/img/members/' . $member->image; ?>.webp" type="image/webp">
        <source srcset="<?php echo $_ENV['HOST'] . '/img/members/' . $member->image; ?>.png" type="image/png">
        <img src="<?php echo $_ENV['HOST'] . '/img/members/' . $member->image; ?>.png" alt="Imagen de miembro">
      </picture>
    </div>
  <?php } ?>

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