<!DOCTYPE html>
<html lang="es">
<head>
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
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        main {
            padding: 20px;
        }

        footer {
            background-color: #6fa5b1;
            color: white;
            text-align: center;
            padding: 1em;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .profile-button {
            background-color: #4e6b9f;
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
    <header>
        <h1>Empresa</h1>
        <a href="index.php"><button class="profile-button">Regresar</button></a>
    </header>

    <main>
        <h2>Solicitudes de la vacante</h2>

        <?php
// Incluir el archivo de conexión
include('conexion.php');

// Verificar si hay una sesión activa
session_start();

// Verificar si el usuario está autenticado como empresa
if (isset($_SESSION['id_empresa'])) {
    // Obtener el ID de la empresa desde la sesión
    $id_empresa = $_SESSION['id_empresa'];

    // Obtener el ID de la vacante desde el formulario POST
    if (isset($_POST['id_vacante']) && is_numeric($_POST['id_vacante'])) {
        $id_vacante = $_POST['id_vacante'];

        // Consulta para obtener datos de la tabla Solicitud y unir con Candidatos y Vacante
        $consulta = "SELECT *
                     FROM solicitud
                     JOIN candidato ON solicitud.id_candidato = candidato.id_candidato
                     JOIN vacantes ON solicitud.id_vacante = vacantes.id_vacante
                     WHERE solicitud.id_vacante = $id_vacante";

        $resultado = $conexion->query($consulta);

        // Mostrar los datos en la página
        if ($resultado->num_rows > 0) {
            echo "<ul>";
            while ($fila = $resultado->fetch_assoc()) {
                echo "<li>";
                echo "<h3>Candidato: " . $fila["nombre"] . "</h3>";
                echo "<p>Habilidades: " . $fila["habilidades"] . "</p>";
                echo "<p>Estado: " . $fila["estado"] . "</p>";
                
                // Add the parameters to the link
                 echo "<a href='aceptar_solicitud.php?id_vacante=" . $fila["id_vacante"] . "&id_solicitud=" . $fila["id_solicitud"] . "&id_candidato=" . $fila["id_candidato"] . "'><button>Ver más</button></a>";

            
            
                echo "</li>";
            }
            
            echo "</ul>";
        } else {
            echo "No hay solicitudes para esta vacante.";
        }
    } else {
        echo "No se proporcionó un ID de vacante válido a través del formulario.";
    }
} else {
    echo "No estás autenticado como empresa.";
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
