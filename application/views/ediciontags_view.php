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
    <h1>Crear un TAG</h1>
    <form action="/EdicionTags/agregarTag" method="POST">
			<label for="nombre">Nombre:</label>
			<input type="text" name="nombre" id="nombre" required>
            <input type="submit" value="Agregar tag">
    </form>
    <h1>Editar TAGS</h1>
    <?php foreach ($tags as $elemento): ?>
        <form action="<?php echo base_url(); ?>/EdicionTags/actualizarTag/<?php echo $elemento->id; ?>" method="POST">
            <input type="text" name="nombre" value="<?= $elemento->nombre; ?>">
            <button type="submit">Guardar</button>
        </form>
        <form action="<?php echo base_url('/EdicionTags/eliminarTag'); ?>" method="post">
      		<input type="hidden" name="id" value="<?php echo $elemento->id; ?>">
      		<input type="submit" value="Eliminar">
      	</form>
        <br><br><br>
    <?php endforeach; ?>
</body>
</html>

