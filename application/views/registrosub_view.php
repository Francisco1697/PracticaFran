<thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Tags</th>
                <th>Opciones</th>
            </tr>
</thead>
<tbody>
    <?php foreach ($cosas as $cosa) : ?>
        <tr>
            <td><?= $cosa->id ?></td>
            <td><?= $cosa->nombre ?></td>
            <td><?= $cosa->cantidad ?></td>
            <td>
            <? foreach ($cosa->tags as $tag) {
                echo $tag->nombre . "<br>";
            }?>
            </td>
            <td> 
                <form action="<?= base_url('/Carga/eliminarCosa'); ?>" method="post">
                    <input type="hidden" name="id" value="<?= $cosa->id; ?>">
                    <input type="submit" class="delete-btn" data-id="<?= $cosa->id ?>" value="Eliminar">
                </form>
                <button class="edit-btn">
                    <a href="/EdicionCosa/index/<?= $cosa->id ?>">Editar</a>
                </button>
            </td> 
        </tr>
    <?php endforeach ?>
</tbody>
