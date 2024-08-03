<?php
require 'db_conection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $artista = $_POST['artista'];
    $ano = $_POST['ano'];
    $genero = $_POST['genero'];
    $imagem = $_FILES['imagem'];
    $arquivo = $_FILES['arquivo'];

    // Verificar se todos os campos obrigatórios estão preenchidos
    if (!empty($titulo) && !empty($artista) && !empty($ano) && !empty($genero) && !empty($imagem['name']) && !empty($arquivo['name'])) {
        // Diretório onde as imagens e arquivos serão salvos
        $diretorio = 'uploads/recentes/';

        // Nome dos arquivos
        $imagemNome = $diretorio . basename($imagem['name']);
        $arquivoNome = $diretorio . basename($arquivo['name']);

        // Verifica se o diretório de upload existe, senão cria
        if (!file_exists($diretorio)) {
            mkdir($diretorio, 0777, true);
        }

        // Salvar a imagem e o arquivo na pasta de uploads
        if (move_uploaded_file($imagem['tmp_name'], $imagemNome) && move_uploaded_file($arquivo['tmp_name'], $arquivoNome)) {
            // Preparar e executar a inserção no banco de dados
            $stmt = $pdo->prepare("INSERT INTO recentes (titulo, artista, ano, genero, imagem, arquivo) VALUES (?, ?, ?, ?, ?, ?)");
            if ($stmt->execute([$titulo, $artista, $ano, $genero, file_get_contents($imagemNome), $arquivoNome])) {
                echo "Música criada com sucesso!";
            } else {
                echo "Erro ao criar música.";
            }
        } else {
            echo "Erro ao fazer upload dos arquivos.";
        }
    } else {
        echo "Por favor, preencha todos os campos obrigatórios.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Criar Música Recente</title>
    <link rel="stylesheet" type="text/css" href="./css/createMusica.css">
</head>
<body>
    <div class="container">
        <a href="MenuCreate.php" class="back-button">Voltar</a>
        <h2>Criar Música Recente</h2>
        <form method="post" action="recentes.php" class="music-form" enctype="multipart/form-data">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" required><br>

            <label for="artista">Artista:</label>
            <input type="text" name="artista" id="artista" required><br>

            <label for="ano">Ano:</label>
            <input type="number" name="ano" id="ano" required><br>

            <label for="genero">Gênero:</label>
            <input type="text" name="genero" id="genero" required><br>

            <label for="imagem">Imagem da Capa:</label>
            <input type="file" name="imagem" id="imagem" accept="image/*" required><br>

            <label for="arquivo">Arquivo da Música:</label>
            <input type="file" name="arquivo" id="arquivo" accept=".mp3" required><br>

            <input type="submit" value="Criar" class="submit-button">
        </form>
    </div>
</body>
</html>
