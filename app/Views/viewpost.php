<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<head>
    <!-- Link para o arquivo de estilo CSS -->
    <link rel="stylesheet" href="<?= base_url('../../../assets/css/style.css'); ?>">
    <title>Visualizar Postagem</title>
</head>

<body>

    <!-- Parte para exibir as imagens -->
    <?php if (!empty($post->imagem)): ?>
        <h3>Imagens:</h3>
        <img width="600" src="<?= base_url('assets/imgs/' . $post->imagem); ?>" alt="Imagem do Post">
    <?php endif; ?>

    <h1>Visualizar Postagem</h1>
    <h2><?= $post->title; ?></h2>
    <p><?= $post->content; ?></p>

    <!-- Formulário para atualizar post -->
    <form action="<?= site_url('updatePost/' . $post->id); ?>" method="post">
        <input type="hidden" name="post_id" value="<?= $post->id; ?>">
        <input type="hidden" name="user_id" value="<?= session()->get('user_id'); ?>">
        <textarea name="content" placeholder="Atualize seu post"><?= $post->content; ?></textarea>
        <button type="submit">Atualizar Postagem</button>
    </form>

    <!-- Links para excluir e voltar para o blog -->
    <a href="<?= site_url('post/delete/' . $post->id); ?>">Excluir</a>
    <a href="<?= site_url('blog'); ?>">Voltar para o blog</a>

    <!-- Mensagem de sucesso, se houver -->
    <?php if (session()->has('success')): ?>
        <br>
        <?= session()->getFlashdata('success'); ?>
    <?php endif; ?>

    <!-- Formulário para adicionar comentário -->
    <form action="<?= site_url('addComment'); ?>" method="post">
        <input type="hidden" name="post_id" value="<?= $post->id; ?>">
        <input type="hidden" name="user_id" value="<?= session()->get('user_id'); ?>">
        <textarea name="content" placeholder="Adicione seu comentário"></textarea>
        <button type="submit">Enviar Comentário</button>
    </form>

    <!-- Container de comentários -->
    <div class="comment-container">
        <?php if (!empty($comments)): ?>
            <h3>Comentários:</h3>
            <ul>
                <?php foreach ($comments as $comment): ?>
                    <li>
                        <?= $comment->content; ?>

                        <!-- Formulário para atualizar comentário -->
                        <form action="<?= site_url('updateComment'); ?>" method="post">
                            <input type="hidden" name="comment_id" value="<?= $comment->id; ?>">
                            <textarea name="new_content" placeholder="Novo conteúdo do comentário"></textarea>
                            <button type="submit">Atualizar Comentário</button>
                        </form>

                        <!-- Formulário para excluir comentário -->
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
