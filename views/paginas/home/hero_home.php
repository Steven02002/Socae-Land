<div class="descriptionhomebg">
  <section class="descriptionhome descriptionsection">
    <?php foreach ($contents['Description'] as $content) { ?>

      <div class="decriptioncontent">
        <h1 class="descriptiontitle">
          <?php echo $content->title; ?>
        </h1>
        <p class="descriptiontext">
          <?php echo $content->description; ?>
        </p>
      </div>
      <div class="descriptionimage">
        <img src="img/content/<?php echo $content->image1; ?>.png" alt="Imagen"></img>
      </div>
    <?php } ?>
  </section>
</div>