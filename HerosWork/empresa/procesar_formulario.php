<?php
// Establecer la conexión a la base de datos (ajusta los valores según tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "heroeswork";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Recibir datos del formulario
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$tiempo = $_POST['tiempo'];
$sueldo = $_POST['sueldo'];
$requisitos = $_POST['requisitos'];
$responsabilidades = $_POST['responsabilidades'];

// Preparar la consulta SQL
$sql = "INSERT INTO Vacantes (titulo, descripcion, tiempo, sueldo, requisitos, responsabilidades) 
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssdss", $titulo, $descripcion, $tiempo, $sueldo, $requisitos, $responsabilidades);

if ($stmt->execute()) {
    echo "Registro insertado correctamente";
} else {
    echo "Error al insertar registro: " . $stmt->error;
}

$stmt->close();
?>