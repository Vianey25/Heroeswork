<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HeroesWork</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        header {
            background-color: #9b77da;
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
            background-color: #9b77da;
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
    <a href="test/test.php" style="color: white; text-decoration: none; font-size: 25px;">Realiza tus test</a>
    <a href="perfil.php" style="color: white; text-decoration: none; font-size: 25px;">Ver Perfil</a>
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

            // Consulta para contar cuántos tests ha contestado el candidato
            $consultaTestsContestados = "SELECT COUNT(*) as total_tests FROM test WHERE id_candidato = '$candidatoID'";
            $resultadoTestsContestados = $conexion->query($consultaTestsContestados);

            // Verificar el número de tests contestados
            if ($resultadoTestsContestados->num_rows > 0) {
                $filaTestsContestados = $resultadoTestsContestados->fetch_assoc();
                $totalTestsContestados = $filaTestsContestados["total_tests"];

                // Verificar si el candidato ha contestado al menos 4 tests
                if ($totalTestsContestados == 4) {

                    // Consulta para obtener datos de la tabla Vacantes
                    $consulta = "SELECT * FROM solicitud WHERE id_candidato = '$candidatoID'";
                    $resultado = $conexion->query($consulta);
                    ?>
                        <h2>Solicitudes Enviadas</h2>
                    <?php
                    // Mostrar los datos en la página
                    if ($resultado->num_rows > 0) {
                        echo "<ul>";
                        while ($fila = $resultado->fetch_assoc()) {
                            // Obtener el título de la vacante mediante una segunda consulta
                            $idVacante = $fila["id_vacante"];
                            $consultaVacante = "SELECT titulo FROM vacantes WHERE id_vacante = '$idVacante'";
                            $resultadoVacante = $conexion->query($consultaVacante);
                            
                            if ($resultadoVacante->num_rows > 0) {
                                $filaVacante = $resultadoVacante->fetch_assoc();
                                $tituloVacante = $filaVacante["titulo"];
                            } else {
                                // Manejar el caso en que no se encuentre la vacante
                                $tituloVacante = "Vacante no encontrada";
                            }

                            // Mostrar los datos en la página
                            echo "<li>";
                            echo "<h3>" . $tituloVacante . "</h3>";
                            echo "<p> Estado: " . $fila["estado"] . "</p>";
                            echo "</li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "No hay solicitudes.";
                    }
                    // Cerrar la conexión
                    $conexion->close();
                ?>
                <h2>Vacantes Disponibles</h2>

                <?php
            // Incluir el archivo de conexión
            include('conexion.php');

            // Obtener el id_candidato (asegúrate de tener esta variable antes de la consulta)
            $id_candidato = $candidatoID; // Reemplaza esto con la forma en que obtienes el id_candidato

            // Consulta para obtener datos de la tabla Vacantes excluyendo las ya solicitadas por el candidato
            $consulta = "SELECT * FROM vacantes v
                        WHERE NOT EXISTS (
                            SELECT 1 FROM solicitud s
                            WHERE s.id_vacante = v.id_vacante
                            AND s.id_candidato = $id_candidato
                        )";

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
        }else{
            ?>
                <h1>Primero realiza tus test</h1>
            <?php
        }
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
