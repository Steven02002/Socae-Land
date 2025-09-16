<main class="agend">
    <h2 class="agend__heading">Noticias</h2>
    <p class="speakers__description">Actualidad informativa: Mantente al tanto de los últimos acontecimientos</p>
    <div class="events">
        <div class="events__list slider swiper">
            <?php if (!empty($news)) { ?>
              <div class="swiper-wrapper">
                  <?php foreach($news['NewsCapture'] as $new ) { ?>
                      <?php include __DIR__ . '/../../templates/news.php'; ?>
                  <?php } ?>
              </div>
            <?php } else { ?>
              <p class="text-center">No hay noticias registradas aún</p>
            <?php } ?>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</main>