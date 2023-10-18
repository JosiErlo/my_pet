<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Supondo que você tenha uma variável de sessão 'user_id' que armazene o ID do usuário
if (isset($_SESSION['user_id'])) {
    $userID = $_SESSION['user_id'];
} else {
    // Lida com a situação em que 'user_id' não está definido
    // Pode redirecionar o usuário ou executar alguma outra ação apropriada.
    $userID = 0; // Defina um valor padrão ou ação apropriada
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Visualizar Postagem</title>
</head>

<body>
    <h1>Visualizar Postagem</h1>

    <h2><?= $post['title']; ?></h2>
    <p><?= $post['content']; ?></p>

    <a href="<?= site_url('blog'); ?>">Voltar para o blog</a>

    <form action="<?= site_url('comment/add'); ?>" method="post">
        <input type="hidden" name="user_id" value="<?= $userID ?>">
        <input type="hidden" name="post_id" value="<?= $post['id']; ?>">
        <textarea name="content" placeholder="Adicione seu comentário"></textarea>
        <button type="submit">Enviar Comentário</button>
    </form>

    <!-- Exiba a lista de comentários associados à postagem -->
   <!-- Seção de comentários -->
<div class="comments-section">
    <?php if (!empty($comments)) : ?>
        <h2>Comentários:</h2>
        <ul>
            <?php foreach ($comments as $comment) : ?>
                <li>
                    <p><?= $comment['content']; ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>Nenhum comentário ainda.</p>
    <?php endif; ?>
</div>

</body>

</html>
