<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Página</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #ffffff; /* Color de fondo principal */
        }

        header {
            background-color: #9b77da;
            padding: 20px;
            color: #ffffff; /* Color del texto en el encabezado */
            text-align: center;
        }

        footer {
            background-color: #9b77da;
            padding: 10px;
            color: #ffffff; /* Color del texto en el pie de página */
            text-align: center;
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        .container {
            margin: 20px;
        }

        .txt_container {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #9b77da;
            border-radius: 5px;
        }

        .txt {
            font-size: 18px;
            font-weight: bold;
            color: #9b77da;
        }

        .registro_p {
            margin-top: 10px;
        }

        .registro_a {
            color: #9b77da;
            text-decoration: none;
            font-weight: bold;
        }

        button {
            background-color: #9b77da;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }

        button:hover {
            background-color: #7c5d9a; /* Cambia el color al pasar el ratón sobre el botón */
        }
    </style>
</head>
<body>
    <header>
        <h1></h1>
    </header>

    <div class="container">
        <div class="txt_container">
            <div class="txt">¿Eres una empresa?</div>
            <p class="registro_p">Presiona <a href="empresa/formulario_registro.php" class="registro_a">aquí</a></p>
        </div>

        <div class="txt_container">
            <div class="txt">¿Eres un candidato?</div>
            <p class="registro_p">Presiona <a href="candidato/registro_candidato.php" class="registro_a">aquí</a></p>
        </div>

        <a href="index.php"><button>Volver a Inicio</button></a>
    </div>

    <footer>
        <p>&copy;  Heroeswork 2023.</p>
    </footer>
</body>
</html>
