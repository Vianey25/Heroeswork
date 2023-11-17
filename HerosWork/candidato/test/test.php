<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HeroesWork</title>
</head>
<body>
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