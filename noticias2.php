<?php
require 'db_conection.php';

// Consulta SQL para selecionar todas as notícias
$stmt = $pdo->query("SELECT id, titulo, descricao, data_publicacao, imagem FROM noticias ORDER BY data_publicacao DESC");
$noticias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="./css/flexbox.css">
    <script src="./js/menu.js" defer></script>
    <title>Notícias</title>
    <link rel="stylesheet" type="text/css" href="css/noticias2.css">
</head>
<body>

<header>
        <div class="logo">
            <h1><i class="bi bi-headphones"></i>Feel<span>Song</span></h1>
        </div>
        <ul class="menu">
            <li><a href="flexbox.php">Home</a></li>
            <li><a href="musica.php">Músicas</a></li>
            <li><a href="noticias2.php">Notícias</a></li>
            <li><a href="promover.php">Promover</a></li>
        </ul>

        <div class="btn-abrir-menu" id="btn-menu">
                    <i class="bi bi-list"></i>
                </div>
                <div class="menu-mobile" id="menu-mobile">
                    <div class="btn-fechar">
                        <i class="bi bi-x-lg"></i>
                    </div>

                    <nav>
                        <ul>
                            <li><a href="flexbox.php">Home</a></li>
                            <li><a href="musica.php">Músicas</a></li>
                            <li><a href="noticias2.php">Notícias</a></li>
                            <li><a href="promover.php">Promover</a></li>
                            
                        </ul>  
                    </nav>
                </div>
                <div class="overlay-menu" id="overlay-menu">
                </div>
            </div>
    </header>


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
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


    <footer>
        <div class="geral">
            <div class="logo">
                <h1><i class="bi bi-headphones"></i>Feel<span>Song</span></h1>
            </div>
            <div class="redes-sociais">
                <a href="https://www.instagram.com/adolsocabeia2024/" target="_blank"><button><i class="bi bi-instagram"></i></button></a>
                <a href="https://www.youtube.com/@Adolfocabeia-vm1zn"><button><i class="bi bi-youtube"></i></button></a>
                <a href="https://www.linkedin.com/in/adolfo-cabeia-b989b6305/" target="_blank"><button><i class="bi bi-whatsapp"></i></button></a>
            </div>
        </div>
        
        <div class="copyright">
            Para mais informações: 928328205
        </div>

    </footer>

</body>
</html>
