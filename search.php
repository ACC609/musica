<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $search_query = isset($_GET['query']) ? $_GET['query'] : '';
    $search_query = '%' . strtolower($search_query) . '%'; 

    // Preparar a consulta SQL para busca case-insensitive
    $stmt = $pdo->prepare("SELECT * FROM musica1 WHERE LOWER(artista) LIKE :query OR LOWER(titulo) LIKE :query");
    $stmt->bindParam(':query', $search_query, PDO::PARAM_STR);
    $stmt->execute();

    $musicas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Codificar a imagem em base64 se existir
    foreach ($musicas as &$musica) {
        if (!empty($musica['imagem'])) {
            $musica['imagem'] = base64_encode($musica['imagem']);
        }
    }

    echo json_encode($musicas);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
