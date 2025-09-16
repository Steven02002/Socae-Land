<h2 class="dashboard__heading"><?php echo $title; ?></h2>

<div class="dashboard__container-button">
  <a class="dashboard__button" href="/admin/materials/create">
    <i class="fa-solid fa-circle-plus"></i>
    Añadir material
  </a>
</div>

<div class="dashboard__container">
  <?php if(!empty($materials)) { ?>
    <table class="table">
      <thead class="table__thead">
        <tr>
          <th scope="col" class="table__th">Nombre del material</th>
          <th scope="col" class="table__th"></th>
        </tr>
      </thead>
      <tbody class="table__tbody">
        <?php foreach($materials as $material) { ?>
          <tr class="table__tr">
            <td class="table__td">
              <?php echo $material->name_material; ?>
            </td>
            <td class="table__td--actions">
              <a class="table__action table__action--edit" href="/admin/materials/edit?id=<?php echo $material->id; ?>">
                <i class="fa-solid fa-user-pen"></i>
                Editar
              </a>
              <form method="POST" action="/admin/materials/delete" class="table__formulario" id="deleteForm_<?php echo $material->id; ?>">
                <input type="hidden" name="id" value="<?php echo $material->id; ?>">
                <button class="table__action table__action--delete" type="button" onclick="confirmDelete(<?php echo $material->id; ?>)">
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
    <p class="text-center">No hay materiales registrados aún</p>
  <?php } ?>
</div>
