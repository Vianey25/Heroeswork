<?php
include 'conexion.php';
// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $nombre = $_POST["nombre"];
    $direccion = $_POST["direccion"];
    $edad = $_POST["edad"];
    $discapacidad = $_POST["discapacidad"];
    $habilidadesArray = $_POST["habilidad"]; // Recoge el array de habilidades
    $habilidades = implode(", ", $habilidadesArray); // Convierte el array a una cadena separada por comas
    $telefono = $_POST["telefono"];
    $sexo = $_POST["sexo"];
    $correo = $_POST["correo"];
    $id_escuela = $_POST["id_escuela"];
    $contraseña = $_POST["contraseña"];

    // Preparar la consulta SQL para insertar datos en la tabla Candidato
    $consulta = $conexion->prepare("INSERT INTO candidato (nombre, direccion, edad, discapacidad, habilidades, telefono, sexo, correo, id_escuela, contraseña) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Vincular los parámetros con los valores del formulario
    $consulta->bind_param("ssissssssi", $nombre, $direccion, $edad, $discapacidad, $habilidades, $telefono, $sexo, $correo, $id_escuela, $contraseña);

    // Ejecutar la consulta
    if ($consulta->execute()) {
        echo "Registro exitoso";
    } else {
        echo "Error al registrar: " . $consulta->error;
    }

    // Cerrar la conexión y liberar recursos
    $consulta->close();
    $conexion->close();
} else {
    // Redireccionar si el formulario no ha sido enviado
    header("Location: formulario_registro.html");
    exit();
}
?>