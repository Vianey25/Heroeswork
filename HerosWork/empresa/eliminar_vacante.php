<?php
    // Incluir el archivo de conexión
    include('conexion.php');

    // Verificar si se proporciona un ID de vacante
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id_vacante = $_GET['id'];

        // Consulta para eliminar la vacante
        $consulta_eliminar = "DELETE FROM Vacantes WHERE id_vacante = $id_vacante";
        $resultado_eliminar = $conexion->query($consulta_eliminar);

        if ($resultado_eliminar) {

            echo "<script>window.location.href = 'index.php';</script>";
        } else {
            echo "<p>Error al eliminar la vacante.</p>";
        }
        
    } else {
        echo "<p>No se proporcionó un ID de vacante válido.</p>";
    }

    // Cerrar la conexión
    $conexion->close();
?>
