<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Empresa</title>
</head>
<body>

<h2>Registro de Empresa</h2>

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
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required><br>

    <label for="direccion">Dirección:</label>
    <input type="text" id="direccion" name="direccion"><br>

    <label for="telefono">Teléfono:</label>
    <input type="text" id="telefono" name="telefono"><br>

    <label for="correo">Correo Electrónico:</label>
    <input type="email" id="correo" name="correo" required><br>

    <label for="descripcion">Descripción:</label><br>
    <textarea id="descripcion" name="descripcion" rows="4" cols="50"></textarea><br>

    <label for="RFC">RFC:</label>
    <input type="text" id="RFC" name="RFC" maxlength="20"><br>

    <label for="contrasena">Contraseña:</label>
    <input type="password" id="contrasena" name="contrasena" required><br>

    <input type="submit" value="Registrar">
</form>
<br>
<a href="../iniciosesion.php"><button>Volver a Inicio</button></a>

</body>
</html>
