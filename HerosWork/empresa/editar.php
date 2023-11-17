<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Información de la Empresa</title>
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
            background-color: #4e6b9f;
            color: white;
            padding: 12px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
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
        <h1>Editar Información de la Empresa</h1>
    </header>

    <main>
        <?php
            // Incluir el archivo de conexión
            include('conexion.php');

            // Obtener el ID de la empresa de la URL
            $empresaID = $_GET['id'];

            // Consulta para obtener datos de la empresa específica (sin la contraseña)
            $consultaEmpresa = "SELECT id_empresa, nombre, direccion, telefono, correo_electronico, descripcion, RFC FROM Empresa WHERE id_empresa = $empresaID";
            $resultadoEmpresa = $conexion->query($consultaEmpresa);

            // Mostrar el formulario para la edición de la información
            if ($resultadoEmpresa->num_rows > 0) {
                $filaEmpresa = $resultadoEmpresa->fetch_assoc();
        ?>
                <form action="guardar_edicion.php" method="post">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" value="<?php echo $filaEmpresa['nombre']; ?>">

                    <label for="direccion">Dirección:</label>
                    <input type="text" name="direccion" value="<?php echo $filaEmpresa['direccion']; ?>">

                    <label for="telefono">Teléfono:</label>
                    <input type="text" name="telefono" value="<?php echo $filaEmpresa['telefono']; ?>">

                    <label for="correo_electronico">Correo Electrónico:</label>
                    <input type="text" name="correo_electronico" value="<?php echo $filaEmpresa['correo_electronico']; ?>">

                    <label for="descripcion">Descripción:</label>
                    <input type="text" name="descripcion" value="<?php echo $filaEmpresa['descripcion']; ?>">

                    <label for="RFC">RFC:</label>
                    <input type="text" name="RFC" value="<?php echo $filaEmpresa['RFC']; ?>">

                    <input type="hidden" name="id_empresa" value="<?php echo $empresaID; ?>">
                    
                    <div style="text-align: center; margin-top: 20px;">
                        <button type="submit" style="display: inline-block;">Guardar</button>
                        <button onclick="window.location.href='perfil.php?id=<?php echo $empresaID; ?>'" style="display: inline-block;">Cancelar</button>
                    </div>
                </form>
        <?php
            } else {
                echo "No se encontró información de la empresa.";
            }

            // Cerrar la conexión
            $conexion->close();
        ?>
    </main>
</body>
</html>
