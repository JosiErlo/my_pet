<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<head>
    <title>Postagens na Categoria: <?= $category; ?></title>
</head>

<body>
    <h1>Postagens na Categoria: <?= $category; ?></h1>

    <!-- Exiba as postagens da categoria -->
    <?php if (!empty($posts)) : ?>
        <ul>
            <?php foreach ($posts as $post) : ?>
                <li>
                    <h2><?= $post['title']; ?></h2>
                    <p><?= substr($post['content'], 0, 100); ?>...</p>
                    <a href="<?= site_url('blog/view/' . $post['id']); ?>">Leia mais</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>Não há postagens nesta categoria ainda.</p>
    <?php endif; ?>

    <a href="<?= site_url('blog'); ?>">Voltar para o blog</a>
</body>

</html>
