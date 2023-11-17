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
    $tipo_test = "test_formas";

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
  <link rel="stylesheet" type="text/css" href="css/styles_formas.css">
  <link rel="icon" type="image/png" href="assets/logo.ico">
  <title>Test 3. Formas</title>
  <style>
    .shapeBox {
      width: 100px;
      height: 100px;
      margin-top: 10px; /* Hace que los elementos sean círculos */
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
  <h1> Test 3. Test de formas</h1>
<h2>Instrucciones</h2>
<h3>Selecciona el nombre correcto de la figura que se muestra</h3>
<h4>¿Cuál es la forma correcta?</h4>
    <!-- Formularios -->
    <!-- Primer formulario -->
    <form action="#" method="post" class="shapeForm">
      <div class="shapeBox"> <img class="shapeBox" src="assets/circulo.png" alt=""></div>
      <input type="radio" name="shape" value="circle"> Círculo
      <input type="radio" name="shape" value="square"> Cuadrado
      <input type="radio" name="shape" value="triangle"> Triángulo
      <input type="radio" name="shape" value="hexagon"> Hexágono
    </form>

    <!-- Segundo formulario -->
    <form action="#" method="post" class="shapeForm">
      <div class="shapeBox"><img class="shapeBox" src="assets/cuadrado.png" alt=""></div>
      <input type="radio" name="shape" value="cuadrado"> Cuadrado
      <input type="radio" name="shape" value="octagon"> Octágono
      <input type="radio" name="shape" value="star"> Estrella
      <input type="radio" name="shape" value="diamond"> Diamante
    </form>

    <!-- Tercer formulario -->
    <form action="#" method="post" class="shapeForm">
      <div class="shapeBox"><img class="shapeBox" src="assets/triangulo.png" alt=""></div>
      <input type="radio" name="shape" value="triangulo"> Triangulo
      <input type="radio" name="shape" value="arrow"> Flecha
      <input type="radio" name="shape" value="cross"> Cruz
      <input type="radio" name="shape" value="moon"> Luna
    </form>

    <!-- Botón de verificación -->
    <button type="button" onclick="verificarRespuestas()">Verificar</button>
  </div>

  <p id="puntuacion">Puntuación: <span id="puntos">0</span></p>

  <script>
    var respuestasCorrectas = ["circle", "cuadrado", "triangulo"];

    function verificarRespuestas() {
      var cuadrosForma = document.querySelectorAll('.shapeBox');
      var aciertos = 0;

      for (var i = 0; i < respuestasCorrectas.length; i++) {
        var respuestaCorrecta = respuestasCorrectas[i];
        var eleccionUsuario = document.querySelectorAll('.shapeForm')[i].querySelector('input[name="shape"]:checked');

        if (eleccionUsuario) {
          cuadrosForma[i].style.backgroundColor = eleccionUsuario.value;

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

