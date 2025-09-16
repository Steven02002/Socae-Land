<main class="agend">
    <h2 class="agend__heading">Eventos Disponibles</h2>
    <p class="agend__description">Talleres y Conferencias dictados por expertos</p>
    <?php if (!empty($events['conferences'])) { ?>
        <div class="events">
            <h3 class="events__heading">Conferencias</h3>

            <div class="events__list slider swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($events['conferences'] as $event) { ?>
                        <?php include __DIR__ . '/../../templates/event.php'; ?>
                    <?php } ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    <?php } else { ?>
        <p class="text-center">No hay conferencias registradas aún</p>
    <?php } ?>
    <?php if (!empty($events['workshops'])) { ?>
        <div class="events events--workshops">
            <h3 class="events__heading">Cursos</h3>

            <div class="events__list slider swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($events['workshops'] as $event) { ?>
                        <?php include __DIR__ . '/../../templates/event.php'; ?>
                    <?php } ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    <?php } else { ?>
        <p class="text-center">No hay cursos registradas aún</p>
    <?php } ?>
</main>