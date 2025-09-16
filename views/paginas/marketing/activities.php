<main class="agend">
    <h2 class="agend__heading">Actividades realizadas</h2>
<!-- Slider main container -->
    <?php if (!empty($activities)) { ?>
    <div class="events">
        <div class="swiper-container">
            <!-- Additional required wrapper -->
            
            <div class="swiper-wrapper sizePhone">
                <!-- Slides -->
                <?php foreach($activity['activityCapture'] as $activities ) { ?>
                    <?php include __DIR__ . '/../../templates/activities.php'; ?>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php } else { ?>
      <p class="text-center">No hay actividades registradas aún</p>
    <?php } ?>
</main>