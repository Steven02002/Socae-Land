<h2 class="dashboard__heading">
    <?php echo $title; ?>
</h2>

<div class="dashboard__container-button">
    <a class="dashboard__button" href="/admin/activities/create">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir actividad
    </a>
</div>

<div class="dashboard__container">
    <?php if (!empty($activities)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Descripción</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach ($activities as $activity) { ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $activity->description; ?>
                        </td>
                        <td class="table__td--actions">
                            <a class="table__action table__action--edit"
                                href="/admin/activities/edit?id=<?php echo $activity->id; ?>">
                                <i class="fa-solid fa-user-pen"></i>
                                Editar
                            </a>

                            <form method="POST" action="/admin/activities/delete" class="table__formulario" id="deleteForm_<?php echo $activity->id; ?>">
                                <input type="hidden" name="id" value="<?php echo $activity->id; ?>">
                                <button class="table__action table__action--delete" type="button" onclick="confirmDelete(<?php echo $activity->id; ?>)">
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
        <p class="text-center">No hay actividades aún</p>
    <?php } ?>
</div>

<?php
echo $pagination;
?>