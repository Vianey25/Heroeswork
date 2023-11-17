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

// Recibir datos del formulario
$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$edad = $_POST['edad'];
$discapacidad = $_POST['discapacidad'];
$habilidades = $_POST['habilidades'];
$telefono = $_POST['telefono'];
$sexo = $_POST['sexo'];
$correo = $_POST['correo'];
$id_escuela = $_POST['escuela'];

// Insertar datos en la tabla Candidato
$sql = "INSERT INTO Candidato (id_escuela, nombre, direccion, edad, discapacidad, habilidades, telefono, sexo, correo) 
        VALUES ('$id_escuela', '$nombre', '$direccion', '$edad', '$discapacidad', '$habilidades', '$telefono', '$sexo', '$correo')";

if ($conn->query($sql) === TRUE) {
    echo "Registro insertado correctamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
