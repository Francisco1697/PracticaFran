<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Registro de cosas</title>
    <link rel="stylesheet" href="<?= base_url('application/styles/styles.css') ?>">
</head>
<body>

    <form method="get" class="search-form">
        <input type="search" name="search" placeholder="Buscar una cosa" value="<?= $this->input->get('search') ?>" autofocus>
        <button type="submit">Buscar</button>
        <button class="reset-btn"><a href="Registro">Reiniciar</a></button>
        <button class="back-btn"><a href="/Registro/cerrar_sesion">Cerrar sesión</a></button>
    </form>

    <div class="action-buttons">
        <button class="add-btn"><a href="/Carga">Agregar cosa</a></button>
        <button class="edit-tags-btn"><a href="/EdicionTags">Editar tags</a></button>
    </div>

    <table class="things-table">
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
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const deleteButtons = document.querySelectorAll('.delete-btn');

                    deleteButtons.forEach(button => {
                        button.addEventListener('click', function(e) {
                            e.preventDefault();

                            const id = this.getAttribute('data-id');
                            const confirmation = confirm('¿Estás seguro de que quieres eliminar este registro?');

                            if (confirmation) {
                                // Envía una solicitud AJAX al servidor para eliminar el registro
                                const xhr = new XMLHttpRequest();
                                xhr.open('POST', this.parentElement.action, true);
                                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                xhr.onreadystatechange = function() {
                                    if (xhr.readyState === XMLHttpRequest.DONE) {
                                        if (xhr.status === 200) {
                                            // Elimina la fila de la tabla de manera reactiva
                                            const tr = button.closest('tr');
                                            tr.parentNode.removeChild(tr);
                                        } else {
                                            alert('Ha ocurrido un error al eliminar el registro.');
                                        }
                                    }
                                };
                                xhr.send('id=' + encodeURIComponent(id));
                            }
                        });
                    });
                });
            </script>
        </tbody>
    </table>

</body>
</html>
