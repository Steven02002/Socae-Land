<header>
  <div class="barra">
    <div class="barra__contenido">
      <a href="/home" class="barra__logo"></a>
      <nav class="navegacion">
        <a href="/home" class="navegacion__enlace <?php echo pagina_actual('/home') ? 'navegation__link--actual' : ''; ?>" >Inicio</a>
        <a href="/people-development" class="navegacion__enlace <?php echo pagina_actual('/people-development') ? 'navegation__link--actual' : ''; ?>">People Development</a>
        <a href="/marketing" class="navegacion__enlace <?php echo pagina_actual('/marketing') ? 'navegation__link--actual' : ''; ?>">Marketing</a>
        <a href="/innovation" class="navegacion__enlace <?php echo pagina_actual('/innovation') ? 'navegation__link--actual' : ''; ?>">Innovación</a>
        <a href="/investigation-Cientific" class="navegacion__enlace <?php echo pagina_actual('/investigation-Cientific') ? 'navegation__link--actual' : ''; ?>">Investigación científica</a>
      </nav>
      <a href="#" class="contact-button">Contáctanos</a>
    </div>
  </div>
</header>