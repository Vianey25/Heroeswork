<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HeroesWork</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Ubuntu', sans-serif;  
            background-color: #f4f4f4;
        }
        h1{ font-size: 3em;font-family: 'Ubuntu', sans-serif;   }
        h2{ font-size: 1.8em; font-family: 'Ubuntu', sans-serif;  }
        h3{ font-size: 2em; font-family: 'Ubuntu', sans-serif;  }
        p{ font-size: 1.25em; font-family: 'Ubuntu', sans-serif;  }
        ul{ list-style: none;font-family: 'Ubuntu', sans-serif;  }
        li{ font-size: 1.25em; font-family: 'Ubuntu', sans-serif;  }

        /*Header*/
        a {
            text-decoration: none;
            color: white;

        }
        header{
            display: flex;
            background-color: #183146;
            min-height: 70px;
            justify-content: space-between;
            align-items: center;
            padding: 1px;
            color: white; 
            
        }
        .logo {
            display: flex;
            align-items: center;
        }

        .logo img{
            height: 45px;
            margin-right: 10px;
        }

        nav a {
            font-weight: 600;
            font-size: 20px;
            margin-right: 50px;
            color: white;
            font-family: 'Ubuntu', sans-serif; 
            text-decoration: none; /* Elimina el subrayado predeterminado de los enlaces */
            padding: 10px 15px; /* Añade un relleno alrededor del texto para que parezca un botón */
            border-radius: 15px; /* Añade esquinas redondeadas */
            transition: background-color 0.3s; 
                }

        nav a:hover {
            color: #6F9EB1;
        }

        main {
          
            padding: 20px;
            max-width: 70%;
            
            margin: 0 auto;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            
        }

        footer {
            background-color: #9b77da;
            color: white;
            text-align: center;
            padding: 1em;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

<<<<<<< HEAD
     
=======
        .profile-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
>>>>>>> e4080c23a051112ac05cd915c04f129be7b06472

     

        ul {
            list-style-type: none;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
           
        }

        li {
            width: calc(33.33% - 20px);
            margin-bottom: 20px;
            border: 1px solid #ddd;
            padding: 10px;
            background-color: #fff;
            border-radius: 5px;
            box-sizing: border-box;
        }

        h3 {
            font-size: 18px;
            margin-bottom: 8px;
        }

        p {
            font-size: 14px;
            color: #555;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 3px;
            display: block;
            margin-top: 10px;
        }

        button:hover {
            background-color: #45a049;
        }
        footer{
        background-color: rgba(230,230,230);
        }
        footer p{   
            font-size: 1.2em;
            margin: 0;
            color: rgb(100,100,100)
        }
        footer .container{
            height: 5px;
            padding: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>
<!-- Dentro del header -->
<header>
    <div class="logo">
      <img src="img/circulo.png" alt="">
      <h2 class="nombre-empresa">HEROESWORK</h2>

    </div>
    <nav>
      <a href="test/test.php">Realiza tus test</a>
      
      <a href="perfil.php" ">Perfil</a>
      
    </nav>
  </header>
    <h1>Vacantes</h1>
    <a href="test/test.php" style="color: white;">Realiza tus test</a>
    <a href="perfil.php"><button class="profile-button">Perfil</button></a>
</header>


    <main>
        <h2>Solicitudes Enviadas</h2>
        
        <?php

            // Iniciar la sesión
            session_start();

            // Verificar si la sesión está configurada
            if (isset($_SESSION['id_candidato'])) {
                // Obtener el ID del candidato desde la sesión
                $candidatoID = $_SESSION['id_candidato'];
            }

            // Incluir el archivo de conexión
            include('conexion.php');

            // Consulta para obtener datos de la tabla Vacantes
            $consulta = "SELECT * FROM solicitud WHERE id_candidato = '$candidatoID'";
            $resultado = $conexion->query($consulta);

            // Mostrar los datos en la página
            if ($resultado->num_rows > 0) {
                echo "<ul>";
                while ($fila = $resultado->fetch_assoc()) {
                    // Obtener el título de la vacante mediante una segunda consulta
                    $idVacante = $fila["id_vacante"];
                    $consultaVacante = "SELECT titulo FROM vacantes WHERE id_vacante = '$idVacante'";
                    $resultadoVacante = $conexion->query($consultaVacante);
                    
                    if ($resultadoVacante->num_rows > 0) {
                        $filaVacante = $resultadoVacante->fetch_assoc();
                        $tituloVacante = $filaVacante["titulo"];
                    } else {
                        // Manejar el caso en que no se encuentre la vacante
                        $tituloVacante = "Vacante no encontrada";
                    }

                    // Mostrar los datos en la página
                    echo "<li>";
                    echo "<h3>" . $tituloVacante . "</h3>";
                    echo "<p> Estado: " . $fila["estado"] . "</p>";
                    echo "</li>";
                }
                echo "</ul>";
            } else {
                echo "No hay solicitudes.";
            }

            // Cerrar la conexión
            $conexion->close();
        ?>
        <h2>Vacantes Disponibles</h2>

        <?php
    // Incluir el archivo de conexión
    include('conexion.php');

    // Obtener el id_candidato (asegúrate de tener esta variable antes de la consulta)
    $id_candidato = $candidatoID; // Reemplaza esto con la forma en que obtienes el id_candidato

    // Consulta para obtener datos de la tabla Vacantes excluyendo las ya solicitadas por el candidato
    $consulta = "SELECT * FROM vacantes v
                 WHERE NOT EXISTS (
                    SELECT 1 FROM solicitud s
                    WHERE s.id_vacante = v.id_vacante
                    AND s.id_candidato = $id_candidato
                 )";

    $resultado = $conexion->query($consulta);

    // Mostrar los datos en la página
    if ($resultado->num_rows > 0) {
        echo "<ul>";
        while ($fila = $resultado->fetch_assoc()) {
            echo "<li>";
            echo "<h3>" . $fila["titulo"] . "</h3>";
            echo "<p>" . $fila["descripcion"] . "</p>";
            echo "<a href='ver_vacante.php?id=" . $fila["id_vacante"] . "'><button>Ver más</button></a>";
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "No hay vacantes disponibles.";
    }

    // Cerrar la conexión
    $conexion->close();
?>


</main>

    <footer>
    <div class="container">
      <p>&copy; Heroeswork 2023</p>
    </div>
  </footer>
</body>
</html>
