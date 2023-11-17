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
            background-color: #6fa5b1;
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

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <header>
        <h1>Detalles de la Vacante</h1>
    </header>

    <main>
        <?php
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
                    echo "<form action='actualizar_vacante.php' method='post'>";
                    echo "<input type='hidden' name='id_vacante' value='$id_vacante'>";
                    echo "<label for='titulo'>Título:</label>";
                    echo "<input type='text' name='titulo' value='" . $vacante["titulo"] . "'><br>";
                    echo "<label for='descripcion'>Descripción:</label>";
                    echo "<textarea name='descripcion'>" . $vacante["descripcion"] . "</textarea><br>";
                    echo "<label for='tiempo'>Tiempo:</label>";
                    echo "<input type='text' name='tiempo' value='" . $vacante["tiempo"] . "'><br>";
                    echo "<label for='sueldo'>Sueldo:</label>";
                    echo "<input type='text' name='sueldo' value='" . $vacante["sueldo"] . "'><br>";
                    echo "<label for='requisitos'>Requisitos:</label>";
                    echo "<textarea name='requisitos'>" . $vacante["requisitos"] . "</textarea><br>";
                    echo "<label for='responsabilidades'>Responsabilidades:</label>";
                    echo "<textarea name='responsabilidades'>" . $vacante["responsabilidades"] . "</textarea><br>";
                    echo "<button type='submit'>Actualizar Vacante</button>";
                    echo "<button onclick='window.location.href=\"index.php\"'>Volver</button>";
                    echo "</form>";

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

    <script>
        function eliminarVacante(id) {
            var confirmacion = confirm("¿Estás seguro de que deseas eliminar esta vacante?");
            if (confirmacion) {
                // Redirigir a un script de eliminación (por ejemplo, eliminar_vacante.php) con el ID de la vacante
                window.location.href = 'eliminar_vacante.php?id=' + id;
            }
        }
    </script>

</body>
</html>
