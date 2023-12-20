<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<button>
    		<a href="/Registro">Volver</a>
		</button>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tags</title>
</head>
<body>
<h1>Editar TAGS</h1>

<?php foreach ($tags as $elemento): ?>
    <form action="EdicionTags/actualizarTags" method="post">
        <input type="text" name="nombre" value="<?= $elemento->nombre; ?>">
        <input type="hidden" name="id" value="<?= $elemento->id; ?>">
        <button type="submit">Guardar</button>
        <button type="submit">Eliminar</button>
    </form>
    <br>
<?php endforeach; ?>

</body>
</html>

