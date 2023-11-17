<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Perfil de Empresa</title>
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
            font-size: 16px;
            color: #555;
        }

        hr {
            border: 2px solid #ddd;
            margin: 30px 0;
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
            background-color: #6fa5b1;
        }
    </style>
</head>
<body>
    <header>
        <h1>Detalles del Perfil de Empresa</h1>
    </header>

    <main>
    <?php
    // Iniciar la sesión
    session_start();

    // Verificar si la sesión está configurada
    if (isset($_SESSION['id_empresa'])) {
        // Obtener el ID de la empresa desde la sesión
        $empresaID = $_SESSION['id_empresa'];

        // Incluir el archivo de conexión
        include('conexion.php');

        // Consulta para obtener datos de la empresa específica (sin la contraseña)
        $consultaEmpresa = "SELECT id_empresa, nombre, direccion, telefono, correo_electronico, descripcion, RFC FROM Empresa WHERE id_empresa = $empresaID";
        $resultadoEmpresa = $conexion->query($consultaEmpresa);

        // Mostrar los datos en la página
        if ($resultadoEmpresa->num_rows > 0) {
            while ($filaEmpresa = $resultadoEmpresa->fetch_assoc()) {
                echo "<h2>Información de la Empresa</h2>";
                echo "<p><strong>Nombre:</strong> " . $filaEmpresa["nombre"] . "</p>";
                echo "<p><strong>Dirección:</strong> " . $filaEmpresa["direccion"] . "</p>";
                echo "<p><strong>Teléfono:</strong> " . $filaEmpresa["telefono"] . "</p>";
                echo "<p><strong>Correo Electrónico:</strong> " . $filaEmpresa["correo_electronico"] . "</p>";
                echo "<p><strong>Descripción:</strong> " . $filaEmpresa["descripcion"] . "</p>";
                echo "<p><strong>RFC:</strong> " . $filaEmpresa["RFC"] . "</p>";
            }
        } else {
            echo "No se encontró información de la empresa.";
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
            <button style="display: inline-block; vertical-align: middle;" onclick="window.location.href='editar.php?id=<?php echo $empresaID; ?>'">Editar</button>
            <button style="display: inline-block; vertical-align: middle;" onclick="cerrarSesion()">Cerrar Sesión</button>
        </div>
        

<!-- Agrega este script JavaScript para manejar el cierre de sesión -->
<script>
    function cerrarSesion() {
        // Realiza una solicitud al servidor para cerrar la sesión
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "cerrar_sesion.php", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Redirige al index después de cerrar la sesión
                window.location.href = '../index.php';
            }
        };
        xhr.send();
    }
</script>
    </main>
</body>
</html>
