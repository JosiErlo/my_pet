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
      
        <img width="600" src="<?= base_url('assets/imgs/' . $post->imagem); ?>" alt="Imagem do Post">
    <?php endif; ?>
<br><br>
    <h2><?= $post->title; ?></h2>
    <p><?= $post->content; ?></p>
<!-- Formulário para atualizar post -->
<form action="<?= site_url('updatePost/' . $post->id); ?>" method="post" onsubmit="clearTextarea()">
    <input type="hidden" name="post_id" value="<?= $post->id; ?>">
    <input type="hidden" name="user_id" value="<?= session()->get('user_id'); ?>"><br><br>
    <textarea name="content" rows="8" cols="80" placeholder="Atualize seu post"><?= $post->content; ?></textarea><br><br>
    <button type="submit" style="display: block; margin: 0 auto; width: 130px; height: 40px; line-height: 30px; text-align: center; color: white; background-color: #3498db; border: none; border-radius: 5px;">Atualizar</button>

</form>

<script>
function clearTextarea() {
    // Limpa o conteúdo da textarea
    document.querySelector('textarea[name="content"]').value = '';
}
</script>

    <!-- Links para excluir e voltar para o blog -->
    <a style="display: inline-block; width: 150px; height: 30px; line-height: 30px; text-align: center; color: white; background-color: #3498db; text-decoration: none; border-radius: 5px;" href="<?= site_url('post/delete/' . $post->id); ?>">Excluir</a><br>
    <a style="display: inline-block; width: 150px; height: 30px; line-height: 30px; text-align: center; color: white; background-color: #3498db; text-decoration: none; border-radius: 5px;"href="<?= site_url('blog'); ?>">Voltar para o blog</a><br><br>
    <!-- Mensagem de sucesso, se houver -->
    <?php if (session()->has('success')): ?>
        <br>
        <?= session()->getFlashdata('success'); ?>
    <?php endif; ?>

<!-- Formulário para adicionar comentário -->
<form action="<?= site_url('addComment'); ?>" method="post">
    <input type="hidden" name="post_id" value="<?= $post->id; ?>">
    <input type="hidden" name="user_id" value="<?= session()->get('user_id'); ?>">
    <div style="display: flex; align-items: center;">
        <textarea name="content" placeholder="Adicione seu comentário"></textarea>
        <button type="submit" style="width: 150px; height: 30px; color: white; background-color: #3498db; text-decoration: none; border: none; border-radius: 5px; margin-left: 10px;">Enviar Comentário</button>
    </div>
</form>


    <!-- Container de comentários -->
    <div class="comment-container" style="text-align: center;">
    <?php if (!empty($comments)): ?>
        <h3>Comentários:</h3>
        <ul style="list-style-type: none; padding: 0;">
            <?php foreach ($comments as $comment): ?>
                <li style="margin-bottom: 10px;">
                    <?= $comment->content; ?>

                    <!-- Formulário para atualizar comentário -->
                    <form action="<?= site_url('updateComment'); ?>" method="post" style="display: inline-block; margin-left: 10px;">
                        <input type="hidden" name="comment_id" value="<?= $comment->id; ?>">
                        <textarea name="new_content" placeholder="Novo conteúdo do comentário" style="width: 200px; height: 60px;"></textarea>
                        <button type="submit" style="width: 150px; height: 30px; color: white; background-color: #3498db; text-decoration: none; border: none; border-radius: 5px;">Atualizar Comentário</button>
                    </form>

                    <!-- Formulário para excluir comentário -->
                    <form action="<?= site_url('deleteComment/' . $comment->id); ?>" method="post" style="display: inline-block; margin-left: 10px;">
                        <button type="submit" style="width: 150px; height: 30px; color: white; background-color: #3498db; text-decoration: none; border: none; border-radius: 5px;">Excluir Comentário</button>
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
