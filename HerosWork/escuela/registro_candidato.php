<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro de Candidato</title>
    <style>
        .oculto {
            display: none;
        }
    </style>
</head>
<body>

<h2>Formulario de Registro de Candidato</h2>

<form action="formulario_registro.php" method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="direccion">Dirección:</label>
    <input type="text" id="direccion" name="direccion">

    <label for="edad">Edad:</label>
    <input type="number" id="edad" name="edad">

    <label for="discapacidad">Discapacidad:</label>
    <select id="discapacidad" name="discapacidad" onchange="mostrarOtro()">
        <option value="Intelectual">Discapacidad Intelectual</option>
        <option value="Otro">Otro</option>
    </select>

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

    <label for="telefono">Teléfono:</label>
    <input type="tel" id="telefono" name="telefono">

    <label for="sexo">Sexo:</label>
    <select id="sexo" name="sexo">
        <option value="Masculino">Masculino</option>
        <option value="Femenino">Femenino</option>
        <option value="Otro">Prefiero no decirlo</option>
    </select>

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