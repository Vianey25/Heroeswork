<?php
// Incluir el archivo de conexión
include('conexion.php');

// Verificar si se ha enviado el formulario para guardar la información
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger los datos del formulario
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $id_escuela = $_POST['id_escuela'];

    // Query para actualizar la información de la escuela
    $actualizarQuery = "UPDATE Escuela SET nombre = ?, direccion = ?, telefono = ?, correo_electronico = ? WHERE id_escuela = ?";

    // Preparar la declaración
    $stmt = $conexion->prepare($actualizarQuery);

    // Vincular los parámetros
    $stmt->bind_param("ssssi", $nombre, $direccion, $telefono, $correo, $id_escuela);

    // Ejecutar la consulta de actualización
    if ($stmt->execute()) {
        // Redireccionar a perfil_escuela.php
        header("Location: perfil.php?id=$id_escuela");
        exit();
    } else {
        echo "Error al actualizar la información: " . $stmt->error;
    }

    // Cerrar la declaración
    $stmt->close();
}

// Cerrar la conexión
$conexion->close();
?>
