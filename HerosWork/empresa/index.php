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
<!-- Dentro del header -->
<header>
    <h1>Empresa</h1>
    <a href="perfil.php"><button class="profile-button">Perfil</button></a>
</header>


    <main>
        <h2>Vacantes</h2>

        <?php
// Incluir el archivo de conexión
include('conexion.php');

// Verificar si hay una sesión activa
session_start();

// Verificar si el usuario está autenticado como empresa
if (isset($_SESSION['id_empresa'])) {
    // Obtener el ID de la empresa desde la sesión
    $id_empresa = $_SESSION['id_empresa'];

    // Consulta para obtener datos de la tabla Vacantes filtrando por la empresa
    $consulta = "SELECT * FROM Vacantes WHERE id_empresa = $id_empresa";
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
        echo "No hay vacantes disponibles para esta empresa.";
    }
} else {
    echo "No estás autenticado como empresa.";
}

// Cerrar la conexión
$conexion->close();
?>
<a href="vacantes.php" class="floating-button">&#43;</a>
    </main>

    <footer>
        
        <p>Pie de página</p>
    </footer>
</body>
</html>
