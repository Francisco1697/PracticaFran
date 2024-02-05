<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Capacitación de Fran</title>
    <link rel="stylesheet" href="<?= base_url('application/styles/styles.css') ?>">
</head>
<body>

    <header>
        <h1>Bienvenido al registro de cosas</h1>
    </header>
        <h2>Iniciar Sesión</h2>
        <form action="/Welcome/iniciar_sesion" method="post">
            <label for="username">Usuario:</label>
            <input type="text" name="username" id="username" required>
            <br><br>
            <label for="contrasena">Contraseña:</label>
            <input type="password" name="contrasena" id="contrasena" required>
            <br><br><br>
            <input type="submit" value="Iniciar Sesión">
        </form>

        <button><a href='/RegistroUsuario'>Registrarse</button>

</body>
</html>
