<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro de Candidato</title>
    <style>
    body {
        font-family: 'Ubuntu', sans-serif;
        background-color: #35355E;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 80%; /* Ajusta el ancho del formulario según sea necesario */
        max-width: 600px;
        margin: auto; /* Centra el formulario en la pantalla */
    }

    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    h2 {
        text-align: center;
        font-family: 'Ubuntu', sans-serif;
    }

    label {
        display: block;
        margin-bottom: 8px;
    }

    input {
        width: calc(100% - 16px);
        padding: 8px;
        margin-bottom: 1px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .flex-container {
        display: flex;
        gap: 10px;
        justify-content: space-between; /* Distribuye los elementos horizontalmente */
    }

    .button {
        font-size: 1.5em;
        font-weight: bold;
        border-radius: 10px;
        padding: 10px 20px;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
        color: white;
        background-color: #183146;
        cursor: pointer;
    }

    .button:hover {
        background-color: #6FA5B1;
    }

    input[type="submit"]:hover {
        background-color: #4e6b9f;
    }

    a {
        text-decoration: none;
        display: block;
        margin-top: 1px;
        color: #3498db;
    }

    button {
        background-color: #3498db;
        color: #fff;
        padding: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        background-color: #2980b9;
    }
</style>

</head>
<body>



<form action="formulario_registro.php" method="POST">
<h2>Formulario de Registro de Candidato</h2>
    <div class="flex-container">
        <div></div>
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required>
    
    <label for="direccion">Dirección:</label>
    <input type="text" id="direccion" name="direccion">
    </div>
    <div>
    <label for="edad">Edad:</label>
    <input type="number" id="edad" name="edad">

    <label for="discapacidad">Discapacidad:</label>
    <select id="discapacidad" name="discapacidad" onchange="mostrarOtro()">
        <option value="Intelectual">Discapacidad Intelectual</option>
        <option value="Otro">Otro</option>
    </select>
    </div>
    </div>
    <div id="otroDiv" class="oculto">
        <label for="otro">Especificar:</label>
        <input type="text" id="otro" name="otro">
    </div>

    <label for="habilidades">Habilidades:</label>
    <ul>
        <li><input type="checkbox" name="habilidad[]" value="Comunicación efectiva"> Comunicación efectiva</li>
        <li><input type="checkbox" name="habilidad[]" value="Trabajo en equipo"> Trabajo en equipo</li>
        <li><input type="checkbox" name="habilidad[]" value="Flexibilidad"> Flexibilidad</li>
        <li><input type="checkbox" name="habilidad[]" value="Destrezas manuales"> Destrezas manuales</li>
        <li><input type="checkbox" name="habilidad[]" value="Coordinación motora"> Coordinación motora</li>
        <li><input type="checkbox" name="habilidad[]" value="Puntualidad"> Puntualidad</li>
        <li><input type="checkbox" name="habilidad[]" value="Compromiso"> Compromiso</li>
        <li><input type="checkbox" name="habilidad[]" value="Orden y limpieza"> Orden y limpieza</li>
        <li><input type="checkbox" name="habilidad[]" value="Seguimiento de instrucciones"> Seguimiento de instrucciones</li>
        <li><input type="checkbox" name="habilidad[]" value="Creatividad"> Creatividad</li>
        <li><input type="checkbox" name="habilidad[]" value="Colaboración"> Colaboración</li>
        <li><input type="checkbox" name="habilidad[]" value="Precisión"> Precisión</li>
        <!-- Agrega más habilidades según sea necesario -->
    </ul>
    <div class="flex-container">
    <div>
    <label for="telefono">Teléfono:</label>
    <input type="tel" id="telefono" name="telefono">
    </div>
    <div>   
    <label for="sexo">Sexo:</label>
    <select id="sexo" name="sexo">
        <option value="Masculino">Masculino</option>
        <option value="Femenino">Femenino</option>
        <option value="Otro">Prefiero no decirlo</option>
    </select>
    </div>
    </div>
    <label for="correo">Correo Electrónico:</label>
    <input type="email" id="correo" name="correo" required>

    <label for="id_escuela">ID de Escuela:</label>
    <input type="number" id="id_escuela" name="id_escuela">

    <label for="contraseña">Contraseña:</label>
    <input type="password" id="contraseña" name="contraseña" required>

    <button type="submit">Registrar Candidato</button>

</form>


<script>
    function mostrarOtro() {
        var discapacidadSelect = document.getElementById("discapacidad");
        var otroDiv = document.getElementById("otroDiv");
        var otroInput = document.getElementById("otro");

        if (discapacidadSelect.value === "Otro") {
            otroDiv.style.display = "block";
            otroInput.setAttribute("name", "discapacidad");
        } else {
            otroDiv.style.display = "none";
            otroInput.removeAttribute("name");
        }
    }
</script>

</body>
</html>