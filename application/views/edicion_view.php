<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Editar una cosa</title>
	</head>
	<body>
		<h1>Editar cosa</h1>
		<form action="<?php echo base_url(); ?>/Edicion/updatear/<?php echo $cosa->id; ?>" method="POST">
			<label for="nombre">Nombre:</label>
			<input type="text" name="nombre" id="nombre" value="<?php echo $cosa->nombre?>">
			<br>
			<label for="cantidad">Cantidad:</label>
			<input type="text" name="cantidad" id="cantidad" value="<?php echo $cosa->cantidad;?>">
			<br><br>
			<?php foreach ($tags as $dato): ?>
				<tr>
					<td><?= $dato->nombre ?></td>					
					<input type="checkbox" name="opciones[]" value="<?php echo $dato->id; ?>"
						<?php if (in_array($dato->id, $tagsAsociados)): ?>
							checked
						<?php endif; ?>
					>					
					&nbsp;&nbsp;&nbsp;&nbsp;
				</tr>
			<?php endforeach ?>
			<br><br>
			<input type="submit" value="Editar cosa">
			<br><br>
		</form>
		<button>
    		<a href="/Registro">Volver</a>
		</button>
	</body>
</html>