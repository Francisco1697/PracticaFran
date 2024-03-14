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
		<form action="<?php echo base_url(); ?>/EdicionCosa/updatear/<?php echo $cosa->getId(); ?>" method="POST">
			<label for="nombre">Nombre:</label>
			<input type="text" name="nombre" id="nombre" value="<?php echo $cosa->getNombre()?>">
			<br>
			<label for="cantidad">Cantidad:</label>
			<input type="number" name="cantidad" id="cantidad" value="<?php echo $cosa->getCantidad();?>">
			<br><br>
			<?php $tagsAsociados = $cosa->getTags()->toArray() ?>
			<?php foreach ($tags as $dato): ?>
				<tr>
					<td><?= $dato->getNombre() ?></td>					
					<input type="checkbox" name="opciones[]" value="<?php echo $dato->getId(); ?>"
						<?php if (in_array($dato, $tagsAsociados, true)): ?>
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