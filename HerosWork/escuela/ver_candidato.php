<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de los alumnos</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        header {
            background-color: #35355E;
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
            background-color: #6fa5b1;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 3px;
            display: block;
            margin-top: 10px;
        }

        button:hover {
            background-color: #4e6b9f;
        }
    </style>
</head>
<body>
    <header>
        <h1>Detalles de la Candidato</h1>
    </header>

    <main>
    <?php
            // Incluir el archivo de conexión
            include('conexion.php');

            // Verificar si se proporciona un ID de candidato
            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                $id_candidato = $_GET['id'];

                // Consulta para obtener datos del candidato específico
                $consultaCandidato = "SELECT * FROM Candidato WHERE id_candidato = $id_candidato";
                $resultadoCandidato = $conexion->query($consultaCandidato);

                // Mostrar los detalles del candidato
                if ($resultadoCandidato->num_rows > 0) {
                    $candidato = $resultadoCandidato->fetch_assoc();
                    echo "<h2>Información del Candidato</h2>";
                    echo "<p><strong>Nombre:</strong> " . $candidato["nombre"] . "</p>";
                    echo "<p><strong>Dirección:</strong> " . $candidato["direccion"] . "</p>";
                    echo "<p><strong>Edad:</strong> " . $candidato["edad"] . "</p>";
                    echo "<p><strong>Discapacidad:</strong> " . $candidato["discapacidad"] . "</p>";
                    echo "<p><strong>Habilidades:</strong> " . $candidato["habilidades"] . "</p>";
                    echo "<p><strong>Teléfono:</strong> " . $candidato["telefono"] . "</p>";
                    echo "<p><strong>Sexo:</strong> " . $candidato["sexo"] . "</p>";
                    echo "<p><strong>Correo:</strong> " . $candidato["correo"] . "</p>";
                    // Agrega más campos según sea necesario
                    echo "<button onclick='window.history.back()'>Volver</button>";
                } else {
                    echo "<p>No se encontró la información del candidato.</p>";
                    echo "<button onclick='window.history.back()'>Volver</button>";
                }
            } else {
                echo "<p>No se proporcionó un ID de candidato válido.</p>";
                echo "<button onclick='window.history.back()'>Volver</button>";
            }

            // Cerrar la conexión
            $conexion->close();
        ?>

    </main>
</body>
</html>
