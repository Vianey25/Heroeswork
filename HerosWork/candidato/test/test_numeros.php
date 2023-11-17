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
    $tipo_test = "test_numeros";

    // Realizar la inserción
    $sql_insert = "INSERT INTO test (id_test, id_candidato, resultado, tipo_test) VALUES (NULL, '$candidatoID', '$puntuacion', '$tipo_test')";

    if ($conexion->query($sql_insert) === TRUE) {
        echo "Puntuación almacenada con éxito.";
    } else {
        echo "Error al almacenar la puntuación: " . $conexion->error;
    }

    // Cierra la conexión a la base de datos
    $conexion->close();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/styles_numeros.css">
  <link rel="icon" type="image/png" href="assets/logo.ico">
  <title>Test 2. Números</title>
  <style>
    .numberBox {
      width: 100px;
      height: 100px;
      margin-top: 10px; /* Espaciado entre los elementos */
      display: inline-block;
    }
  </style>
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
  <div id="formulario">
  <h1> Test 2. Test de números</h1>
<h2>Instrucciones</h2>
<h3>Selecciona el número que se muestra dentro de la figura</h3>
<h4>¿Cuál es el número correcto?</h4>
    <!-- Formularios -->
    <!-- Primer formulario -->
    <form action="#" method="post" class="numberForm">
      <div class="numberBox" style="background-color: #3498db;">1</div>
    <input type="radio" id="number1" name="number" value="1">
    <label for="number1">1</label>
    
    <input type="radio" id="number2" name="number" value="2">
    <label for="number2">2</label>
    
    <input type="radio" id="number3" name="number" value="3">
    <label for="number3">3</label>
    
    <input type="radio" id="number4" name="number" value="4">
    <label for="number4">4</label>
    </form>

    <!-- Segundo formulario -->
    <form action="#" method="post" class="numberForm">
      <div class="numberBox" style="background-color: #8e44ad;">2</div>
    <input type="radio" id="number2_1" name="number" value="2">
    <label for="number2_1">2</label>

    <input type="radio" id="number2_5" name="number" value="5">
    <label for="number2_5">5</label>

    <input type="radio" id="number2_8" name="number" value="8">
    <label for="number2_8">8</label>

    <input type="radio" id="number2_10" name="number" value="10">
    <label for="number2_10">10</label>
    </form>

    <!-- Tercer formulario -->
    <form action="#" method="post" class="numberForm">
      <div class="numberBox" style="background-color: #1abc9c;">3</div>
    <input type="radio" id="number3_3" name="number" value="3">
    <label for="number3_3">3</label>

    <input type="radio" id="number3_6" name="number" value="6">
    <label for="number3_6">6</label>

    <input type="radio" id="number3_9" name="number" value="9">
    <label for="number3_9">9</label>

    <input type="radio" id="number3_12" name="number" value="12">
    <label for="number3_12">12</label>
</form>
    <!-- Botón de verificación -->
    <button type="button" onclick="verificarRespuestas()">Verificar</button>
  </div>

  <p id="puntuacion">Puntuación: <span id="puntos">0</span></p>

  <script>
    var respuestasCorrectas = ["1", "2", "3"];

    function verificarRespuestas() {
      var cuadrosNumero = document.querySelectorAll('.numberBox');
      var aciertos = 0;

      for (var i = 0; i < respuestasCorrectas.length; i++) {
        var respuestaCorrecta = respuestasCorrectas[i];
        var eleccionUsuario = document.querySelectorAll('.numberForm')[i].querySelector('input[name="number"]:checked');

        if (eleccionUsuario) {
          cuadrosNumero[i].style.backgroundColor = eleccionUsuario.value === respuestaCorrecta ? 'green' : 'red';

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
