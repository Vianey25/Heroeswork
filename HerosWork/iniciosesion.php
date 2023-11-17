<?php
// Configuración de la base de datos (debes proporcionar tus propias credenciales)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "heroeswork";

// Función para autenticar al usuario consultando la base de datos
function authenticate($nombre, $contraseña, $conn) {
    // Debes mejorar estas consultas para evitar la inyección de SQL
    $candidatoSql = "SELECT * FROM candidato WHERE nombre = '$nombre' AND contraseña = '$contraseña'";
    $empresaSql = "SELECT * FROM empresa WHERE nombre = '$nombre' AND contraseña = '$contraseña'";

    $candidatoResult = $conn->query($candidatoSql);
    $empresaResult = $conn->query($empresaSql);

    if (!$candidatoResult || !$empresaResult) {
        die("Error en la consulta: " . $conn->error);
    }

    if ($candidatoResult->num_rows == 1) {
        $row = $candidatoResult->fetch_assoc();
        return ['role' => 'candidato', 'data' => $row];
    } elseif ($empresaResult->num_rows == 1) {
        $row = $empresaResult->fetch_assoc();
        return ['role' => 'empresa', 'data' => $row];
    } else {
        return false; // Autenticación fallida
    }
}

// Procesar el formulario de inicio de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $contraseña = $_POST['contraseña'];

    // Crear conexión a la base de datos
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Autenticar al usuario
    $userData = authenticate($nombre, $contraseña, $conn);

    // Cerrar la conexión a la base de datos
    $conn->close();

    if ($userData) {
        // Redireccionar según el rol del usuario
        if ($userData['role'] === 'empresa') {
            // Accede a los datos específicos de la empresa con $userData['data']
            header("Location: empresa/index.php");
            exit();
        } elseif ($userData['role'] === 'candidato') {
            // Accede a los datos específicos del candidato con $userData['data']
            header("Location: candidato/index.php");
            exit();
        }
    } else {
        // Mostrar un mensaje de error si la autenticación falla
        echo "Error: Usuario o contraseña incorrectos";
    }
}
?>
