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
            background-color: #4caf50;
            color: white;
            padding: 12px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            display: block;
            margin-top: 10px;
        }

        button:hover {
            background-color: #45a049;
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

            // Obtener el ID del candidato de la URL
            $candidatoID = $_GET['id'];

            // Consulta para obtener datos del candidato específico (sin la contraseña)
            $consultaCandidato = "SELECT id_candidato, id_escuela, nombre, direccion, edad, discapacidad, habilidades, telefono, sexo, correo FROM Candidato WHERE id_candidato = $candidatoID";
            $resultadoCandidato = $conexion->query($consultaCandidato);

            // Mostrar el formulario para la edición de la información
            if ($resultadoCandidato->num_rows > 0) {
                $filaCandidato = $resultadoCandidato->fetch_assoc();
        ?>
                <form action="guardar_edicion.php" method="post">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" value="<?php echo $filaCandidato['nombre']; ?>">

                    <label for="direccion">Dirección:</label>
                    <input type="text" name="direccion" value="<?php echo $filaCandidato['direccion']; ?>">

                    <label for="edad">Edad:</label>
                    <input type="text" name="edad" value="<?php echo $filaCandidato['edad']; ?>">

                    <label for="discapacidad">Discapacidad:</label>
                    <input type="text" name="discapacidad" value="<?php echo $filaCandidato['discapacidad']; ?>">

                    <label for="habilidades">Habilidades:</label>
                    <input type="text" name="habilidades" value="<?php echo $filaCandidato['habilidades']; ?>">

                    <label for="telefono">Teléfono:</label>
                    <input type="text" name="telefono" value="<?php echo $filaCandidato['telefono']; ?>">

                    <label for="sexo">Sexo:</label>
                    <input type="text" name="sexo" value="<?php echo $filaCandidato['sexo']; ?>">

                    <label for="correo">Correo:</label>
                    <input type="text" name="correo" value="<?php echo $filaCandidato['correo']; ?>">

                    <input type="hidden" name="id_candidato" value="<?php echo $candidatoID; ?>">
                    
         <div style="text-align: center; margin-top: 20px;">


                    <button type="submit" style="display: inline-block; vertical-align: middle;">Guardar</button>
                    <button onclick="window.location.href='perfil.php?id=<?php echo $candidatoID; ?>'" style="display: inline-block; vertical-align: middle;">Cancelar</button>
                    </div>
                </form>
        <?php
            } else {
                echo "No se encontró información del candidato.";
            }

            // Cerrar la conexión
            $conexion->close();
        ?>
    </main>
</body>
</html>
