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
            font-size: 16px; /* Aumenta el tamaño de la fuente */
            color: #555;
        }

        hr {
            border: 2px solid #ddd; /* Aumenta el grosor de la línea */
            margin: 30px 0;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 12px; /* Aumenta el padding del botón */
            border: none;
            cursor: pointer;
            border-radius: 5px;
            display: block;
            margin: 20px auto; /* Centra el botón */
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

        // Incluir el archivo de conexión
        include('conexion.php');

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
                if($filaCandidato["id_escuela"] == null){
                    echo "<h4>No tiene una escuela asignada</h4>";
                }else{
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
                
            }
        } else {
            echo "No se encontró información del candidato.";
        }

        // Cerrar la conexión
        $conexion->close();
    } else {
        // La sesión no está configurada, redirigir o manejar de acuerdo a tus necesidades
        header("Location: index.php");
        exit();
    }
    ?>
        <div style="text-align: center; margin-top: 20px;">
            <button style="display: inline-block; vertical-align: middle;" onclick="window.location.href='index.php'">Volver</button>
            <button style="display: inline-block; vertical-align: middle;" onclick="window.location.href='editar.php?id=<?php echo $candidatoID; ?>'">Editar</button>
        </div>
    </main>
</body>
</html>
