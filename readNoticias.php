<?php
require 'db_conection.php';

// Consulta SQL para selecionar todas as notícias
$stmt = $pdo->query("SELECT id, titulo, descricao, data_publicacao, imagem FROM noticias ORDER BY data_publicacao DESC");
$noticias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/noticias2.css">
    <title>Document</title>
</head>
<body>
<div class="container">
    <h2>Notícias</h2>
    <div class="news-cards">
        <?php foreach ($noticias as $noticia): ?>
            <div class="card">
                <?php if ($noticia['imagem']): ?>
                    <img src="data:image/jpeg;base64,<?= base64_encode($noticia['imagem']) ?>" alt="<?= htmlspecialchars($noticia['titulo']) ?>">
                <?php else: ?>
                    <img src="default-news-image.jpg" alt="Imagem da Notícia">
                <?php endif; ?>
                <div class="card-content">
                    <h3><?= htmlspecialchars($noticia['titulo']) ?></h3>
                    <p><?= htmlspecialchars($noticia['descricao']) ?></p>
                    <a href="detalheNoticia.php?id=<?= $noticia['id'] ?>" class="read-more-button">Leia mais</a>
                    <a href="updateNoticias.php?id=<?= $noticia['id'] ?>" class="update-button">Atualizar</a>
                    <form action="delete.php" method="post" class="delete-form">
                        <input type="hidden" name="id" value="<?= $noticia['id'] ?>">
                        <button type="submit" class="delete-button">Eliminar</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>

