<?php
require 'db_conection.php';

// Verificar se o ID foi fornecido na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta SQL para selecionar a música pelo ID
    $stmt = $pdo->prepare("SELECT * FROM recentes WHERE id = ?");
    $stmt->execute([$id]);

    // Obter a música como um array associativo
    $musica = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$musica) {
        echo "Música não encontrada.";
        exit;
    }
} else {
    echo "ID da música não fornecido.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $artista = $_POST['artista'];
    $ano = $_POST['ano'];
    $genero = $_POST['genero'];
    $imagem = $_FILES['imagem'];
    $arquivo = $_FILES['arquivo'];

    // Verificar se todos os campos obrigatórios estão preenchidos
    if (!empty($titulo) && !empty($artista) && !empty($ano) && !empty($genero)) {
        // Diretório onde as imagens e arquivos serão salvos
        $diretorio = 'uploads/recentes/';

        // Nome dos arquivos
        $imagemNome = !empty($imagem['name']) ? $diretorio . basename($imagem['name']) : null;
        $arquivoNome = !empty($arquivo['name']) ? $diretorio . basename($arquivo['name']) : null;

        // Verifica se o diretório de upload existe, senão cria
        if (!file_exists($diretorio)) {
            mkdir($diretorio, 0777, true);
        }

        // Atualizar a imagem se uma nova foi enviada
        if ($imagemNome && move_uploaded_file($imagem['tmp_name'], $imagemNome)) {
            $imagemConteudo = file_get_contents($imagemNome);
        } else {
            $imagemConteudo = $musica['imagem'];
        }

        // Atualizar o arquivo de música se um novo foi enviado
        if ($arquivoNome && move_uploaded_file($arquivo['tmp_name'], $arquivoNome)) {
            $arquivoCaminho = $arquivoNome;
        } else {
            $arquivoCaminho = $musica['arquivo'];
        }

        // Preparar e executar a atualização no banco de dados
        $stmt = $pdo->prepare("UPDATE recentes SET titulo = ?, artista = ?, ano = ?, genero = ?, imagem = ?, arquivo = ? WHERE id = ?");
        if ($stmt->execute([$titulo, $artista, $ano, $genero, $imagemConteudo, $arquivoCaminho, $id])) {
            echo "Música atualizada com sucesso!";
        } else {
            echo "Erro ao atualizar música.";
        }
    } else {
        echo "Por favor, preencha todos os campos obrigatórios.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Atualizar Música Recente</title>
    <link rel="stylesheet" type="text/css" href="./css/createMusica.css">
</head>

<body>
    <div class="container">
        <a href="MenuCreate.php" class="back-button">Voltar</a>
        <h2>Atualizar Música Recente</h2>
        <form method="post" action="updateRecentes.php?id=<?= $id ?>" class="music-form" enctype="multipart/form-data">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" value="<?= htmlspecialchars($musica['titulo']) ?>" required><br>

            <label for="artista">Artista:</label>
            <input type="text" name="artista" id="artista" value="<?= htmlspecialchars($musica['artista']) ?>" required><br>

            <label for="ano">Ano:</label>
            <input type="number" name="ano" id="ano" value="<?= htmlspecialchars($musica['ano']) ?>" required><br>

            <label for="genero">Gênero:</label>
            <input type="text" name="genero" id="genero" value="<?= htmlspecialchars($musica['genero']) ?>" required><br>

            <label for="imagem">Imagem da Capa (deixe em branco para manter a imagem atual):</label>
            <input type="file" name="imagem" id="imagem" accept="image/*"><br>

            <p>Imagem atual:</p>
            <img src="data:image/jpeg;base64,<?= base64_encode($musica['imagem']) ?>" alt="<?= htmlspecialchars($musica['titulo']) ?>" style="max-width: 200px;">

            <label for="arquivo">Arquivo da Música (deixe em branco para manter o arquivo atual):</label>
            <input type="file" name="arquivo" id="arquivo" accept=".mp3"><br>

            <input type="submit" value="Atualizar" class="submit-button">
        </form>
    </div>
</body>

</html>