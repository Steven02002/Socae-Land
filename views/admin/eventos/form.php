<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Evento</legend>

    <div class="formulario__field">
        <label for="event_name" class="formulario__label">Nombre Evento</label>
        <input type="text" class="formulario__input" id="event_name" name="event_name" placeholder="Nombre Evento"
            value="<?php echo $event->event_name; ?>">
    </div>
    <div class="formulario__field">
        <label for="description" class="formulario__label">Descripción</label>
        <textarea class="formulario__input" id="description" name="description" placeholder="Descripción Evento"
            rows="8"><?php echo $event->description; ?></textarea>
    </div>
    <div class="formulario__field">
        <label for="category" class="formulario__label">Categoría o Tipo de Evento</label>
        <select class="formulario__select" id="category" name="category_id">

            <option value="">- Seleccionar -</option>
            <?php foreach ($categories as $category) { ?>
                <option <?php echo ($event->category_id === $category->id) ? 'selected' : '' ?>
                    value="<?php echo $category->id; ?>"> <?php echo $category->category_name ?> </option>
            <?php } ?>
        </select>
    </div>

    <div class="formulario__field">
        <label for="category" class="formulario__label">Selecciona el Día</label>
        <input type="date" class="formulario__input" id="date" name="date" min="<?php echo $dateNow = date("Y-m-d"); ?>"
            value="<?php echo $event->date; ?>">
    </div>

    <div class="formulario__field">
        <label class="formulario__label">Selecciona la Hora</label>
        <input type="time" class="formulario__input" id="hour" name="hour" value="<?php echo $event->hour; ?>">
    </div>
    <fieldset class="formulario__fieldset">
        <Legend class="formulario__legend">Información Extra</legend>

        <div class="formulario__field">
            <label for="speakers" class="formulario__label">Expositor</label>
            <input type="text" class="formulario__input" id="speakers" placeholder="Buscar Expositor" />
            <ul id="list-speakers" class="list-speakers"></ul>

            <input type="hidden" name="speaker_id" value="<?php echo $event->speaker_id; ?>" />
        </div>
        <div class="formulario__field">
            <label for="location" class="formulario__label">Ingrese la ubicación</label>
            <input type="text" class="formulario__input" id="location" name="location" placeholder="Ingrese la ubicación"
                value="<?php echo $event->location; ?>">
        </div>
        <div class="formulario__field">
            <label for="link" class="formulario__label">Ingrese el link de forms</label>
            <input type="text" class="formulario__input" id="link" name="link" placeholder="Ingrese el link"
                value="<?php echo $event->link; ?>">
        </div>
    </fieldset>

</fieldset>