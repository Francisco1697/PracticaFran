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
		<form action="<?php echo base_url(); ?>/Edicion/updatear/<?php echo $id; ?>" method="POST">
			<label for="nombre">Nombre:</label>
			<input type="text" name="nombre" id="nombre" value="<?php echo $nombre?>">
			<br>
			<label for="cantidad">Cantidad:</label>
			<input type="text" name="cantidad" id="cantidad" value="<?php echo $cantidad;?>">
			<br><br>
			<input type="submit" value="Editar cosa">
			<br><br>
		</form>
		<button>
    		<a href="/Registro">Volver</a>
		</button>
	</body>
</html>