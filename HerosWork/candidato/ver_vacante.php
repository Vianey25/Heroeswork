<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Vacante</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: white;
            padding: 1em;
            text-align: center;
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

        h2 {
            color: #333;
        }

        p {
            font-size: 14px;
            color: #555;
        }

        hr {
            border: 1px solid #ddd;
            margin: 20px 0;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 3px;
            display: block;
            margin-top: 10px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h1>Detalles de la Vacante</h1>
    </header>

    <main>
    <?php
        // Iniciar la sesión
        session_start();

        // Verificar si la sesión está configurada
        if (isset($_SESSION['id_candidato'])) {
            // Obtener el ID del candidato desde la sesión
            $candidatoID = $_SESSION['id_candidato'];
        }

        // Incluir el archivo de conexión
        include('conexion.php');

        // Verificar si se proporciona un ID de vacante
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id_vacante = $_GET['id'];

            // Consulta para obtener datos de la vacante específica
            $consulta = "SELECT * FROM Vacantes WHERE id_vacante = $id_vacante";
            $resultado = $conexion->query($consulta);

            // Mostrar los detalles de la vacante
            if ($resultado->num_rows > 0) {
                $vacante = $resultado->fetch_assoc();
                echo "<h2>" . $vacante["titulo"] . "</h2>";
                echo "<p><strong>Descripción:</strong> " . $vacante["descripcion"] . "</p>";
                echo "<p><strong>Tiempo:</strong> " . $vacante["tiempo"] . "</p>";
                echo "<p><strong>Sueldo:</strong> $" . $vacante["sueldo"] . "</p>";
                echo "<p><strong>Requisitos:</strong> " . $vacante["requisitos"] . "</p>";
                echo "<p><strong>Responsabilidades:</strong> " . $vacante["responsabilidades"] . "</p>";

                // Agregar el formulario con el botón de solicitud
                echo "<form action='solicitud.php' method='post'>";
                echo "<input type='hidden' name='id_candidato' value='$candidatoID'>";
                echo "<input type='hidden' name='id_vacante' value='$id_vacante'>";
                echo "<button type='submit'>Solicitar</button>";
                echo "</form>";

                echo "<button onclick='window.history.back()'>Volver</button>";

            } else {
                echo "<p>No se encontró la vacante.</p>";
                echo "<button onclick='window.history.back()'>Volver</button>";
            }
        } else {
            echo "<p>No se proporcionó un ID de vacante válido.</p>";
            echo "<button onclick='window.history.back()'>Volver</button>";
        }

        // Cerrar la conexión
        $conexion->close();
        ?>

    </main>
</body>
</html>
