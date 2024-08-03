<?php
require 'db_conection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    // Verifica se a música existe antes de deletar
    $stmt = $pdo->prepare("SELECT * FROM musicas WHERE id = ?");
    $stmt->execute([$id]);
    $musica = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($musica) {
        // Deleta os arquivos associados (imagem e arquivo de música)
        if (file_exists($musica['imagem'])) {
            unlink($musica['imagem']);
        }
        if (file_exists($musica['arquivo'])) {
            unlink($musica['arquivo']);
        }

        // Deleta a música do banco de dados
        $stmt = $pdo->prepare("DELETE FROM musicas WHERE id = ?");
        if ($stmt->execute([$id])) {
            echo "Música eliminada com sucesso!";
        } else {
            echo "Erro ao eliminar música.";
        }
    } else {
        echo "Música não encontrada.";
    }
} else {
    echo "Método de requisição inválido.";
}
?>
