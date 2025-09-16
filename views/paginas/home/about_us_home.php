<section class="pageabout">
  <?php foreach ($contents['About_us'] as $content) { ?>
    <div class="contentabout">
      <img src="img/content/<?php echo $content->image1; ?>.png" alt="Imagen de expositor"></img>
      <div class="textabout">
        <h1>
            <?php echo $content->title; ?>
        </h1>
        <p>
          <?php echo $content->description; ?>
        </p>
      </div>
    </div>
  <?php } ?>
</section>