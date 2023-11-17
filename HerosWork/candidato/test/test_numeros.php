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
  <title>Formulario de Números</title>
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
  <div id="formulario">
    <h1>¿Cuál es el número correcto?</h1>

    <!-- Formularios -->
    <!-- Primer formulario -->
    <form action="#" method="post" class="numberForm">
      <div class="numberBox" style="background-color: #3498db;">1</div>
      <input type="radio" name="number" value="1"> 1
      <input type="radio" name="number" value="2"> 2
      <input type="radio" name="number" value="3"> 3
      <input type="radio" name="number" value="4"> 4
    </form>

    <!-- Segundo formulario -->
    <form action="#" method="post" class="numberForm">
      <div class="numberBox" style="background-color: #8e44ad;">2</div>
      <input type="radio" name="number" value="2"> 2
      <input type="radio" name="number" value="5"> 5
      <input type="radio" name="number" value="8"> 8
      <input type="radio" name="number" value="10"> 10
    </form>

    <!-- Tercer formulario -->
    <form action="#" method="post" class="numberForm">
      <div class="numberBox" style="background-color: #1abc9c;">3</div>
      <input type="radio" name="number" value="3"> 3
      <input type="radio" name="number" value="6"> 6
      <input type="radio" name="number" value="9"> 9
      <input type="radio" name="number" value="12"> 12
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


