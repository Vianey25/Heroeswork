<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Empresas</title>
    <style>
        /* Estilos CSS aquí (puedes reutilizar algunos estilos del archivo anterior) */
    </style>
</head>
<body>
    <!-- Header similar al anterior -->
    <header>
        <h1>Registro de Empresas</h1>
        <a href="perfil.php"><button class="profile-button">Perfil</button></a>
    </header>

    <main>
        <h2>Registro de Nueva Empresa</h2>

        <!-- Formulario de registro de empresas -->
        <form action="registrar_empresa.php" method="post">
            <label for="nombre_empresa">Nombre de la Empresa:</label>
            <input type="text" id="nombre_empresa" name="nombre_empresa" required>

            <label for="descripcion_empresa">Descripción de la Empresa:</label>
            <textarea id="descripcion_empresa" name="descripcion_empresa" rows="4" required></textarea>

            <!-- Otros campos del formulario según tus necesidades -->

            <button type="submit">Registrar Empresa</button>
        </form>
    </main>

    <footer>
        <p>Pie de página</p>
    </footer>
</body>
</html>
