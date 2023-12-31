<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('assets/css/blog.css'); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <title>My Pet Blog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body id="FundoBlog">
    <div class="navbar">
        <a href="/blog">Blog</a>
        <a href="/parceiros">Parceiros</a>
        <a href="/localizador_petshops">Pet Shops</a>
        <a href="/createpost">Criar post</a>
        <a href="<?= site_url('logout'); ?>">Logout</a>
        <div class="message">
            <p style="color: white;">Olá, bem-vindo ao My Pet Blog!
                <?= session()->get('email'); ?>
            </p>
            <form action="<?= site_url('user/delete/' . session()->get('user_id')); ?>" method="post">
                <button type="submit" class="btnexcluir"
                    onclick="return confirm('Tem certeza que deseja excluir sua conta? Essa ação é irreversível.');">Excluir
                    Conta</button>
            </form>
        </div>
    </div>

    <br><br><br><br><br>
    <main>
        <div class="introducao">
            <div class="texto">
                <h1 class="title">My Pet Blog</h1>
                <p style="text-align: left;">
                    Ter um animal de estimação pode trazer inúmeros benefícios para a nossa vida. Além de nos
                    proporcionarem
                    companhia e alegria, os pets têm um impacto positivo em nossa saúde física, emocional e social.
                    Vamos
                    explorar a importância de ter um pet e como eles podem melhorar a nossa qualidade de vida. Ter um
                    pet
                    vai além do simples ato de cuidar de um animal. Eles se tornam parte de nossa família e trazem
                    inúmeros
                    benefícios para a nossa vida. Desde proporcionar companheirismo e alegria até melhorar nossa saúde
                    física e emocional, os pets têm um papel fundamental em nosso bem-estar geral. Se você ainda não tem
                    um
                    pet, considere a possibilidade de adotar um. A relação especial que você irá construir com seu
                    animal de
                    estimação será recompensadora e transformadora. Contribua também para aumentar as experiências que
                    você
                    tem com seu animalzinho.
                </p>
            </div>
            <div class="imagemBlog">
                <img src="../../../assets/img/grupodeanimais.png" alt="Animais início">
            </div>
        </div>
    </main>

    <br><br><br><br><br><br><br><br><br><br><br><br>
    <form action="<?= site_url('blog') ?>" method="get"class="filtro-container">
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
        <button type="submit" class="btnfiltrar">Filtrar</button>
        <div class="post-list">
            <?php foreach ($posts as $post): ?>
                <div class="post-list">
                    <div class="grupo">
                        <div class="card" style="--clr: #009688">
                            <div class="img-box">
                                <img src="<?= base_url('assets/imgs') ?>/<?= $post->imagem ?>" />
                            </div>
                            <div class="content">
                                <h2>
                                    <?= $post->title; ?>
                                </h2>
                                <a href="<?= site_url('blog/viewpost/' . $post->id); ?>">Leia mais</a>
                                <br><br><br>
                                <p>
                                    <?= substr($post->content, 0, 50); ?>...
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </form>
</body>

</html>