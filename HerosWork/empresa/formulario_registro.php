<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Empresa</title>
    <style>
         body {
            font-family: 'Ubuntu', sans-serif;
            background-color: #35355E;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
           
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h2 {
            text-align: center;
            font-family: 'Ubuntu', sans-serif;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 1px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
           
        }
        .flex-container {
            display: flex;
            gap: 10px;
        }
        .button{
            font-size: 1.5em;
            font-weight: bold;
            border-radius: 10px;
            padding: 10px 20px;
            box-shadow: 2px 2px 10px rgba(0,0,0,0.5);
            color: white;
            background-color: #183146;
        }
        .button:hover{
            background-color:#6FA5B1;}

            input[type="submit"]:hover {
            background-color: #4e6b9f;
        },
        a {
            text-decoration: none;
            display: block;
            margin-top: 10px;
            color: #3498db;
        }

        button {
            background-color: #3498db;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
<div class="container">


<?php
// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectar a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "heroeswork";

    $conexion = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Recoger los datos del formulario
    $nombre = $_POST["nombre"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];
    $correo = $_POST["correo"];
    $descripcion = $_POST["descripcion"];
    $RFC = $_POST["RFC"];
    $contrasena = $_POST["contrasena"];

    // Insertar datos en la tabla Empresa
    $sql = "INSERT INTO Empresa (nombre, direccion, telefono, correo_electronico, descripcion, RFC, contraseña) VALUES ('$nombre', '$direccion', '$telefono', '$correo', '$descripcion', '$RFC', '$contrasena')";

    if ($conexion->query($sql) === TRUE) {
        header("Location: ../iniciosesion.php");
        exit(); 
    } else {
        echo "Error al registrar: " . $conexion->error;
    }

    // Cerrar la conexión
    $conexion->close();
}
?>

<form action="formulario_registro.php" method="POST">
<h2>Registro de Empresa</h2>
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required><br>

    <div class="flex-container">
            <div>
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion">
            </div>

            <div>
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono">
            </div>
        </div>

        <label for="correo">Correo Electrónico:</label>
        <input type="email" id="correo" name="correo" required>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" rows="4" cols="50"></textarea>

        <label for="RFC">RFC:</label>
        <input type="text" id="RFC" name="RFC" maxlength="20">

        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required>
        
        <input type="submit" class="button" value="Registrar">
    </form>
    <br>
    <a href="../iniciosesion.php"><button>Volver a Inicio</button></a>
</div>
</body>
</html>
