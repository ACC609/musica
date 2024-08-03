<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="author" content="Adolfo Cabeia">
    <meta name="keywords" content="PHP, CSS, MY SQL, Js">
    <meta name="description" content="Blog">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="./css/flexbox.css">
    <script src="./js/menu.js" defer></script>
    <script src="./js/search.js" defer></script>
    <script src="./js/scripts.js" defer></script>
    <title>Blog</title>
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
    <section class="hero-site">
        <img src="./img/black.png" alt="">
        <div class="txt">
            <h2>Feel the Music <span>Download the Vibes!</span></h2>
        </div>
    </section>
    <section>
        <div class="container">
            <?php
            require 'db_conection.php';

            // Consulta SQL para selecionar todas as músicas
            $stmt = $pdo->query("SELECT * FROM musicas");

            // Obtém todas as músicas como um array associativo
            $musicas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div class="music-cards">
                <?php foreach ($musicas as $musica) : ?>
                    <div class="card">
                        <?php if ($musica['imagem']) : ?>
                            <img src="<?= htmlspecialchars($musica['imagem']) ?>" alt="<?= htmlspecialchars($musica['titulo']) ?>">
                        <?php else : ?>
                            <img src="default-music-image.jpg" alt="Imagem da Música">
                        <?php endif; ?>
                        <div class="card-content">
                            <h3><?= htmlspecialchars($musica['titulo']) ?></h3>
                            <p><strong>Artista:</strong> <?= htmlspecialchars($musica['artista']) ?></p>
                            <a href="<?= htmlspecialchars($musica['arquivo']) ?>" download class="download-button">Download</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
    </section>

    <section class="destaques">
        <div class="interface">
            <h3>Música mais baixada:</h3>
            <p>Wonder Creezy(Star)</p>
            <a href="https://encurtador.com.br/y8PEd" target="_blank"><button>Download</button></a>
            </a>
        </div>
        <div class="overlay"></div>
    </section>
    <section class="recentes">
        <div class="recentes">
            <?php
            require 'db_conection.php';

            // Consulta SQL para selecionar todas as músicas recentes
            $stmt = $pdo->query("SELECT * FROM recentes");

            // Obtém todas as músicas recentes como um array associativo
            $musicas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>
        </div>
        <h2>Postagens Recentes</h2>
        <div class="music-cards2">
            <?php foreach ($musicas as $musica) : ?>
                <div class="card2">
                    <?php if ($musica['imagem']) : ?>
                        <img src="data:image/jpeg;base64,<?= base64_encode($musica['imagem']) ?>" alt="<?= htmlspecialchars($musica['titulo']) ?>">
                    <?php else : ?>
                        <img src="default-music-image.jpg" alt="Imagem da Música">
                    <?php endif; ?>
                    <div class="card-content2">
                        <h3><?= htmlspecialchars($musica['titulo']) ?></h3>
                        <p><strong>Artista:</strong> <?= htmlspecialchars($musica['artista']) ?></p>
                        <p><strong>Ano:</strong> <?= htmlspecialchars($musica['ano']) ?></p>
                        <p><strong>Gênero:</strong> <?= htmlspecialchars($musica['genero']) ?></p>
                        <a href="<?= htmlspecialchars($musica['arquivo']) ?>" download class="download-button">Download</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </section>


    <section class="baixar">
        <div class="interface">
            <h3>Destaque Mensal:</h3>
            <p>Phedilson ft Prodígio ft Dji Tafinha & Sidjay(Eterno)</p>
            <a href="#"><button>Download</button></a>
            </a>
        </div>
        <div class="overlay"></div>
    </section>

    <h2>Album's e EP's</h2>
    <section class="last">

        <div class="album">
            <div class="card3">
                <img src="./img/bv.jpg" alt="Capa do Álbum" class="album-cover">
                <div class="album-details">
                    <h3 class="album-title">Título do Álbum: Hegemonia</h3>
                    <p class="album-artist">Artista: Gerilson Insrael</p>
                    <p class="album-release-date">Data de Lançamento: 2024</p>
                    <p class="album-genre">Gênero: Zouk</p>
                    <p class="album-genre"><strong>Faixas:10</strong> </p>
                    <a href="./downloads/album_hegemonia.zip" class="download-button">Download</a>
                </div>
            </div>
        </div>
        <div class="album">
            <div class="card3">
                <img src="./img/xuxu.jpeg" alt="Capa do Álbum" class="album-cover">
                <div class="album-details">
                    <h3 class="album-title">Título do Álbum: SMS'4</h3>
                    <p class="album-artist">Artista: Xuxu Bower</p>
                    <p class="album-release-date">Data de Lançamento: 2023</p>
                    <p class="album-genre">Gênero: Rap</p>
                    <p class="album-genre"><strong>Faixas:11</strong> </p>
                    <a href="./downloads/album_hegemonia.zip" class="download-button">Download</a>
                </div>
            </div>
        </div>
        <div class="album">
            <div class="card3">
                <img src="./img/uami.jpeg" alt="Capa do Álbum" class="album-cover">
                <div class="album-details">
                    <h3 class="album-title">Título do EP: Crânio</h3>
                    <p class="album-artist">Artista: Uami Ndogadas</p>
                    <p class="album-release-date">Data de Lançamento: 2023</p>
                    <p class="album-genre">Gênero: Rap</p>
                    <p class="album-genre"><strong>Faixas:9</strong> </p>
                    <a href="./downloads/album_hegemonia.zip" class="download-button">Download</a>
                </div>
            </div>
        </div>
        <div class="album">
            <div class="card3">
                <img src="./img/paulo.jpeg" alt="Capa do Álbum" class="album-cover">
                <div class="album-details">
                    <h3 class="album-title">Título do Álbum: Independência</h3>
                    <p class="album-artist">Artista: Paulo Flores</p>
                    <p class="album-release-date">Data de Lançamento: 2024</p>
                    <p class="album-genre">Gênero: Semba</p>
                    <p class="album-genre"><strong>Faixas: 10</strong> </p>
                    <a href="./downloads/album_hegemonia.zip" class="download-button">Download</a>
                </div>
            </div>
        </div>
        <div class="album">
            <div class="card3">
                <img src="./img/cage.jpeg" alt="Capa do Álbum" class="album-cover">
                <div class="album-details">
                    <h3 class="album-title">Título do Álbum: King Raising a queen</h3>
                    <p class="album-artist">Artista: Cage One & Elisabeth Ventura</p>
                    <p class="album-release-date">Data de Lançamento: 2023</p>
                    <p class="album-genre">Gênero: Rap</p>
                    <p class="album-genre"><strong>Faixas:17</strong> </p>
                    <a href="./downloads/album_hegemonia.zip" class="download-button">Download</a>
                </div>
            </div>
        </div>
        <div class="album">
            <div class="card3">
                <img src="./img/3.jpg" alt="Capa do Álbum" class="album-cover">
                <div class="album-details">
                    <h3 class="album-title">Título do Álbum: Diamante</h3>
                    <p class="album-artist">Artista: 3Finner</p>
                    <p class="album-release-date">Data de Lançamento: 2024</p>
                    <p class="album-genre">Gênero: Zouk</p>
                    <p class="album-genre"><strong>Faixas:11</strong> </p>
                    <a href="./downloads/album_hegemonia.zip" class="download-button">Download</a>
                </div>
            </div>
        </div>

    </section>

    <div class="search">
        <i class="bi bi-search"></i>
        <input type="text" name="" id="search-input" placeholder="Pesquisar Música">
        <button id="search-button">Pesquisar</button>
    </div>
    <div id="results-container"></div>



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