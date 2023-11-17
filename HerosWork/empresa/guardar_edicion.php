<?php
// Incluir el archivo de conexión
include('conexion.php');

// Verificar si se ha enviado el formulario para guardar la información
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger los datos del formulario
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correo_electronico = $_POST['correo_electronico'];
    $descripcion = $_POST['descripcion'];
    $RFC = $_POST['RFC'];
    $id_empresa = $_POST['id_empresa'];

    // Query para actualizar la información de la empresa
    $actualizarQuery = "UPDATE Empresa SET nombre = '$nombre', direccion = '$direccion', telefono = '$telefono', correo_electronico = '$correo_electronico', descripcion = '$descripcion', RFC = '$RFC' WHERE id_empresa = $id_empresa";

    // Ejecutar la consulta de actualización
    if ($conexion->query($actualizarQuery) === TRUE) {
        // Redireccionar a perfil_empresa.php
        header("Location: perfil.php?id=$id_empresa");
        exit();
    } else {
        echo "Error al actualizar la información: " . $conexion->error;
    }
}

// ...

$conexion->close();
?>
