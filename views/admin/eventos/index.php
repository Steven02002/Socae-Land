<h2 class="dashboard__heading"><?php echo $title; ?></h2>

<div class="dashboard__container-button">
    <a class="dashboard__button" href="/admin/eventos/create">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir Evento
    </a>
</div>

<div class="dashboard__container">
  <?php if(!empty($events)) { ?>
    <table class="table">
      <thead class="table__thead">
        <tr>
          <th scope="col" class="table__th">Evento</th>
          <th scope="col" class="table__th">Categoría</th>
          <th scope="col" class="table__th">Fecha</th>
          <th scope="col" class="table__th">Expositor</th>
          <th scope="col" class="table__th"></th>
        </tr>
      </thead>
      <tbody class="table__tbody">
        <?php foreach($events as $event) { ?>
          <tr class="table__tr">
            <td class="table__td">
              <?php echo $event->event_name; ?>
            </td>
            <td class="table__td">
              <?php echo $event->category->category_name; ?>
            </td>
            <td class="table__td">
              <?php echo $event->date; ?>
            </td>
            <td class="table__td">
              <?php echo $event->speaker->first_name . " ". $event->speaker->last_name; ?>
            </td>
            <td class="table__td--actions">
              <a class="table__action table__action--edit" href="/admin/eventos/edit?id=<?php echo $event->id; ?>">
                <i class="fa-solid fa-pencil"></i>
                Editar
              </a>

              <form method="POST" action="/admin/eventos/delete" class="table__form" id="deleteForm_<?php echo $event->id; ?>">
                <input type="hidden" name="id" value="<?php echo $event->id; ?>">
                <button class="table__action table__action--delete" type="button" onclick="confirmDelete(<?php echo $event->id; ?>)">
                  <i class="fa-solid fa-circle-xmark"></i>
                  Eliminar
                </button>
              </form>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php } else  { ?>
    <p class="text-center">No hay eventos registrados</p>
  <?php } ?>
</div>

<?php
    echo $pagination;
?>