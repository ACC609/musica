<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="./css/flexbox.css">
    <link rel="stylesheet" href="./css/music.css">
    <script src="./js/menu.js" defer></script>
    <script src="./js/search.js" defer></script>
    <title>Música</title>
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

    <div class="search">
        <i class="bi bi-search"></i>
        <input type="text" name="" id="search-input" placeholder="Pesquisar Música">
        <button id="search-button">Pesquisar</button>
    </div>

    <div id="results-container"></div>



    <?php
    require 'db_conection.php';

    // Consulta SQL para selecionar todas as músicas
    $stmt = $pdo->query("SELECT * FROM musica1");

    // Obtém todas as músicas como um array associativo
    $musicas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="music-cards4">
        <?php foreach ($musicas as $musica) : ?>
            <div class="card4">
                <?php if ($musica['imagem']) : ?>
                    <img src="data:image/jpeg;base64,<?= base64_encode($musica['imagem']) ?>" alt="<?= htmlspecialchars($musica['titulo']) ?>">
                <?php else : ?>
                    <img src="default-music-image.jpg" alt="Imagem da Música">
                <?php endif; ?>
                <div class="card-content4">
                    <h3><?= htmlspecialchars($musica['titulo']) ?></h3>
                    <p><strong>Artista:</strong> <?= htmlspecialchars($musica['artista']) ?></p>
                    <p><strong>Ano:</strong> <?= htmlspecialchars($musica['ano']) ?></p>
                    <p><strong>Gênero:</strong> <?= htmlspecialchars($musica['genero']) ?></p>
                    <a href="<?= htmlspecialchars($musica['arquivo']) ?>" download class="download-button">Download</a>
                </div>
            </div>
        <?php endforeach; ?>
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