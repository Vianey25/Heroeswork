<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heroeswork - Encuentra tu trabajo ideal</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            text-align: center;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #919191;
            color: white;
            padding: 10px;
        }

        h1, h2 {
            margin-bottom: 10px;
        }

        a {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            text-decoration: none;
            font-size: 18px;
            background-color: #7c7c7c;
            color: white;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Bienvenido/a a Heroeswork</h1>
    </header>
    <form action="iniciosesion.php" method="post">
        <label for="nombre">Usuario:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="contraseña">Contraseña:</label>
        <input type="contraseña" id="contraseña" name="contraseña" required>

        <button type="submit">Iniciar sesión</button>
    </form>

</html>