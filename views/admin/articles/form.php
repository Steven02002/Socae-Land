<fieldset class="formulario__fieldset">
  <legend class="formulario__legend">Información</legend>

  <div class="formulario__field">
    <label class="formulario__label" for="title_article">Título</label>
    <input 
      type="text" 
      name="title_article" 
      id="title_article" 
      class="formulario__input"
      placeholder="Ingrese el título del artículo"
      value="<?php echo $article->title_article ?? ''; ?>"
    >
  </div>

  <div class="formulario__field">
        <label for="description_article" class="formulario__label">Descripción</label>
        <textarea
            class="formulario__input"
            id="description_article"
            name="description_article"
            placeholder="Ingrese la descripción del artículo"
            rows="8"
        ><?php echo $article->description_article; ?></textarea>
  </div>

  <div class="formulario__field">
    <label class="formulario__label" for="url_article">Enlace</label>
    <input 
      type="text" 
      name="url_article" 
      id="url_article" 
      class="formulario__input"
      placeholder="Ingrese el enlace del artículo"
      value="<?php echo $article->url_article ?? ''; ?>"
    >
  </div>

  
</fieldset>
