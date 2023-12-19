<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Registrar una cosa</title>
	</head>
	<body>
		<h1>Nueva cosa</h1>
		<form action="/Carga/agregarRegistro" method="POST">
			<label for="nombre">Nombre:</label>
			<input type="text" name="nombre" id="nombre" required>
			<br>
			<label for="cantidad">Cantidad:</label>
			<input type="number" name="cantidad" id="cantidad" required>
			<br><br>
			<?php foreach ($datos as $dato): ?>
				<tr>
					<td><?= $dato->nombre ?></td>					
					<input type="checkbox" name="opciones[]" value="<?php echo $dato->id; ?>">					
					&nbsp;&nbsp;&nbsp;&nbsp;
				</tr>
			<?php endforeach ?>
			<br><br>
			<input type="submit" value="Agregar cosa">
			<br><br>
		</form>

		<button>
    		<a href="/Registro">Volver</a>
		</button>
	</body>
</html>

