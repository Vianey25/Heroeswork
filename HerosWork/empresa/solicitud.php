<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Empleo</title>
</head>
<body>

<?php
// Incluir el archivo de conexión
include('conexion.php');

// Verificar si se han enviado datos mediante el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se han recibido las variables esperadas
    if (isset($_POST['id_vacante']) && isset($_POST['id_candidato'])) {
        // Obtener los valores de las variables
        $id_vacante = $_POST['id_vacante'];
        $id_candidato = $_POST['id_candidato'];

        // Crear un registro en la tabla Solicitud
        $estado = 'Pendiente'; // Puedes ajustar el estado según tus necesidades
        $fecha = date('Y-m-d H:i:s'); // Fecha y hora actual

        $insertar_solicitud = "INSERT INTO Solicitud (id_vacante, id_candidato, estado, fecha) 
                               VALUES ('$id_vacante', '$id_candidato', '$estado', '$fecha')";

        if ($conexion->query($insertar_solicitud) === TRUE) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error al enviar la solicitud: " . $conexion->error;
        }
    } else {
        echo "Error: No se han recibido todas las variables esperadas.";
    }
}

// Cerrar la conexión
$conexion->close();
?>
</body>
</html>
