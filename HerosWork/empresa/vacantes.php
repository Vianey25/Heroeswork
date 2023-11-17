<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro de Empresa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            color: #333;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input,
        textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>


<h2>Formulario de Vacantes</h2>

<form action="procesar_formulario.php" method="post">
    <label for="titulo">Titulo:</label>
    <input type="text" id="titulo" name="titulo" required>

    <label for="descripcion">Descripción:</label>
    <input type="text" id="descripcion" name="descripcion">

    <label for="tiempo">Tiempo:</label>
    <input type="text" id="tiempo" name="tiempo">

    <label for="sueldo">Sueldo:</label>
    <input type="text" id="sueldo" name="sueldo" required>

    <label for="requisitos">Requisitos:</label>
    <input type="text" id="requisitos" name="requisitos" required>

    <label for="responsabilidades">Responsabilidades:</label>
    <input type="text" id="responsabilidades" name="responsabilidades" required>

    <input type="submit" value="Enviar">
</form>

</body>
</html>
