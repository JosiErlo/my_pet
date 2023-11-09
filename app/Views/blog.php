<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="<?= base_url('../../../assets/css/style.css'); ?>">
</head>

<body>
    <div class="navbar">
        <a href="/blog">Blog</a>
        <a href="/parceiros">Parceiros</a>
        <a href="#">ONGs</a>
        <a href="/localizador_petshops">Pet Shops</a>
        <a href="/createpost">Criar post</a>
        <a href="<?= site_url('logout'); ?>">Logout</a>
        <div class="message">
            <p>Olá, bem-vindo ao My Pet Blog,
                <?= session()->get('email'); ?>
            </p>
            <form action="<?= site_url('user/delete/' . session()->get('user_id')); ?>" method="post">
                <button type="submit"
                    onclick="return confirm('Tem certeza que deseja excluir sua conta? Essa ação é irreversível.');">Excluir
                    Conta</button>
            </form>

        </div>

    </div>

    <div class="blog">
        <h1>My Pet Blog</h1>
    </div>


    <div class="introducao">
        <h3 style="font-size: 20px">
            <span>Ter um animal de estimação pode trazer inúmeros benefícios
                para a nossa vida. Além de nos proporcionarem companhia e alegria,
                os pets têm um impacto positivo em nossa saúde física, emocional e social.
                Vamos explorar a importância de ter um pet e como eles podem melhorar a nossa qualidade de vida.
                Ter um pet vai além do simples ato de cuidar de um animal.
                Eles se tornam parte de nossa família e trazem inúmeros benefícios para a nossa vida.
                Desde proporcionar companheirismo e alegria até melhorar nossa saúde física e emocional,
                os pets têm um papel fundamental em nosso bem-estar geral.
                Se você ainda não tem um pet, considere a possibilidade de adotar um.
                A relação especial que você irá construir com seu animal de estimação será
                recompensadora e transformadora.
                Contribua também para aumentar as experiências que
                você tem com seu animalzinho.
            </span>
        </h3>
    </div>

    <form action="<?= site_url('blog') ?>" method="get">
        <label for="category">Categoria:</label>
        <select id="category" name="category">
            <option value="all" <?= $selectedCategory === 'all' ? 'selected' : '' ?>>Todos</option>
            <?php
            $categorias = [
                1 => 'Cachorro',
                2 => 'Gato',
                3 => 'Peixes',
                4 => 'Pássaros',
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
        <?php foreach ($posts as $post): ?>
            <div class="post">
                <h2>
                    <?= $post['title']; ?>
                </h2> <!-- Usar $post['title'] em vez de $post->title -->
                <p>
                    <?= substr($post['content'], 0, 50); ?>...
                </p> <!-- Usar $post['content'] em vez de $post->content -->
                <a href="<?= site_url('blog/viewpost/' . $post['id']); ?>">Leia mais</a>
               

            </div>
        <?php endforeach; ?>
    </div>

</body>

</html>