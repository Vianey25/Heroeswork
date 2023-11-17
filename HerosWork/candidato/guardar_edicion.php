<?php
// Incluir el archivo de conexión
include('conexion.php');

    // ...

    // Verificar si se ha enviado el formulario para guardar la información
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Recoger los datos del formulario
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $edad = $_POST['edad'];
        $discapacidad = $_POST['discapacidad'];
        $habilidades = $_POST['habilidades'];
        $telefono = $_POST['telefono'];
        $sexo = $_POST['sexo'];
        $correo = $_POST['correo'];
        $id_candidato = $_POST['id_candidato'];

        // Query para actualizar la información del candidato
        $actualizarQuery = "UPDATE Candidato SET nombre = '$nombre', direccion = '$direccion', edad = $edad, discapacidad = '$discapacidad', habilidades = '$habilidades', telefono = '$telefono', sexo = '$sexo', correo = '$correo' WHERE id_candidato = $id_candidato";

        // Ejecutar la consulta de actualización
        if ($conexion->query($actualizarQuery) === TRUE) {
            // Redireccionar a perfil.php
            header("Location: perfil.php?id=$id_candidato");
            exit();
        } else {
            echo "Error al actualizar la información: " . $conexion->error;
        }
    }

    // ...

    $conexion->close();
?>
