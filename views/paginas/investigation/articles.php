<section class="articles">
    <h2 class="articles__heading">Artículos</h2>
    <p class="speakers__description">Explora nuestra biblioteca de conocimiento: Artículos para aprender, descubrir y crecer</p>
    <?php if (!empty($articles)) { ?>
    <div class="articles__grid">
      <?php foreach($articles as $article) {?>

        <div <?php aos_animation(); ?> class="article articles__card">
          <h3 class="article__title"><?php echo $article->title_article; ?></h3>
          <div class="article__content">
            <p><?php echo $article->description_article; ?></p>
          </div>
          <div class="article__button">
            <a class="article__link" rel="noopener noreferrer" target="_blank" href="<?php echo $article->url_article; ?>">
              Ir a artículo
              <i class="fa-solid fa-arrow-right"></i>
            </a>
          </div>
        </div>
      <?php }?>
    </div>
    <?php } else { ?>
      <p class="text-center">No hay noticias registradas aún</p>
    <?php } ?>
</section>