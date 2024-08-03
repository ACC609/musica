<?php
require 'db_conection.php';

// Obtém o ID da notícia a partir da URL
$id = $_GET['id'];

// Consulta SQL para selecionar a notícia específica
$stmt = $pdo->prepare("SELECT * FROM noticias WHERE id = ?");
$stmt->execute([$id]);
$noticia = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $conteudo = $_POST['conteudo'];
    $data_publicacao = $_POST['data_publicacao'];
    $imagem = $_FILES['imagem'];

    // Verificar se todos os campos obrigatórios estão preenchidos
    if (!empty($titulo) && !empty($descricao) && !empty($conteudo) && !empty($data_publicacao)) {
        // Diretório onde as imagens serão salvas
        $diretorio = 'uploads/noticias/';

        // Verifica se o diretório de upload existe, senão cria
        if (!file_exists($diretorio)) {
            mkdir($diretorio, 0777, true);
        }

        $imagemNome = $noticia['imagem']; // Nome da imagem atual

        // Se uma nova imagem foi carregada
        if (!empty($imagem['name'])) {
            // Verifica se o arquivo é uma imagem válida
            $extensao = strtolower(pathinfo($imagem['name'], PATHINFO_EXTENSION));
            $extensoesValidas = ['jpg', 'jpeg', 'png', 'gif'];
            if (in_array($extensao, $extensoesValidas)) {
                // Nome do arquivo de imagem
                $imagemNome = $diretorio . basename($imagem['name']);

                // Salvar a nova imagem na pasta de uploads
                if (move_uploaded_file($imagem['tmp_name'], $imagemNome)) {
                    // A imagem foi carregada com sucesso
                    // Atualiza o nome da imagem no banco de dados
                    $imagemNome = basename($imagem['name']);
                } else {
                    echo "Erro ao fazer upload da nova imagem.";
                    exit;
                }
            } else {
                echo "O arquivo carregado não é uma imagem válida.";
                exit;
            }
        }

        // Preparar e executar a atualização no banco de dados
        $stmt = $pdo->prepare("UPDATE noticias SET titulo = ?, descricao = ?, conteudo = ?, data_publicacao = ?, imagem = ? WHERE id = ?");
        if ($stmt->execute([$titulo, $descricao, $conteudo, $data_publicacao, $imagemNome, $id])) {
            echo "Notícia atualizada com sucesso!";
        } else {
            echo "Erro ao atualizar notícia.";
        }
    } else {
        echo "Por favor, preencha todos os campos obrigatórios.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Notícia</title>
    <link rel="stylesheet" type="text/css" href="css/noticias.css">
</head>
<body>
    <div class="container">
        <a href="noticias.php" class="back-button">Voltar</a>
        <h2>Editar Notícia</h2>
        <form method="post" action="updateNoticias.php?id=<?= $id ?>" class="noticia-form" enctype="multipart/form-data">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" value="<?= htmlspecialchars($noticia['titulo']) ?>" required><br>

            <label for="descricao">Descrição:</label>
            <textarea name="descricao" id="descricao" required><?= htmlspecialchars($noticia['descricao']) ?></textarea><br>

            <label for="conteudo">Conteúdo:</label>
            <textarea name="conteudo" id="conteudo" required><?= htmlspecialchars($noticia['conteudo']) ?></textarea><br>

            <label for="data_publicacao">Data de Publicação:</label>
            <input type="date" name="data_publicacao" id="data_publicacao" value="<?= htmlspecialchars($noticia['data_publicacao']) ?>" required><br>

            <label for="imagem">Imagem:</label>
            <input type="file" name="imagem" id="imagem" accept="image/*"><br>
            <p>Imagem atual:</p>
            <img src="data:image/jpeg;base64,<?= base64_encode($noticia['imagem']) ?>" alt="<?= htmlspecialchars($noticia['titulo']) ?>" style="max-width: 200px;">

            <input type="submit" value="Atualizar" class="submit-button">
        </form>
    </div>
</body>
</html>
