<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="<?= base_url('../../../assets/css/style.css'); ?>">
</head>

<body>
    <div class="navbar">
        <a href="#">Blog</a>
        <a href="#">Parceiros</a>
        <a href="#">ONGs</a>
        <a href="/localizador_petshops">Pet Shops</a>
        <a href="/createpost">Criar post</a>
        <a href="<?= site_url('logout'); ?>">Logout</a>
    </div>

    <div class="blog">
        <h1>Meu Blog</h1>
    </div>

    <div class="post">
        <p>
            Ter um animal de estimação pode trazer inúmeros benefícios
            para a nossa vida. Além de nos proporcionarem companhia e alegria,
            os pets têm um impacto positivo em nossa saúde física, emocional e social.
            Vamos explorar a importância de ter um pet e como eles podem melhorar a nossa qualidade de vida.
            Ter um pet vai além do simples ato de cuidar de um animal.
            Eles se tornam parte de nossa família e trazem inúmeros benefícios para a nossa vida.
            Desde proporcionar companheirismo e alegria até melhorar nossa saúde física e emocional, os pets têm um papel fundamental
            em nosso bem-estar geral.
            Se você ainda não tem um pet, considere a possibilidade de adotar um.
            A relação especial que você irá construir com seu animal de estimação será
            recompensadora e transformadora.
            Contribua também para aumentar as experiências que
            você tem com seu animalzinho.
        </p>
    </div>
    <form action="<?= site_url('blog') ?>" method="get">
    <label for="tipo_post_id">Categoria:</label>
    <select id="tipo_post_id" name="tipo_post_id">
        <option value="all" <?= $selectedCategory === 'all' ? 'selected' : '' ?>>Todos</option>
        <?php
        $categorias = [
            1 => 'Cachorro',
            2 => 'Gato',
            3 => 'Pássaros',
            4 => 'Peixes',
            5 => 'Diversos',
        ];

        foreach ($categorias as $id => $categoria) {
            echo "<option value='$id' " . ($selectedCategory == $id ? 'selected' : '') . ">$categoria</option>";
        }
        ?>
    </select>
    <button type="submit">Filtrar</button>
</form>


<div class="post-list">
    <?php foreach ($posts as $post) : ?>
        <div class="post">
            <h2><?= $post['title']; ?></h2> <!-- Usar $post['title'] em vez de $post->title -->
            <p><?= substr($post['content'], 0, 50); ?>...</p> <!-- Usar $post['content'] em vez de $post->content -->
            <a href="<?= site_url('blog/viewpost/' . $post['id']); ?>">Leia mais</a>
        </div>
    <?php endforeach; ?>
</div>

</body>

</html>