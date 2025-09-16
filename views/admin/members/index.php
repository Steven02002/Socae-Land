<h2 class="dashboard__heading"><?php echo $title; ?></h2>

<div class="dashboard__container-button">
  <a class="dashboard__button" href="/admin/members/create">
    <i class="fa-solid fa-circle-plus"></i>
    Añadir miembro
  </a>
</div>

<div class="dashboard__container">
  <?php if(!empty($members)) { ?>
    <table class="table">
      <thead class="table__thead">
        <tr>
          <th scope="col" class="table__th">Nombre</th>
          <th scope="col" class="table__th">Descripción</th>
          <th scope="col" class="table__th"></th>
        </tr>
      </thead>
      <tbody class="table__tbody">
        <?php foreach($members as $member) { ?>
          <tr class="table__tr">
            <td class="table__td">
              <?php echo $member->first_name . " " . $member-> last_name; ?>
            </td>
            <td class="table__td">
              <?php echo $member->area->name_area; ?>
            </td>
            <td class="table__td--actions">
              <a class="table__action table__action--edit" href="/admin/members/edit?id=<?php echo $member->id; ?>">
                <i class="fa-solid fa-user-pen"></i>
                Editar
              </a>

              <form method="POST" action="/admin/members/delete" class="table__formulario" id="deleteForm_<?php echo $member->id; ?>">
                <input type="hidden" name="id" value="<?php echo $member->id; ?>">
                <button class="table__action table__action--delete" type="button" onclick="confirmDelete(<?php echo $member->id; ?>)">
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
    <p class="text-center">No hay miembros registrados aún</p>
  <?php } ?>
</div>

<?php
  echo $pagination;
?>