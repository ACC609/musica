<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Create</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h2 {
            color: #fff;
        }

        .container {
            background-color: #111;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 5px;
            text-align: center;
        }

        .menu {
            list-style-type: none;
            padding: 0;
            width: 400px;
        }

        .menu li {
            margin: 10px 0;
            width: 400px;
            height: 25px;

        }

        .menu a {
            text-decoration: none;
            color: #fff;
            font-size: 18px;
            text-align: center;
            transition: .2s linear;
        }

        .menu a:hover {
            color: #ccc;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Menu Create</h2>
        <ul class="menu">
            <li><a href="createMusica.php">Cadastrar Topo</a></li>
            <li><a href="readMusica.php">Listar Topo</a></li>
            <li><a href="recentes.php">Cadastrar Recentes</a></li>
            <li><a href="readRecentes.php">Listar Recentes</a></li>
            <li><a href="musica1.php">Cadastrar Musicas</a></li>
            <li><a href="readMusica1.php">Listar Musicas</a></li>
            <li><a href="noticias.php">Cadastrar Notícias</a></li>
            <li><a href="readNoticias.php">Listar Notícias</a></li>
        </ul>
    </div>
</body>

</html>