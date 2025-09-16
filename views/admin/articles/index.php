<h2 class="dashboard__heading"><?php echo $title; ?></h2>

<div class="dashboard__container-button">
  <a class="dashboard__button" href="/admin/articles/create">
    <i class="fa-solid fa-circle-plus"></i>
    Añadir artículo
  </a>
</div>

<div class="dashboard__container">
  <?php if(!empty($articles)) { ?>
    <table class="table">
      <thead class="table__thead">
        <tr>
          <th scope="col" class="table__th">Nombre del artículo</th>
          <th scope="col" class="table__th"></th>
        </tr>
      </thead>
      <tbody class="table__tbody">
        <?php foreach($articles as $article) { ?>
          <tr class="table__tr">
            <td class="table__td">
              <?php echo $article->title_article; ?>
            </td>
            <td class="table__td--actions">
              <a class="table__action table__action--edit" href="/admin/articles/edit?id=<?php echo $article->id; ?>">
                <i class="fa-solid fa-user-pen"></i>
                Editar
              </a>
              <form method="POST" action="/admin/articles/delete" class="table__formulario" id="deleteForm_<?php echo $article->id; ?>">
                <input type="hidden" name="id" value="<?php echo $article->id; ?>">
                <button class="table__action table__action--delete" type="button" onclick="confirmDelete(<?php echo $article->id; ?>)">
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
    <p class="text-center">No hay artículos registrados aún</p>
  <?php } ?>
</div>
