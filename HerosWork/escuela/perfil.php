<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de escuela</title>
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
            font-size: 16px; /* Aumenta el tamaño de la fuente */
            color: #555;
        }

        hr {
            border: 2px solid #ddd; /* Aumenta el grosor de la línea */
            margin: 30px 0;
        }

        button {
            background-color: #6fa5b1;
            color: white;
            padding: 12px; /* Aumenta el padding del botón */
            border: none;
            cursor: pointer;
            border-radius: 5px;
            display: block;
            margin: 20px auto; /* Centra el botón */
        }

        button:hover {
            background-color: #4e6b9f;
        }
    </style>
</head>
<body>
    <header>
        <h1>Informacion de la escuela</h1>
    </header>

    <main>
    <?php
        // Incluir el archivo de conexión
        include('conexion.php');

        // Obtener el id de escuela de la sesión del usuario (ajusta según tu estructura de sesión)
        session_start();
        $id_escuela_usuario = $_SESSION['id_escuela'];

        // Consulta para obtener los detalles de la escuela del usuario
        $consulta = "SELECT * FROM Escuela WHERE id_escuela = '$id_escuela_usuario'";
        $resultado = $conexion->query($consulta);

        // Mostrar los datos en la página
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                echo "<h2>Detalles de la Escuela</h2>";
                echo "<p><strong>Nombre:</strong> " . $fila["nombre"] . "</p>";
                echo "<p><strong>Dirección:</strong> " . $fila["direccion"] . "</p>";
                echo "<p><strong>Teléfono:</strong> " . $fila["telefono"] . "</p>";
                echo "<p><strong>Correo Electrónico:</strong> " . $fila["correo_electronico"] . "</p>";
 
            }
        } else {
            echo "No se encontró información de la escuela.";
        }

        // Cerrar la conexión
        $conexion->close();
    ?>
        <div style="text-align: center; margin-top: 20px;">
            <button style="display: inline-block; vertical-align: middle;" onclick="window.location.href='index.php'">Volver</button>
            <button style="display: inline-block; vertical-align: middle;" onclick="window.location.href='editar.php?id=<?php echo $id_escuela_usuario; ?>'">Editar</button>
        </div>
    </main>
</body>
</html>
