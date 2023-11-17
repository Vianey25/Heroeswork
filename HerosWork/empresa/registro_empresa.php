<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Empresa</title>
    <style>
        .oculto {
            display: none;
        }
    </style>
</head>
<body>

<h2>Formulario de Registro de Empresa</h2>

<form action="procesar_registro_empresa.php" method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="direccion">Dirección:</label>
    <input type="text" id="direccion" name="direccion">

    <label for="telefono">Teléfono:</label>
    <input type="tel" id="telefono" name="telefono">

    <label for="correo">Correo Electrónico:</label>
    <input type="email" id="correo" name="correo" required>

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="descripcion" rows="4" cols="50"></textarea>

    <label for="RFC">RFC:</label>
    <input type="text" id="RFC" name="RFC" maxlength="20">

    <label for="contrasena">Contraseña:</label>
    <input type="password" id="contrasena" name="contrasena" required>

    <button type="submit">Registrar Empresa</button>
</form>

</body>
</html>
