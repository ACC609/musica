<?php
require 'db_conection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $conteudo = $_POST['conteudo'];
    $data_publicacao = $_POST['data_publicacao'];
    $imagem = $_FILES['imagem'];

    // Verificar se todos os campos obrigatórios estão preenchidos
    if (!empty($titulo) && !empty($descricao) && !empty($conteudo) && !empty($data_publicacao) && !empty($imagem['name'])) {
        // Diretório onde as imagens serão salvas
        $diretorio = 'uploads/noticias/';

        // Nome do arquivo de imagem
        $imagemNome = $diretorio . basename($imagem['name']);

        // Verifica se o diretório de upload existe, senão cria
        if (!file_exists($diretorio)) {
            mkdir($diretorio, 0777, true);
        }

        // Salvar a imagem na pasta de uploads
        if (move_uploaded_file($imagem['tmp_name'], $imagemNome)) {
            // Preparar e executar a inserção no banco de dados
            $stmt = $pdo->prepare("INSERT INTO noticias (titulo, descricao, conteudo, data_publicacao, imagem) VALUES (?, ?, ?, ?, ?)");
            if ($stmt->execute([$titulo, $descricao, $conteudo, $data_publicacao, file_get_contents($imagemNome)])) {
                echo "Notícia criada com sucesso!";
            } else {
                echo "Erro ao criar notícia.";
            }
        } else {
            echo "Erro ao fazer upload da imagem.";
        }
    } else {
        echo "Por favor, preencha todos os campos obrigatórios.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Criar Notícia</title>
    <link rel="stylesheet" type="text/css" href="css/noticias.css">
</head>
<body>
    <div class="container">
        <a href="MenuCreate.php" class="back-button">Voltar</a>
        <h2>Criar Notícia</h2>
        <form method="post" action="noticias.php" class="noticia-form" enctype="multipart/form-data">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" required><br>

            <label for="descricao">Descrição:</label>
            <textarea name="descricao" id="descricao" required></textarea><br>

            <label for="conteudo">Conteúdo:</label>
            <textarea name="conteudo" id="conteudo" required></textarea><br>

            <label for="data_publicacao">Data de Publicação:</label>
            <input type="date" name="data_publicacao" id="data_publicacao" required><br>

            <label for="imagem">Imagem:</label>
            <input type="file" name="imagem" id="imagem" accept="image/*" required><br>

            <input type="submit" value="Criar" class="submit-button">
        </form>
    </div>
</body>
</html>
