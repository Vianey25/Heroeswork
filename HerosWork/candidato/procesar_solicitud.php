<?php
// Incluir el archivo de conexión
include('conexion.php');

// Verificar si se proporciona un ID de vacante y que el usuario haya iniciado sesión
if (isset($_POST['id_vacante']) && is_numeric($_POST['id_vacante']) && isset($_SESSION['id_candidato'])) {
    $id_vacante = $_POST['id_vacante'];
    $id_candidato = $_SESSION['id_candidato'];

    // Insertar solicitud en la base de datos
    $sql = "INSERT INTO Solicitud (id_vacante, id_candidato, estado, fecha) 
            VALUES ($id_vacante, $id_candidato, 'Pendiente', NOW())";

    if ($conexion->query($sql) === TRUE) {
        echo "Solicitud enviada correctamente";
    } else {
        echo "Error al enviar la solicitud: " . $conexion->error;
    }

    echo "<button onclick='window.history.back()'>Volver</button>";
} else {
    echo "<p>No se proporcionó un ID de vacante válido o el usuario no ha iniciado sesión.</p>";
    echo "<button onclick='window.history.back()'>Volver</button>";
}
?>
