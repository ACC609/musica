<?php
require 'db_conection.php'; 

// Consulta SQL para selecionar todas as músicas
$stmt = $pdo->query("SELECT * FROM musicas");

// Obtém todas as músicas como um array associativo
$musicas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Músicas</title>
    <link rel="stylesheet" type="text/css" href="css/read.css"> <!-- Adicione o caminho para o seu arquivo CSS -->
</head>
<body>
    <div class="container">
        <a href="MenuCreate.php" class="back-button">Voltar</a>
        <h2>MÚSICAS DISPONÍVEIS</h2>
        <div class="music-cards">
            <?php foreach ($musicas as $musica): ?>
                <div class="card">
                    <?php if ($musica['imagem']): ?>
                        <img src="<?= htmlspecialchars($musica['imagem']) ?>" alt="<?= htmlspecialchars($musica['titulo']) ?>">
                    <?php else: ?>
                        <img src="default-music-image.jpg" alt="Imagem da Música">
                    <?php endif; ?>
                    <div class="card-content">
                        <h3><?= htmlspecialchars($musica['titulo']) ?></h3>
                        <p><strong>Artista:</strong> <?= htmlspecialchars($musica['artista']) ?></p>
                        <p><strong>Ano:</strong> <?= htmlspecialchars($musica['ano']) ?></p>
                        <p><strong>Gênero:</strong> <?= htmlspecialchars($musica['genero']) ?></p>
                        <a href="<?= htmlspecialchars($musica['arquivo']) ?>" download class="download-button">Download</a>
                        <div class="button-group">
                            <a href="updateMusica.php?id=<?= $musica['id'] ?>" class="update-button">Atualizar</a>
                            <form method="post" action="deleteMusica.php" class="delete-form">
                                <input type="hidden" name="id" value="<?= $musica['id'] ?>">
                                <button type="submit" class="delete-button" onclick="return confirm('Tem certeza que deseja eliminar esta música?')">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
