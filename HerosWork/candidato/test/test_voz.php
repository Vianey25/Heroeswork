<?php
// Iniciar la sesión
session_start();

// Verificar si la sesión está configurada
if (isset($_SESSION['id_candidato'])) {
    // Obtener el ID del candidato desde la sesión
    $candidatoID = $_SESSION['id_candidato'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["palabraRepetida"])) {
    // Obtén la palabra repetida desde la solicitud AJAX
    $palabraRepetida = $_POST["palabraRepetida"];

    // Obtén la palabra mostrada (puedes cambiarla dinámicamente según tus necesidades)
    $palabraMostrada = "Hola";
    $tipo_test = "test_voz";

    // Incluir el archivo de conexión
    include('../conexion.php');

    // Verifica si la palabra repetida coincide con la palabra mostrada
    if (strtolower($palabraRepetida) == strtolower($palabraMostrada)) {
        // Establece el valor en la consulta SQL como 10
        
        $sql = "INSERT INTO test (id_candidato, resultado, tipo_test) VALUES ('$candidatoID', '10', '$tipo_test')";

        if ($conexion->query($sql) !== TRUE) {
            die("Error al insertar palabra repetida: " . $conexion->error);
        }

        // Muestra una ventana emergente con el mensaje correcto
        echo "<script>alert('¡Correcto!');</script>";
    } else {
        // Si no coincide, muestra el mensaje de error y establece el valor en la tabla como 0
        $sqlError = "INSERT INTO test (id_candidato, resultado, tipo_test) VALUES ('$candidatoID', '0', '$tipo_test')";
        if ($conexion->query($sqlError) !== TRUE) {
            die("Error al insertar palabra incorrecta: " . $conexion->error);
        }
        echo "<script>alert('Oops, error. Inténtalo de nuevo.');</script>";
    }

    // Después de realizar la inserción en la base de datos
    // Obtén el puntaje actual de la base de datos
    $sqlPuntaje = "SELECT resultado FROM test ORDER BY id_test DESC LIMIT 1";
    $resultadoPuntaje = $conexion->query($sqlPuntaje);

    if ($resultadoPuntaje->num_rows > 0) {
        $filaPuntaje = $resultadoPuntaje->fetch_assoc();
        $puntajeActual = $filaPuntaje["resultado"];

        // Cierra la conexión después de obtener el puntaje
        $conexion->close();
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Interactivo</title>
</head>
<body>

<h2>Instrucciones: Repite la palabra que se muestra en pantalla.</h2>

<form id="miFormulario" action="" method="post">
    <p>
        <label>
            Palabra a repetir:
            <span id="palabraMostrada">Hola</span>
        </label>
    </p>

    <p>
        <label>
            <input type="text" name="palabraRepetida" id="palabraRepetida" placeholder="Escribe la palabra aquí">
        </label>
    </p>

    <p>
        <button type="button" onclick="activarMicrofono()">Habla :)</button>
    </p>

    <input type="submit" value="Enviar">
    <br>
    <br>

    <!-- Agrega un espacio para mostrar el puntaje -->
    <p>Tu puntaje: <span id="puntajeResultado"><?php echo isset($puntajeActual) ? $puntajeActual : 0; ?></span> puntos</p>
</form>

<script>
    function activarMicrofono() {
        var reconocimientoVoz = new webkitSpeechRecognition() || new SpeechRecognition();
        reconocimientoVoz.lang = 'es-ES';

        reconocimientoVoz.onresult = function(event) {
            var palabraReconocida = event.results[0][0].transcript.trim().toLowerCase();
            document.getElementById('palabraRepetida').value = palabraReconocida;

            // Envía la palabra reconocida al servidor PHP mediante AJAX
            enviarPalabraAlServidor(palabraReconocida);
        };

        reconocimientoVoz.onerror = function(event) {
            alert('Error al reconocer la voz. Asegúrate de permitir el acceso al micrófono.');
        };

        reconocimientoVoz.start();
    }

    function enviarPalabraAlServidor(palabra) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    // Muestra una ventana emergente con el mensaje correcto
                    alert("¡Correcto! La palabra es igual a la mostrada.");
                } else {
                    // Muestra una alerta en caso de error
                        
                }
            }
        };
        xhttp.open("POST", "", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("palabraRepetida=" + palabra);
    }

    // Agrega un botón de "Atrás"
    document.write('<button onclick="window.location.href=\'test.php\'">Atrás</button>');
</script>

</body>
</html>
