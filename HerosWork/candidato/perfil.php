<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Perfil</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }

        header {
            background-color: #333;
            color: white;
            padding: 1em;
            text-align: center;
        }

        main {
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        h2 {
            color: #333;
        }

        p {
            font-size: 16px;
            color: #555;
        }

        #profile-picture {
            max-width: 200px;
            border-radius: 50%;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Mi Perfil</h1>
    </header>

    <main>
        <?php
            // Incluir el archivo de conexión
            include('conexion.php');

            // ID del candidato que quieres mostrar (en este caso, ID 1)
            $candidatoID = 0;

            // Consulta para obtener datos del candidato específico (sin la contraseña)
            $consultaCandidato = "SELECT id_candidato, id_escuela, nombre, direccion, edad, discapacidad, habilidades, telefono, sexo, correo FROM Candidato WHERE id_candidato = $candidatoID";
            $resultadoCandidato = $conexion->query($consultaCandidato);

            // Mostrar los datos en la página
            if ($resultadoCandidato->num_rows > 0) {
                while ($filaCandidato = $resultadoCandidato->fetch_assoc()) {
                    
                    echo "<h2>Información del Candidato</h2>";
                    echo "<p><strong>Nombre:</strong> " . $filaCandidato["nombre"] . "</p>";
                    echo "<p><strong>Dirección:</strong> " . $filaCandidato["direccion"] . "</p>";
                    echo "<p><strong>Edad:</strong> " . $filaCandidato["edad"] . "</p>";
                    echo "<p><strong>Discapacidad:</strong> " . $filaCandidato["discapacidad"] . "</p>";
                    echo "<p><strong>Habilidades:</strong> " . $filaCandidato["habilidades"] . "</p>";
                    echo "<p><strong>Teléfono:</strong> " . $filaCandidato["telefono"] . "</p>";
                    echo "<p><strong>Sexo:</strong> " . $filaCandidato["sexo"] . "</p>";
                    echo "<p><strong>Correo:</strong> " . $filaCandidato["correo"] . "</p>";

                    // Consulta para obtener el nombre de la escuela
                    $idEscuela = $filaCandidato["id_escuela"];
                    $consultaEscuela = "SELECT nombre, direccion, telefono FROM Escuela WHERE id_escuela = $idEscuela";
                    $resultadoEscuela = $conexion->query($consultaEscuela);

                    // Mostrar la información de la escuela
                    if ($resultadoEscuela->num_rows > 0) {
                        $filaEscuela = $resultadoEscuela->fetch_assoc();
                        echo "<h2>Escuela Asociada</h2>";
                        echo "<p><strong>Nombre:</strong> " . $filaEscuela["nombre"] . "</p>";
                        echo "<p><strong>Dirección:</strong> " . $filaEscuela["direccion"] . "</p>";
                        echo "<p><strong>Teléfono:</strong> " . $filaEscuela["telefono"] . "</p>";
                    } else {
                        echo "<p><strong>Escuela:</strong> No disponible</p>";
                    }
                }
            } else {
                echo "No se encontró información del candidato.";
            }

            // Cerrar la conexión
            $conexion->close();
        ?>
    </main>
</body>
</html>
