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
            background-color: #35355E;
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
            background-color: #35355E;
            color: white;
            text-align: center;
            padding: 1em;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .profile-button {
            background-color: #6fa5b1;
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
        .floating-button {
            position: absolute;
            bottom: 100px;
            right: 60px;
            background-color: #4e6b9f;
            color: white;
            padding: 30px;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .floating-button:hover {
            background-color: #9b77da;
        }
    </style>
</head>
<body>
<!-- Dentro del header -->
<header>
    <h1>Escuela</h1>
    <a href="perfil.php"><button class="profile-button">Perfil</button></a>
</header>


    <main>
        <h2>Estudiantes Registrados</h2>

        <?php
        // Incluir el archivo de conexión
        include('conexion.php');

        // Obtener el id de escuela de la sesión del usuario (ajusta según tu estructura de sesión)
        session_start();
        $id_escuela_usuario = $_SESSION['id_escuela'];

        // Consulta para obtener los candidatos relacionados con la escuela del usuario
        $consulta = "SELECT * FROM Candidato WHERE id_escuela = '$id_escuela_usuario'";
        $resultado = $conexion->query($consulta);

        // Mostrar los datos en la página
        if ($resultado->num_rows > 0) {
            echo "<ul>";
            while ($fila = $resultado->fetch_assoc()) {
                echo "<li>";
                echo "<h3>" . $fila["nombre"] . "</h3>";
                echo "<p>Edad: " . $fila["edad"] . "</p>";
                echo "<p>Discapacidad: " . $fila["discapacidad"] . "</p>";
                echo "<p>Habilidades: " . $fila["habilidades"] . "</p>";
                echo "<a href='ver_candidato.php?id=" . $fila["id_candidato"] . "'><button>Ver más</button></a>";
                echo "</li>";
            }
            echo "</ul>";
        } else {
            echo "No hay candidatos relacionados con esta escuela.";
        }

        // Cerrar la conexión
        $conexion->close();
    ?>
<a href="estudiantes.php" class="floating-button">&#43;</a>
    </main>

    <footer>
        <p>Pie de página</p>
    </footer>
</body>
</html>
