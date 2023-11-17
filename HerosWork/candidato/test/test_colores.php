<?php
// Iniciar la sesión
session_start();

// Verificar si la sesión está configurada
if (isset($_SESSION['id_candidato'])) {
    // Obtener el ID del candidato desde la sesión
    $candidatoID = $_SESSION['id_candidato'];
}

// Verifica si se ha enviado la puntuación desde el frontend
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['puntuacion'])) {
    // Obtener la puntuación del formulario actual
    $puntuacion = $_POST['puntuacion'];

    // Incluir el archivo de conexión
    include('../conexion.php');

    // Definir valores para la inserción
    $tipo_test = "test_colores";

    // Realizar la inserción
    $sql_insert = "INSERT INTO test (id_candidato, resultado, tipo_test) VALUES ('$candidatoID', '$puntuacion', '$tipo_test')";

    if ($conexion->query($sql_insert) === TRUE) {
        // Cierra la conexión a la base de datos
        $conexion->close();

        // Redirigir a test.php
        header("Location: test.php");
        exit(); // Asegura que el script se detenga después de redirigir
    } else {
        echo "Error al almacenar la puntuación: " . $conexion->error;
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario de Color</title>
  <style>
    .colorBox {
      width: 100px;
      height: 100px;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div id="formulario">
    <h1>¿Cuál es el color correcto?</h1>

    <!-- Formularios -->
    <!-- Primer formulario -->
    <form action="#" method="post" class="colorForm">
      <div class="colorBox" style="background-color: #3498db;"></div>
      <input type="radio" name="color" value="#3498db"> Azul
      <input type="radio" name="color" value="#e74c3c"> Rojo
      <input type="radio" name="color" value="#2ecc71"> Verde
      <input type="radio" name="color" value="#f1c40f"> Amarillo
    </form>

    <!-- Segundo formulario -->
    <form action="#" method="post" class="colorForm">
      <div class="colorBox" style="background-color: #8e44ad;"></div>
      <input type="radio" name="color" value="#8e44ad"> Morado
      <input type="radio" name="color" value="#d35400"> Naranja
      <input type="radio" name="color" value="#27ae60"> Verde esmeralda
      <input type="radio" name="color" value="#e67e22"> Naranja oscuro
    </form>

    <!-- Tercer formulario -->
    <form action="#" method="post" class="colorForm">
      <div class="colorBox" style="background-color: #1abc9c;"></div>
      <input type="radio" name="color" value="#1abc9c"> Verde menta
      <input type="radio" name="color" value="#e74c3c"> Rojo
      <input type="radio" name="color" value="#2ecc71"> Verde
      <input type="radio" name="color" value="#f1c40f"> Amarillo
    </form>

    <!-- Cuarto formulario -->
    <form action="#" method="post" class="colorForm">
      <div class="colorBox" style="background-color: #e67e22;"></div>
      <input type="radio" name="color" value="#e67e22"> Naranja oscuro
      <input type="radio" name="color" value="#1abc9c"> Verde menta
      <input type="radio" name="color" value="#d35400"> Naranja
      <input type="radio" name="color" value="#27ae60"> Verde esmeralda
    </form>

    <!-- Quinto formulario -->
    <form action="#" method="post" class="colorForm">
      <div class="colorBox" style="background-color: #f1c40f;"></div>
      <input type="radio" name="color" value="#f1c40f"> Amarillo
      <input type="radio" name="color" value="#8e44ad"> Morado
      <input type="radio" name="color" value="#3498db"> Azul
      <input type="radio" name="color" value="#2ecc71"> Verde
    </form>

    <!-- Sexto formulario -->
    <form action="#" method="post" class="colorForm">
      <div class="colorBox" style="background-color: #27ae60;"></div>
      <input type="radio" name="color" value="#27ae60"> Verde esmeralda
      <input type="radio" name="color" value="#e74c3c"> Rojo
      <input type="radio" name="color" value="#8e44ad"> Morado
      <input type="radio" name="color" value="#1abc9c"> Verde menta
    </form>

    <!-- Séptimo formulario -->
    <form action="#" method="post" class="colorForm">
      <div class="colorBox" style="background-color: #1abc9c;"></div>
      <input type="radio" name="color" value="#1abc9c"> Verde menta
      <input type="radio" name="color" value="#e67e22"> Naranja oscuro
      <input type="radio" name="color" value="#8e44ad"> Morado
      <input type="radio" name="color" value="#f1c40f"> Amarillo
    </form>

    <!-- Octavo formulario -->
    <form action="#" method="post" class="colorForm">
      <div class="colorBox" style="background-color: #e74c3c;"></div>
      <input type="radio" name="color" value="#e74c3c"> Rojo
      <input type="radio" name="color" value="#27ae60"> Verde esmeralda
      <input type="radio" name="color" value="#8e44ad"> Morado
      <input type="radio" name="color" value="#1abc9c"> Verde menta
    </form>

    <!-- Noveno formulario -->
    <form action="#" method="post" class="colorForm">
      <div class="colorBox" style="background-color: #2ecc71;"></div>
      <input type="radio" name="color" value="#2ecc71"> Verde
      <input type="radio" name="color" value="#f1c40f"> Amarillo
      <input type="radio" name="color" value="#8e44ad"> Morado
      <input type="radio" name="color" value="#e67e22"> Naranja oscuro
    </form>

    <!-- Decimo formulario -->
    <form action="#" method="post" class="colorForm">
      <div class="colorBox" style="background-color: #2ecc71;"></div>
      <input type="radio" name="color" value="#2ecc71"> Verde
      <input type="radio" name="color" value="#f1c40f"> Amarillo
      <input type="radio" name="color" value="#8e44ad"> Morado
      <input type="radio" name="color" value="#e67e22"> Naranja oscuro
    </form>

    <!-- Botón de verificación -->
    <button type="button" onclick="verificarRespuestas()">Verificar</button>
  </div>

  <p id="puntuacion">Puntuación: <span id="puntos">0</span></p>

  <script>
  var respuestasCorrectas = ["#3498db", "#8e44ad", "#1abc9c", "#e67e22", "#f1c40f", "#27ae60", "#1abc9c", "#e74c3c", "#2ecc71", "#2ecc71"];

  function verificarRespuestas() {
    var cuadrosColor = document.querySelectorAll('.colorBox');
    var aciertos = 0;

    for (var i = 0; i < respuestasCorrectas.length; i++) {
      var respuestaCorrecta = respuestasCorrectas[i];
      var eleccionUsuario = document.querySelectorAll('.colorForm')[i].querySelector('input[name="color"]:checked');
      
      if (eleccionUsuario) {
        cuadrosColor[i].style.backgroundColor = eleccionUsuario.value;

        if (eleccionUsuario.value === respuestaCorrecta) {
          aciertos++;
        }
      }
    }

    // Actualizar la puntuación en el frontend
    document.getElementById('puntos').innerText = aciertos;

    // Enviar la puntuación al servidor (PHP) mediante AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '', true);  // Deja el primer parámetro vacío para enviar a la misma página
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // Envía la puntuación al servidor
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
        // Maneja la respuesta del servidor aquí, si es necesario
        console.log(xhr.responseText);
        
        // Redirige a test.php después de manejar la respuesta
        window.location.href = 'test.php';
      }
    };

    xhr.send('puntuacion=' + aciertos);
  }
</script>

</body>
</html>
