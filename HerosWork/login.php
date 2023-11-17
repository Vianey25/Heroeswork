<?php
// Establecer la conexión a la base de datos (sustituir con tus propios detalles de conexión)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "heroeswork";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir datos del formulario
$usuario = isset($_POST['username']) ? $_POST['username'] : "";
$contrasena = isset($_POST['password']) ? $_POST['password'] : "";

// Consultar la contraseña almacenada en la base de datos para el usuario dado
$sql = "SELECT id_candidato, contraseña FROM Candidato WHERE correo = '$usuario'";
$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($result->num_rows > 0) {
        // Obtener la información del candidato
        $row = $result->fetch_assoc();
        $id_candidato = $row['id_candidato'];
        $contrasenaAlmacenada = $row['contraseña'];

        if ($contrasena === $contrasenaAlmacenada) {
            // Autenticación exitosa
            session_start();
            $_SESSION['id_candidato'] = $id_candidato;
            header("Location: candidato/"); // Redirigir a la página de inicio
            exit();
        } else {
            // Autenticación fallida
            echo "Credenciales incorrectas. Inténtalo de nuevo.";
        }
    } else {
        // Usuario no encontrado en la tabla "Candidato"
        // Intentar autenticar en la tabla "Empresa"
        $sqlEmpresa = "SELECT id_empresa, contraseña FROM Empresa WHERE correo_electronico = '$usuario'";
        $resultEmpresa = $conn->query($sqlEmpresa);

        if ($resultEmpresa->num_rows > 0) {
            // Obtener la información de la empresa
            $rowEmpresa = $resultEmpresa->fetch_assoc();
            $id_empresa = $rowEmpresa['id_empresa'];
            $contrasenaEmpresaAlmacenada = $rowEmpresa['contraseña'];

            if ($contrasena === $contrasenaEmpresaAlmacenada) {
                // Autenticación exitosa para la empresa
                session_start();
                $_SESSION['id_empresa'] = $id_empresa;
                header("Location: empresa/index.php"); // Redirigir a la página de inicio de la empresa
                exit();
            } else {
                // Autenticación fallida para la empresa
                echo "Credenciales incorrectas para la empresa. Inténtalo de nuevo.";
            }
        } else {
            // Usuario no encontrado en la tabla "Empresa" también
            echo "Usuario no encontrado. Inténtalo de nuevo.";
        }
    }
}

$conn->close();
?>
