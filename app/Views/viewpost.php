<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="<?= base_url('../../../assets/css/style.css'); ?>">
    <title>Visualizar Postagem</title>
</head>

<body>  
    

<!-- parte para exibir as imagens -->

    <?php if (!empty($post->imagem)): ?>
    <h3>Imagens:</h3>
    <img width="600"src="<?= base_url('assets/imgs/' . $post->imagem); ?>" alt="Imagem do Post">
    <?php endif; ?>

    <h1>Visualizar Postagem</h1>
    <h2><?= $post->title; ?></h2>
    <p><?= $post->content; ?></p>

  
    <a href="<?= site_url('post/delete/' . $post->id); ?>">Excluir</a>
    <a href="<?= site_url('blog'); ?>">Voltar para o blog</a>

    <?php if (session()->has('success')): ?>
        <br>
        <?= session()->getFlashdata('success'); ?>
    <?php endif; ?>

    <form action="<?= site_url('addComment'); ?>" method="post">
        <input type="hidden" name="post_id" value="<?= $post->id; ?>">
        <input type="hidden" name="user_id" value="<?= session()->get('user_id'); ?>">
        <textarea name="content" placeholder="Adicione seu comentário"></textarea>
        <button type="submit">Enviar Comentário</button>
    </form>

    <div class="comment-container">
        <?php if (!empty($comments)): ?>
            <h3>Comentários:</h3>
            <ul>
                <?php foreach ($comments as $comment): ?>
                    <li>
                        <?= $comment->content; ?>

                        <form action="<?= site_url('updateComment'); ?>" method="post">
                            <input type="hidden" name="comment_id" value="<?= $comment->id; ?>">
                            <textarea name="new_content" placeholder="Novo conteúdo do comentário"></textarea>
                            <button type="submit">Atualizar Comentário</button>
                        </form>

                        <form action="<?= site_url('deleteComment/' . $comment->id); ?>" method="post">
                            <button type="submit">Excluir Comentário</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Nenhum comentário ainda.</p>
        <?php endif; ?>
    </div>

</body>

</html>
