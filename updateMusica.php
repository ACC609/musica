<?php
require 'db_conection.php';

// Verifica se um ID foi passado na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta SQL para selecionar a música pelo ID
    $stmt = $pdo->prepare("SELECT * FROM musicas WHERE id = ?");
    $stmt->execute([$id]);
    $musica = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se a música foi encontrada
    if (!$musica) {
        die("Música não encontrada.");
    }

    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $titulo = $_POST['titulo'];
        $artista = $_POST['artista'];
        $ano = $_POST['ano'];
        $genero = $_POST['genero'];
        $imagem = $_FILES['imagem'];
        $arquivo = $_FILES['arquivo'];

        // Atualiza a imagem se um novo arquivo foi enviado
        if (!empty($imagem['name'])) {
            $imagemNome = 'uploads/musicas/' . basename($imagem['name']);
            move_uploaded_file($imagem['tmp_name'], $imagemNome);
        } else {
            $imagemNome = $musica['imagem'];
        }


        if (!empty($arquivo['name'])) {
            $arquivoNome = 'uploads/musicas/' . basename($arquivo['name']);
            move_uploaded_file($arquivo['tmp_name'], $arquivoNome);
        } else {
            $arquivoNome = $musica['arquivo'];
        }


        $stmt = $pdo->prepare("UPDATE musicas SET titulo = ?, artista = ?, ano = ?, genero = ?, imagem = ?, arquivo = ? WHERE id = ?");
        if ($stmt->execute([$titulo, $artista, $ano, $genero, $imagemNome, $arquivoNome, $id])) {
            echo "Música atualizada com sucesso!";
        } else {
            echo "Erro ao atualizar música.";
        }
    }
} else {
    die("ID de música não fornecido.");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Música</title>
    <link rel="stylesheet" type="text/css" href="./css/createMusica.css">
</head>

<body>
    <div class="container">
        <a href="readMusica.php" class="back-button">Voltar</a>
        <h2>Editar Música</h2>
        <form method="post" action="updateMusica.php?id=<?= $id ?>" class="music-form" enctype="multipart/form-data">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" value="<?= htmlspecialchars($musica['titulo']) ?>" required><br>

            <label for="artista">Artista:</label>
            <input type="text" name="artista" id="artista" value="<?= htmlspecialchars($musica['artista']) ?>" required><br>

            <label for="ano">Ano:</label>
            <input type="number" name="ano" id="ano" value="<?= htmlspecialchars($musica['ano']) ?>" required><br>

            <label for="genero">Gênero:</label>
            <input type="text" name="genero" id="genero" value="<?= htmlspecialchars($musica['genero']) ?>" required><br>

            <label for="imagem">Imagem da Capa:</label>
            <input type="file" name="imagem" id="imagem" accept="image/*"><br>
            <img src="<?= htmlspecialchars($musica['imagem']) ?>" alt="Imagem atual" style="max-width: 100px;">

            <label for="arquivo">Arquivo da Música:</label>
            <input type="file" name="arquivo" id="arquivo" accept=".mp3"><br>
            <a href="<?= htmlspecialchars($musica['arquivo']) ?>" download>Download arquivo atual</a>

            <input type="submit" value="Atualizar" class="submit-button">
        </form>
    </div>
</body>

</html>