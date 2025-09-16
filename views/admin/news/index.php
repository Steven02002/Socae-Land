<h2 class="dashboard__heading">
    <?php echo $title; ?>
</h2>

<div class="dashboard__container-button">
    <a class="dashboard__button" href="/admin/news/create">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir noticia
    </a>
</div>

<div class="dashboard__container">
    <?php if (!empty($news)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Título</th>
                    <th scope="col" class="table__th">Descripción</th>
                    <th scope="col" class="table__th">Sección</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach ($news as $new) { ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $new->title;?>
                        </td>
                        <td class="table__td">
                            <?php echo $new->description; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $new->category->category_name; ?>
                        </td>
                        <td class="table__td--actions">
                            <a class="table__action table__action--edit"
                                href="/admin/news/edit?id=<?php echo $new->id; ?>">
                                <i class="fa-solid fa-user-pen"></i>
                                Editar
                            </a>

                            <form method="POST" action="/admin/news/delete" class="table__formulario" id="deleteForm_<?php echo $new->id; ?>">
                                <input type="hidden" name="id" value="<?php echo $new->id; ?>">
                                <button class="table__action table__action--delete" type="button" onclick="confirmDelete(<?php echo $new->id; ?>)">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center">No hay noticias registradas aún</p>
    <?php } ?>
</div>

<?php
echo $pagination;
?>