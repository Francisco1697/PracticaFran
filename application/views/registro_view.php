<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Registro de cosas</title>
    <link rel="stylesheet" href="<?= base_url('application/styles/styles.css') ?>">
</head>
<body>

    <form method="get" class="search-form" id="search-form">
        <input type="search" name="search" id="search-input" placeholder="Buscar una cosa" value="<?= $this->input->get('search') ?>" autofocus>
        <button type="submit">Buscar</button>
        <button type="button" class="reset-btn" id="reset-btn">Reiniciar</button>
        <button class="back-btn"><a href="/Registro/cerrar_sesion">Cerrar sesión</a></button>
    </form>

    <div class="action-buttons">
        <button class="add-btn"><a href="/Carga">Agregar cosa</a></button>
        <button class="edit-tags-btn"><a href="/EdicionTags">Editar tags</a></button>
    </div>

    <table class="things-table">
        <?php $this->load->view('registrosub_view', $cosas); ?>
    </table>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchForm = document.getElementById('search-form');
            const resetButton = document.getElementById('reset-btn');

            searchForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const searchInput = document.getElementById('search-input').value.trim();

                // Envía una solicitud AJAX al servidor para buscar cosas
                const xhr = new XMLHttpRequest();
                xhr.open('GET', `/Registro/buscar_registros?search=${searchInput}`, true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Actualiza el cuerpo de la tabla con los resultados de la búsqueda
                            document.querySelector('.things-table').innerHTML = xhr.responseText;
                        } else {
                            alert('Ha ocurrido un error al realizar la búsqueda.');
                        }
                    }
                };
                xhr.send();
            });

            resetButton.addEventListener('click', function() {
                // Recarga la página para reiniciar la búsqueda
                location.reload();
            });

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
</body>
</html>
