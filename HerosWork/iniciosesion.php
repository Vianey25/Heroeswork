<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heroeswork - Iniciar Sesión</title>
    <style>
        body {
            font-family: 'Ubuntu', sans-serif;
            background-color: #35355E;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h2 {
            text-align: center;
            font-family: 'Ubuntu', sans-serif;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

       
        .button{
            font-size: 1.5em;
            font-weight: bold;
            border-radius: 10px;
            padding: 10px 20px;
            box-shadow: 2px 2px 10px rgba(0,0,0,0.5);
            color: white;
            background-color: #183146;
        }
<<<<<<< HEAD
        .button:hover{
            background-color:#6FA5B1;
=======

        input[type="submit"]:hover {
            background-color: #4e6b9f;
        },
        a {
            text-decoration: none;
            display: block;
            margin-top: 10px;
            color: #3498db;
        }

        button {
            background-color: #3498db;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9;
>>>>>>> e4080c23a051112ac05cd915c04f129be7b06472
        }
    </style>
</head>
<body>
<div class="container">
    <form action="login.php" method="post">
        <h2>Iniciar Sesión</h2>
        
        <label for="username">Usuario:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>

<<<<<<< HEAD
        <input type="submit" class="button" value="Iniciar Sesión">
=======
        <input type="submit" value="Iniciar Sesión">

>>>>>>> e4080c23a051112ac05cd915c04f129be7b06472
    </form>
    <br>
    <a href="index.php"><button>Volver a Inicio</button></a>
    </div>
  

 

</body>
</html>
