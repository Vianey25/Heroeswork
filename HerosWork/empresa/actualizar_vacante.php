<?php
// Incluir el archivo de conexión
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $id_vacante = $_POST['id_vacante'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $tiempo = $_POST['tiempo'];
    $sueldo = $_POST['sueldo'];
    $requisitos = $_POST['requisitos'];
    $responsabilidades = $_POST['responsabilidades'];

    // Actualizar la vacante en la base de datos
    $consulta_actualizar = "UPDATE Vacantes SET 
                            titulo = '$titulo',
                            descripcion = '$descripcion',
                            tiempo = '$tiempo',
                            sueldo = '$sueldo',
                            requisitos = '$requisitos',
                            responsabilidades = '$responsabilidades'
                            WHERE id_vacante = $id_vacante";

    $resultado_actualizar = $conexion->query($consulta_actualizar);

    if ($resultado_actualizar) {
        echo "<p>Vacante actualizada exitosamente.</p>";
        // Redirigir a la página de detalles después de 2 segundos
        echo "<meta http-equiv='refresh' content='0;url=ver_vacante.php?id=$id_vacante'>";
    } else {
        echo "<p>Error al actualizar la vacante.</p>";
        echo "<button onclick='window.history.back()'>Volver</button>";
    }
} else {
    echo "<p>Error en la solicitud de actualización.</p>";
    echo "<button onclick='window.history.back()'>Volver</button>";
}

// Cerrar la conexión
$conexion->close();
?>
