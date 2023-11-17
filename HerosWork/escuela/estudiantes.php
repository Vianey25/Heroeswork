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
            background-color: #35355E;
            color: white;
            padding: 1em;
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
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
            text-decoration: none;
        }

        h2 {
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        input, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
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
    </style>
</head>
<body>
<!-- Dentro del header -->
<header>
    <h1>Registro de Estudiantes</h1>
    <a href="perfil.php"><button class="profile-button">Perfil</button></a>
</header>


<main>

        <?php
        // Verificar si la sesión está iniciada
        session_start();
        // Incluir el archivo de conexión
        include('conexion.php');
        // Verificar si el ID de la escuela está en la sesión
        if (isset($_SESSION['id_escuela'])) {
            // Obtener el ID de la escuela desde la sesión
            $id_escuela = $_SESSION['id_escuela'];

            // Verificar si se ha enviado el formulario
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Conectar a la base de datos (reemplaza los valores de conexión según tu configuración)

                // Verificar la conexión
                if ($conexion->connect_error) {
                    die("Error de conexión a la base de datos: " . $conexion->connect_error);
                }

                // Obtener los datos del formulario
                $nombre = $_POST['nombre'];
                $direccion = $_POST['direccion'];
                $edad = $_POST['edad'];
                $discapacidad = $_POST['discapacidad'];
                $habilidades = $_POST['habilidades'];
                $telefono = $_POST['telefono'];
                $sexo = $_POST['sexo'];
                $correo = $_POST['correo'];
                $contraseña = $_POST['contraseña'];

                // Preparar la consulta SQL para insertar un nuevo candidato
                $sql = "INSERT INTO Candidato (id_escuela, nombre, direccion, edad, discapacidad, habilidades, telefono, sexo, correo, contraseña) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                // Preparar la declaración
                $stmt = $conexion->prepare($sql);

                // Vincular los parámetros
                $stmt->bind_param("sssissssss", $id_escuela, $nombre, $direccion, $edad, $discapacidad, $habilidades, $telefono, $sexo, $correo, $contraseña);

                // Ejecutar la declaración
                if ($stmt->execute()) {
                    echo "El candidato se ha registrado correctamente.";
                } else {
                    echo "Error al registrar al candidato: " . $stmt->error;
                }

                // Cerrar la conexión
                $stmt->close();
                $conexion->close();
            }
        }
        ?>

        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <title>Formulario de Registro de Candidato</title>
        </head>
        <body>

        <h2>Registrar Nuevo Candidato</h2>

        <form method="post" action="">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" required>

            <label for="direccion">Dirección:</label>
            <input type="text" name="direccion">

            <label for="edad">Edad:</label>
            <input type="number" name="edad" required>

            <label for="discapacidad">Discapacidad:</label>
            <input type="text" name="discapacidad">

            <label for="habilidades">Habilidades:</label>
            <textarea name="habilidades"></textarea>

            <label for="telefono">Teléfono:</label>
            <input type="tel" name="telefono">

            <label for="sexo">Sexo:</label>
            <input type="text" name="sexo">

            <label for="correo">Correo:</label>
            <input type="email" name="correo">

            <label for="contraseña">Contraseña:</label>
            <input type="password" name="contraseña" required>

            <button type="submit">Registrar Candidato</button>
        </form>
        <a href="index.php"><button type="button">Volver</button></a>
        </body>
        </html>

    </main>


   
</body>
</html>
