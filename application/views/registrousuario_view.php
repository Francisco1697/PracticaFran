<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Registro de usuario</title>
    <link rel="stylesheet" href="<?= base_url('application/styles/styles.css') ?>">
</head>
<body>

    <div class="cuadro">
        <h2>Crear Usuario</h2>
        <form action="/RegistroUsuario/agregar_usuario" method="post">
            <label for="nuevo_username">Usuario:</label>
            <input type="text" name="username" id="nuevo_username" required>
            <br><br>
            <label for="nueva_contrasena">Contraseña:</label>
            <input type="password" name="contrasena" id="nueva_contrasena" required>
            <br><br>
            <input type="submit" value="Crear Usuario">
        </form>
    </div>

    <br><br><br>
    <button><a href='/Welcome'>Volver</button>

</body>
</html>