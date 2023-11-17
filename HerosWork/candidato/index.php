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
            background-color: #333;
            color: white;
            padding: 1em;
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        main {
            padding: 20px;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1em;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .profile-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        h2 {
            color: #333;
        }

        ul {
            list-style-type: none;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        li {
            width: calc(33.33% - 20px);
            margin-bottom: 20px;
            border: 1px solid #ddd;
            padding: 10px;
            background-color: #fff;
            border-radius: 5px;
            box-sizing: border-box;
        }

        h3 {
            font-size: 18px;
            margin-bottom: 8px;
        }

        p {
            font-size: 14px;
            color: #555;
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
<!-- Dentro del header -->
<header>
    <h1>Vacantes</h1>
    <a href="perfil.php"><button class="profile-button">Perfil</button></a>
</header>


    <main>
        <h2>Vacantes Disponibles</h2>

        <?php
            // Incluir el archivo de conexión
            include('conexion.php');

            // Consulta para obtener datos de la tabla Vacantes
            $consulta = "SELECT * FROM Vacantes";
            $resultado = $conexion->query($consulta);

            // Mostrar los datos en la página
            if ($resultado->num_rows > 0) {
                echo "<ul>";
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<li>";
                    echo "<h3>" . $fila["titulo"] . "</h3>";
                    echo "<p>" . $fila["descripcion"] . "</p>";
                    echo "<a href='ver_vacante.php?id=" . $fila["id_vacante"] . "'><button>Ver más</button></a>";
                    echo "</li>";
                }
                echo "</ul>";
            } else {
                echo "No hay vacantes disponibles.";
            }

            // Cerrar la conexión
            $conexion->close();
        ?>
    </main>

    <footer>
        <p>Pie de página</p>
    </footer>
</body>
</html>