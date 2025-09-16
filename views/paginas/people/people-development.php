<?php
  include_once __DIR__ . '/description_people.php';
?>
<section class="resume">
  <div class="resume__grid">
    <div <?php aos_animation(); ?> class="resume__block">
      <p class="resume__text resume__text--number" ><?php echo $innovacion; ?></p>
      <p class="resume__text">Innovación</p>
    </div>

    <div <?php aos_animation(); ?> class="resume__block">
      <p class="resume__text resume__text--number" ><?php echo $marketing; ?></p>
      <p class="resume__text">Marketing</p>
    </div>

    <div <?php aos_animation(); ?> class="resume__block">
      <p class="resume__text resume__text--number" ><?php echo $peopleDevelopment; ?></p>
      <p class="resume__text">People Development</p>
    </div>

    <div <?php aos_animation(); ?> class="resume__block">
      <p class="resume__text resume__text--number" ><?php echo $invCientifica; ?></p>
      <p class="resume__text">Investigación Científica</p>
    </div>
  </div>
</section>

<?php
  include_once __DIR__ . '/members.php';
?>