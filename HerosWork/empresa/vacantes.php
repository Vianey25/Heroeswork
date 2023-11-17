<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Interfaz</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        header {
            background-color: #6fa5b1;
            color: white;
            padding: 1em;
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        main {
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        footer {
            background-color: #6fa5b1;
            color: white;
            text-align: center;
            padding: 1em;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .profile-button {
            background-color: #4e6b9f;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        h2 {
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        input, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #4e6b9f;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 3px;
            display: block;
            margin-top: 10px;
        }

        button:hover {
            background-color: #9b77da;
        }
    </style>
</head>
<body>

<header>
    <h1>Vacantes</h1>
    <a href="perfil.php" class="profile-button">Perfil</a>
</header>

<main>

    <?php
    // Verificar si la sesión está iniciada
    session_start();
    // Incluir el archivo de conexión
    include('conexion.php');
    // Verificar si el ID de la empresa está en la sesión
    if (isset($_SESSION['id_empresa'])) {
        // Obtener el ID de la empresa desde la sesión
        $id_empresa = $_SESSION['id_empresa'];

        // Verificar si se ha enviado el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Conectar a la base de datos (reemplaza los valores de conexión según tu configuración)

            // Verificar la conexión
            if ($conexion->connect_error) {
                die("Error de conexión a la base de datos: " . $conexion->connect_error);
            }

            // Obtener los datos del formulario
            $titulo = $_POST['titulo'];
            $descripcion = $_POST['descripcion'];
            $tiempo = $_POST['tiempo'];
            $sueldo = $_POST['sueldo'];
            $requisitos = $_POST['requisitos'];
            $responsabilidades = $_POST['responsabilidades'];

            // Preparar la consulta SQL para insertar una nueva vacante
            $sql = "INSERT INTO Vacantes (id_empresa, titulo, descripcion, tiempo, sueldo, requisitos, responsabilidades) VALUES (?, ?, ?, ?, ?, ?, ?)";

            // Preparar la declaración
            $stmt = $conexion->prepare($sql);

            // Vincular los parámetros
            $stmt->bind_param("isssdss", $id_empresa, $titulo, $descripcion, $tiempo, $sueldo, $requisitos, $responsabilidades);

            // Ejecutar la declaración
            if ($stmt->execute()) {
                echo "La vacante se ha guardado correctamente.";
            } else {
                echo "Error al guardar la vacante: " . $stmt->error;
            }

            // Cerrar la conexión
            $stmt->close();
            $conexion->close();
        }
    }
    ?>

    <h2>Crear Nueva Vacante</h2>

    <form method="post" action="">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" required>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" required></textarea>

        <label for="tiempo">Tiempo:</label>
        <input type="text" name="tiempo">

        <label for="sueldo">Sueldo:</label>
        <input type="number" name="sueldo" step="0.01">

        <label for="requisitos">Requisitos:</label>
        <textarea name="requisitos"></textarea>

        <label for="responsabilidades">Responsabilidades:</label>
        <textarea name="responsabilidades"></textarea>

        <button type="submit">Guardar Vacante</button>
    </form>
    <a href="index.php"><button type="button">Volver</button></a>

</main>


</body>
</html>
