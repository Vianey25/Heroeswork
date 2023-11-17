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
    $id_escuela = isset($_POST["id_escuela"]) ? $_POST["id_escuela"] : '';
    $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : '';
    $direccion = isset($_POST["direccion"]) ? $_POST["direccion"] : '';
    $telefono = isset($_POST["telefono"]) ? $_POST["telefono"] : '';
    $contrasena = isset($_POST["contrasena"]) ? $_POST["contrasena"] : '';
    $correo = isset($_POST["correo"]) ? $_POST["correo"] : '';

    // Insertar datos en la tabla Escuela
    $sql = "INSERT INTO Escuela (id_escuela, nombre, direccion, telefono, correo) VALUES ('$id_escuela', '$nombre', '$direccion', '$telefono', '$correo')";

    if ($conexion->query($sql) === TRUE) {
        echo "Registro exitoso";
    } else {
        echo "Error al registrar: " . $conexion->error;
    }

    // Insertar datos en la tabla de Contraseña (asumiendo que tienes una tabla para contraseñas)
    $sql_contrasena = "INSERT INTO Contraseña (id_escuela, contrasena) VALUES ('$id_escuela', '$contrasena')";

    if ($conexion->query($sql_contrasena) === TRUE) {
        echo "Contraseña registrada exitosamente";
    } else {
        echo "Error al registrar la contraseña: " . $conexion->error;
    }

    // Cerrar la conexión
    $conexion->close();
}
?>

<form action="registro_escuela.php" method="POST">
    <label for="id_escuela">Id_escuela:</label>
    <input type="text" id="id_escuela" name="id_escuela" required><br>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre"><br>

    <label for="direccion">Direccion:</label>
    <input type="text" id="direccion" name="direccion"><br>

    <label for="telefono">Telefono:</label>
    <input type="text" id="telefono" name="telefono" required><br>

    <label for="correo">Correo Electrónico:</label>
    <input type="email" id="correo" name="correo" required><br>

    <label for="contrasena">Contraseña:</label>
    <input type="password" id="contrasena" name="contrasena" required><br>

    <input type="submit" value="Registrar">
</form>

</body>
</html>
