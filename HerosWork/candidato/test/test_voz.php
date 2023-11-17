<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["palabraRepetida"])) {
    // Obtén la palabra repetida desde la solicitud AJAX
    $palabraRepetida = $_POST["palabraRepetida"];

    // Obtén la palabra mostrada (puedes cambiarla dinámicamente según tus necesidades)
    $palabraMostrada = "Hola";

    // Conéctate a la base de datos y realiza las operaciones necesarias
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "testing";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Verifica si la palabra repetida coincide con la palabra mostrada
    if (strtolower($palabraRepetida) == strtolower($palabraMostrada)) {
        // Establece el valor en la consulta SQL como 10
        $sql = "INSERT INTO test (resultados) VALUES ('10')";

        if ($conn->query($sql) !== TRUE) {
            die("Error al insertar palabra repetida: " . $conn->error);
        }

        // Muestra una ventana emergente con el mensaje correcto
        echo "<script>alert('¡Correcto!');</script>";
    } else {
        // Si no coincide, muestra el mensaje de error y establece el valor en la tabla como 0
        $sqlError = "INSERT INTO test (resultados) VALUES ('0')";
        if ($conn->query($sqlError) !== TRUE) {
            die("Error al insertar palabra incorrecta: " . $conn->error);
        }
        echo "<script>alert('Oops, error. Inténtalo de nuevo.');</script>";
    }

    // Después de realizar la inserción en la base de datos
    // Obtén el puntaje actual de la base de datos
    $sqlPuntaje = "SELECT resultados FROM test ORDER BY id_test DESC LIMIT 1";
    $resultadoPuntaje = $conn->query($sqlPuntaje);

    if ($resultadoPuntaje->num_rows > 0) {
        $filaPuntaje = $resultadoPuntaje->fetch_assoc();
        $puntajeActual = $filaPuntaje["resultados"];

        // Cierra la conexión después de obtener el puntaje
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styles_voz.css">
    <link rel="icon" type="image/png" href="assets/logo.ico">
    <title>Test 1. Voz</title>
</head>
<body>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Tu Página</title>
</head>
<body>
  <header>
    <div class="logo">
      <img src="assets/logo.png" alt="Logo"> <p class="hero">HeroesWork</p>
    </div>
    <nav>
      <a href="#">Inicio</a>
      <a href="#">Sobre nosotros</a>
      <a href="#">Contacto</a>
    </nav>
  </header>
<nav>

</nav>

<h1> Test 1. Test de voz</h1>
<h2>Instrucciones</h2>
<h3>¡Escribe o repite la palabra que se muestra en pantalla!</h3>
<h4>Puedes presionar el botón de Hablar :) para activar tu micrófono</h4>

<form id="miFormulario" action="" method="post">
    <p>
        <label>
            <span id="palabraMostrada">Hola</span>
        </label>
    </p>

    <p>
        <label>
            <input type="text" name="palabraRepetida" id="palabraRepetida" placeholder="Escribe o habla...">
        </label>
    </p>

    <p>
        <button class="button1" type="button" onclick="activarMicrofono()">Habla :)</button>
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
    //document.write('<button onclick="window.location.href=\'index.php\'">Atrás</button>');
</script>

</body>
</html>
