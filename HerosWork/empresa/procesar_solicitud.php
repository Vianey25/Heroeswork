<?php
// Include the connection file
include('conexion.php');

// Check if action is set and valid
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    // Get the ID of the solicitud to update
    $id_solicitud = $_GET['id_solicitud'];

    // Check the action and perform the corresponding operation
    if ($action === 'aceptar') {
        // Update the estado to "aceptado"
        $update_query = "UPDATE solicitud SET estado = 'aceptado' WHERE id_solicitud = $id_solicitud";
    } elseif ($action === 'rechazar') {
        // Update the estado to "rechazado"
        $update_query = "UPDATE solicitud SET estado = 'rechazado' WHERE id_solicitud = $id_solicitud";
    } else {
        echo "Acción no válida.";
        exit; // Stop execution if the action is not valid
    }

    // Execute the update query
    if ($conexion->query($update_query) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error al actualizar la solicitud: " . $conexion->error;
    }
} else {
    echo "Acción no especificada.";
}

// Close the database connection
$conexion->close();
?>
