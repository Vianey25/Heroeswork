<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HeroesWork</title>
    <style>
        header {
    display: flex;
    background-color: #183146; /* Azul fuerte */
    min-height: 70px;
    justify-content: space-between;
    align-items: center;
    padding: 1px;
    color: white;
}
h1 {
    text-align: center;
    font-size: 40px;
    color: #000000; /* Azul fuerte */
}

h2 {
    text-align: center;
    font-size: 30px;
    color: #000000; /* Azul fuerte */
}

h3 {
    text-align: center;
    font-size: 20px;
    color: #000000; /* Azul fuerte */
    margin-bottom: -15px; /* Ajusta la cantidad de espacio entre h3 y h4 según sea necesario */
}

h4 {
    text-align: center;
    font-size: 30px;
    color: #000000; /* Azul fuerte */
}

.logo {
    display: flex;
    align-items: center;
}

.logo img {
    height: 60px;
    margin-left: 10px;
}

nav {
    margin-right: 10px;
}

nav a {
    font-weight: 600;
    font-size: 20px;
    margin-right: 10px;
    color: white;
    font-family: 'Ubuntu', sans-serif;
    text-decoration: none;
    transition: color 0.3s ease; /* Agregado para una transición suave del color al pasar el ratón */
}

nav a:last-child {
    margin-left: auto;
}

nav a:hover {
    color: #D5D8DC;
}
.numberForm {
    margin-top: 20px;
}
p{
    margin-left: 10px;
    font-family: 'Ubuntu', sans-serif;
    font-weight: 600;
    font-size: 20px;
}
.numberBox {
    width: 100px;
    height: 100px;
    margin-top: 10px; /* Espaciado entre los elementos */
    display: inline-block;
    text-align: center;
    line-height: 100px;
    font-size: 24px;
    color: white;
    font-weight: bold;
    cursor: pointer;
}

input[type="radio"] {
    margin-right: 5px;
}

button {
    margin-top: 20px;
    padding: 10px 20px;
    font-size: 16px;
    background-color: #3498db; /* Azul suave */
    color: #ffffff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease; /* Agregado para un efecto suave al pasar el ratón */
}

button:hover {
    background-color: #183146; /* Cambio de color al pasar el ratón */
}

#puntuacion {
    text-align: center;
    margin-top: 20px;
    font-size: 18px;
}

#puntos {
    color: #800080; /* Morado */
    font-weight: bold;
}
    </style>
</head>
<body>
<header>
      <div class="logo">
          <img src="assets/logo.png" alt="Logo"> <p class="hero">HeroesWork</p>
      </div>
      <nav>
          <a href="#"></a>
          <a href="#"></a>
          <a href="#"></a>
      </nav>
  </header>
<?php
session_start();

if (isset($_SESSION['id_candidato'])) {
    $candidatoID = $_SESSION['id_candidato'];
    include('../conexion.php');

    $sql = "SELECT * FROM test WHERE id_candidato = $candidatoID";
    $result = $conexion->query($sql);

    // Array to store complet   ed tests
    $completedTests = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Store completed tests in the array
            $completedTests[$row['tipo_test']] = $row['resultado'];
        }
    }

    // Check and display results for each test type
    echo "<h1>Resultados de tests:</h1>";
    
    if (isset($completedTests['test_colores'])) {
        echo "<p>Test de Colores: " . $completedTests['test_colores'] . "</p>";
    } else {
        echo "<a href='test_colores.php'><h2>Test de Colores</h2></a>";
    }

    if (isset($completedTests['test_formas'])) {
        echo "<p>Test de Formas: " . $completedTests['test_formas'] . "</p>";
    } else {
        echo "<a href='test_formas.php'><h2>Test de Formas</h2></a>";
    }

    if (isset($completedTests['test_numeros'])) {
        echo "<p>Test de Números: " . $completedTests['test_numeros'] . "</p>";
    } else {
        echo "<a href='test_numeros.php'><h2>Test de Números</h2></a>";
    }
    if (isset($completedTests['test_voz'])) {
        echo "<p>Test de Voz: " . $completedTests['test_voz'] . "</p>";
    } else {
        echo "<a href='test_voz.php'><h2>Test de Voz</h2></a>";
    }

    $conexion->close();
} else {
    echo "La sesión no está configurada.";
}
?>

<h4><a href="../index.php">Regresar</a></h4>
    
</body>
</html>