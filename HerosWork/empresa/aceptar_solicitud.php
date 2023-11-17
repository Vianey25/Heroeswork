<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Solicitud</title>
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
        max-width: 800px;
        margin: 0 auto;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
        overflow: hidden;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: flex-start;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th, td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .solicitud {
        width: 100%; /* Ocupa todo el ancho en una sola columna */
        box-sizing: border-box;
        padding: 0 20px 20px 20px;
    }

    .candidato, .vacante {
        width: 48%; /* Cambiado a 48% para que ambos div ocupen casi la mitad del ancho */
        box-sizing: border-box;
        padding: 0 20px 20px 20px;
    }

    h2 {
        color: #333;
    }

    p {
        font-size: 14px;
        color: #555;
    }
    a {
            background-color: #4e6b9f;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 3px;
            display: block;
            margin-top: 10px;
        }
</style>



</head>
<body>
    <header>
        <h1>Detalles de la Solicitud</h1>
    </header>

    <main>
        <?php
            // Include the connection file
            include('conexion.php');

            // Get the parameters from the URL
            $id_vacante = $_GET['id_vacante'];
            $id_solicitud = $_GET['id_solicitud'];
            $id_candidato = $_GET['id_candidato'];

            // Fetch data for the candidate, solicitation, and vacancy
            $consulta_candidato = "SELECT * FROM candidato WHERE id_candidato = $id_candidato";
            $resultado_candidato = $conexion->query($consulta_candidato);

            $consulta_solicitud = "SELECT * FROM solicitud WHERE id_solicitud = $id_solicitud";
            $resultado_solicitud = $conexion->query($consulta_solicitud);

            $consulta_vacante = "SELECT * FROM vacantes WHERE id_vacante = $id_vacante";
            $resultado_vacante = $conexion->query($consulta_vacante);

            // Display the data
            if ($resultado_candidato->num_rows > 0 && $resultado_solicitud->num_rows > 0 && $resultado_vacante->num_rows > 0) {
                $candidato = $resultado_candidato->fetch_assoc();
                $solicitud = $resultado_solicitud->fetch_assoc();
                $vacante = $resultado_vacante->fetch_assoc();
        ?>
<table>
            <tr>
                <th colspan="2">Datos de la Solicitud</th>
            </tr>
            <tr>
                <td>ID Solicitud:</td>
                <td><?php echo $solicitud['id_solicitud']; ?></td>
            </tr>
            <tr>
                <td>ID Vacante:</td>
                <td><?php echo $solicitud['id_vacante']; ?></td>
            </tr>
            <tr>
                <td>Estado:</td>
                <td><?php echo $solicitud['estado']; ?></td>
            </tr>
            <tr>
                <td>Fecha:</td>
                <td><?php echo $solicitud['fecha']; ?></td>
            </tr>
        </table>

        <div class="candidato">
            <h2>Datos del Candidato</h2>
            <p>ID Candidato: <?php echo $candidato['id_candidato']; ?></p>
            <p>ID Escuela: <?php echo $candidato['id_escuela']; ?></p>
            <p>Nombre: <?php echo $candidato['nombre']; ?></p>
            <p>Dirección: <?php echo $candidato['direccion']; ?></p>
            <p>Edad: <?php echo $candidato['edad']; ?></p>
            <p>Discapacidad: <?php echo $candidato['discapacidad']; ?></p>
            <p>Habilidades: <?php echo $candidato['habilidades']; ?></p>
            <p>Teléfono: <?php echo $candidato['telefono']; ?></p>
            <p>Sexo: <?php echo $candidato['sexo']; ?></p>
            <p>Correo: <?php echo $candidato['correo']; ?></p>
        </div>

        <div class="vacante">
            <h2>Datos de la Vacante</h2>
            <p>ID Vacante: <?php echo $vacante['id_vacante']; ?></p>
            <p>ID Empresa: <?php echo $vacante['id_empresa']; ?></p>
            <p>Título: <?php echo $vacante['titulo']; ?></p>
            <p>Descripción: <?php echo $vacante['descripcion']; ?></p>
            <p>Tiempo: <?php echo $vacante['tiempo']; ?></p>
            <p>Sueldo: <?php echo $vacante['sueldo']; ?></p>
            <p>Requisitos: <?php echo $vacante['requisitos']; ?></p>
            <p>Responsabilidades: <?php echo $vacante['responsabilidades']; ?></p>
            <!-- Display other vacancy data as needed -->
        </div>

        <?php
            } else {
                echo "<p>No se encontraron datos para mostrar.</p>";
            }

            // Close the database connection
            $conexion->close();
            if($solicitud["estado"]=='aceptado' || $solicitud["estado"]=='rechazado'){
                ?>
                <a href="index.php">Regresar</a>
                <?php
            }else{
        ?>
        <a href="procesar_solicitud.php?action=aceptar&id_solicitud=<?php echo $solicitud['id_solicitud']; ?>">Aceptar Solicitud</a>
        <a href="procesar_solicitud.php?action=rechazar&id_solicitud=<?php echo $solicitud['id_solicitud']; ?>">Rechazar Solicitud</a>  

    </main>
    <?php
            }
    ?>
</body>
</html>
