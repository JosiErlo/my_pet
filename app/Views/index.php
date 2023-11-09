
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
    <a href="/login">Criar post</a>
    <a href="/login">Entrar</a>

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

  <?php foreach ($posts as $post) : ?>
        <h2><?= $post['title']; ?></h2>
        <p><?= $post['content']; ?></p>
    <?php endforeach; ?>
</body>

</html>
