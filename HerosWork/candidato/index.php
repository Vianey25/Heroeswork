<?php
// Conexión a la base de datos (reemplaza con tus propios datos)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Heroeswork";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener las escuelas desde la base de datos
$sql = "SELECT id_escuela, nombre FROM Escuela";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Candidato</title>
</head>
<body>

<h2>Formulario de Candidato</h2>

<form action="formulario_registro.php" method="post">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required><br>

    <label for="direccion">Dirección:</label>
    <input type="text" id="direccion" name="direccion"><br>

    <label for="edad">Edad:</label>
    <input type="number" id="edad" name="edad"><br>

    <label for="discapacidad">Discapacidad:</label>
    <input type="text" id="discapacidad" name="discapacidad"><br>

    <label for="habilidades">Habilidades:</label>
    <textarea id="habilidades" name="habilidades"></textarea><br>

    <label for="telefono">Teléfono:</label>
    <input type="text" id="telefono" name="telefono"><br>

    <label for="sexo">Sexo:</label>
    <select id="sexo" name="sexo">
        <option value="Masculino">Masculino</option>
        <option value="Femenino">Femenino</option>
    </select><br>

    <label for="correo">Correo electrónico:</label>
    <input type="email" id="correo" name="correo"><br>


    <label for="escuela">Escuela:</label>
    <select id="escuela" name="escuela">
        <?php
        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            // Iterar sobre los resultados y generar las opciones del menú desplegable
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id_escuela'] . "'>" . $row['nombre'] . "</option>";
            }
        } else {
            echo "<option value=''>No hay escuelas disponibles</option>";
        }

        // Cerrar la conexión
        $conn->close();
        ?>
    </select><br>

    <input type="submit" value="Enviar">

</body>
</html>
