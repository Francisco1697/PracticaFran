<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!--<!DOCTYPE html>
<html lang="es"> 
<head> 
    <meta charset="utf-8"> 
    <title>Vista</title> 
</head> -->

<!DOCTYPE html>
<html>
<head>
	<title>Registro de cosas</title>
</head>
<body>
	<form method="get">
		<input type="search" name="search" placeholder="Buscar una cosa" value="<?php echo $this->input->get('search')?>" autofocus>
		<button type="submit">Buscar</button>
		<button><a href="Registro">Reiniciar</a></button>
		<button><a href="/Welcome">Volver</a></button>
		<br><br>
		<button><a href="/Carga">Agregar cosa</a></button>
		<button><a href="/EdicionTags">Editar tags</a></button>
	</form>
	<br>
	<table border='1'>
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
						echo $tag->nombre; ?>
						<br><? 
					}?></td>
					<td> 
						<form action="<?php echo base_url('/Carga/eliminar'); ?>" method="post">
      						<input type="hidden" name="id" value="<?php echo $cosa->id; ?>">
      						<input type="submit" value="Eliminar">
      					</form>
  						<button>
						    <a href="/EdicionCosa/index/<?php echo $cosa->id ?>">Editar</a>
						</button>
					</td> 
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
	<br>
</body>
</html>


