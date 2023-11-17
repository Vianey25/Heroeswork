<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "heroeswork";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$usuario = isset($_POST['username']) ? $_POST['username'] : "";
$contrasena = isset($_POST['password']) ? $_POST['password'] : "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Autenticar en la tabla "Candidato"
    $stmtCandidato = $conn->prepare("SELECT id_candidato, contraseña FROM Candidato WHERE correo = ?");
    $stmtCandidato->bind_param("s", $usuario);
    $stmtCandidato->execute();
    $resultCandidato = $stmtCandidato->get_result();

    if ($resultCandidato->num_rows > 0) {
        $rowCandidato = $resultCandidato->fetch_assoc();
        $id_candidato = $rowCandidato['id_candidato'];
        $contrasenaCandidatoAlmacenada = $rowCandidato['contraseña'];

        if ($contrasena === $contrasenaCandidatoAlmacenada) {
            session_start();
            $_SESSION['id_candidato'] = $id_candidato;
            header("Location: candidato/");
            exit();
        } else {
            echo "Credenciales incorrectas. Inténtalo de nuevo.";
        }
    } else {
        // Intentar autenticar en la tabla "Empresa"
        $stmtEmpresa = $conn->prepare("SELECT id_empresa, contraseña FROM Empresa WHERE correo_electronico = ?");
        $stmtEmpresa->bind_param("s", $usuario);
        $stmtEmpresa->execute();
        $resultEmpresa = $stmtEmpresa->get_result();

        if ($resultEmpresa->num_rows > 0) {
            $rowEmpresa = $resultEmpresa->fetch_assoc();
            $id_empresa = $rowEmpresa['id_empresa'];
            $contrasenaEmpresaAlmacenada = $rowEmpresa['contraseña'];

            if ($contrasena === $contrasenaEmpresaAlmacenada) {
                session_start();
                $_SESSION['id_empresa'] = $id_empresa;
                header("Location: empresa/index.php");
                exit();
            } else {
                echo "Credenciales incorrectas para la empresa. Inténtalo de nuevo.";
            }
        } else {
            // Intentar autenticar en la tabla "Escuela"
            $stmtEscuela = $conn->prepare("SELECT id_escuela, contraseña FROM Escuela WHERE correo_electronico = ?");
            $stmtEscuela->bind_param("s", $usuario);
            $stmtEscuela->execute();
            $resultEscuela = $stmtEscuela->get_result();

            if ($resultEscuela->num_rows > 0) {
                $rowEscuela = $resultEscuela->fetch_assoc();
                $id_escuela = $rowEscuela['id_escuela'];
                $contrasenaEscuelaAlmacenada = $rowEscuela['contraseña'];

                if ($contrasena === $contrasenaEscuelaAlmacenada) {
                    session_start();
                    $_SESSION['id_escuela'] = $id_escuela;
                    header("Location: escuela/index.php");
                    exit();
                } else {
                    echo "Credenciales incorrectas para la escuela. Inténtalo de nuevo.";
                }
            } else {
                echo "Usuario no encontrado. Inténtalo de nuevo.";
            }
        }
    }
}

$conn->close();
?>
