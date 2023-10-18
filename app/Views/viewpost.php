<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
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
    <div class="comment-container">
        <?php if (!empty($comments)) : ?>
            <h3>Comentários:</h3>
            <ul>
                <?php foreach ($comments as $comment) : ?>
                    <li><?= $comment['content']; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>Nenhum comentário ainda.</p>
        <?php endif; ?>
    </div>
