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
            <td><?= $cosa->getId() ?></td>
            <td><?= $cosa->getNombre() ?></td>
            <td><?= $cosa->getCantidad() ?></td>
            <td>
                <?php foreach ($cosa->getTags() as $tag) :
                    echo $tag->getNombre() . "<br>";
                endforeach ?>
            </td>
            <td> 
                <form action="<?= base_url('/Carga/eliminarCosa'); ?>" method="post">
                    <input type="hidden" name="id" value="<?= $cosa->getId(); ?>">
                    <input type="submit" class="delete-btn" data-id="<?= $cosa->getId() ?>" value="Eliminar">
                </form>
                <button class="edit-btn">
                    <a href="/EdicionCosa/index/<?= $cosa->getId() ?>">Editar</a>
                </button>
            </td> 
        </tr>
    <?php endforeach ?>
</tbody>
