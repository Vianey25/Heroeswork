<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Información del Candidato</title>
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

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #6fa5b1;
            color: white;
            padding: 12px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
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
        <h1>Editar Información del Candidato</h1>
    </header>

    <main>
    <?php
            // Incluir el archivo de conexión
            include('conexion.php');

            // Obtener el ID de la escuela de la URL
            $escuelaID = $_GET['id'];

            // Consulta para obtener datos de la escuela específica
            $consultaEscuela = "SELECT id_escuela, nombre, direccion, telefono, correo_electronico FROM Escuela WHERE id_escuela = $escuelaID";
            $resultadoEscuela = $conexion->query($consultaEscuela);

            // Mostrar el formulario para la edición de la información
            if ($resultadoEscuela->num_rows > 0) {
                $filaEscuela = $resultadoEscuela->fetch_assoc();
        ?>
                <form action="guardar_edicion.php" method="post">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" value="<?php echo htmlspecialchars($filaEscuela['nombre']); ?>">

                    <label for="direccion">Dirección:</label>
                    <input type="text" name="direccion" value="<?php echo htmlspecialchars($filaEscuela['direccion']); ?>">

                    <label for="telefono">Teléfono:</label>
                    <input type="text" name="telefono" value="<?php echo htmlspecialchars($filaEscuela['telefono']); ?>">

                    <label for="correo">Correo Electrónico:</label>
                    <input type="text" name="correo" value="<?php echo htmlspecialchars($filaEscuela['correo_electronico']); ?>">

                    <input type="hidden" name="id_escuela" value="<?php echo $escuelaID; ?>">
                    
                    <div style="text-align: center; margin-top: 20px;">
                        <button type="submit" style="display: inline-block; vertical-align: middle;">Guardar</button>
                        <button onclick="window.location.href='perfil_escuela.php?id=<?php echo $escuelaID; ?>'" style="display: inline-block; vertical-align: middle;">Cancelar</button>
                    </div>
                </form>
        <?php
            } else {
                echo "No se encontró información de la escuela.";
            }

            // Cerrar la conexión
            $conexion->close();
        ?>
    </main>
</body>
</html>
