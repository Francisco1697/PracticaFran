<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar una cosa</title>
    <link rel="stylesheet" href="<?= base_url('application/styles/styles.css') ?>">
</head>
<body>

    <header>
        <h1>Nueva cosa</h1>
    </header>

    <form action="/Carga/agregarRegistro" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
        <br><br>
        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" id="cantidad" required>
        <br><br>

        <div class="cuadro">
            <?php foreach ($datos as $dato): ?>
                <label>
                    <span><?= $dato->nombre ?></span>
                    <input type="checkbox" name="opciones[]" value="<?= $dato->id; ?>">
                </label>
            <?php endforeach ?>
        </div>

        <br><br>

        <input type="submit" value="Agregar cosa">
        <br><br>
    </form>

    <button>
        <a href="/Registro">Volver</a>
    </button>

</body>
</html>
