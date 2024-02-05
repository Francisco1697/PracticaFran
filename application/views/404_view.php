<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 404 - Página no encontrada</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
            padding: 50px;
        }
        h1 {
            font-size: 36px;
            margin-bottom: 20px;
            color: #1056b3;
        }
        p {
            font-size: 18px;
            color: #1056b3;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="<?php echo base_url('system/libraries/niño2.png'); ?>" alt="Error 404">
        <h1>Error 404 - Página no encontrada</h1>
        <p>Lo sentimos, la página que estás buscando no pudo ser encontrada.</p>
        <p><a href="<?php echo base_url(); ?>">Volver a la página de inicio</a></p>
    </div>
</body>
</html>
