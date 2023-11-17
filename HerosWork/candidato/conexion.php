<?php

    // Conectar a la base de datos (reemplaza con tus propios datos de conexión)
    $conexion = new mysqli("localhost", "root", "12345", "heroeswork");

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

?>