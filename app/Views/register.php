<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link para o arquivo de estilo CSS -->
    <link rel="stylesheet" href="<?= base_url('../../../assets/css/style.css'); ?>">
    <title>Registro de Usuário</title>
</head>
<body>
    <h1>Registro de Usuário</h1>

    <!-- Exibir mensagens de erro, se houver -->
    <?php if (session('errors')) : ?>
        <div class="alert alert-danger">
            <?php foreach (session('errors') as $error) : ?>
                <?= $error ?><br>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Container principal -->
    <div class="signup-container">
        <div class="logo">
            <img src="<?= base_url('../../../assets/img/logo.png') ?>" alt="blog">
        </div>
        <div class="cachorroregistro">
            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/38816/image-from-rawpixel-id-542207-jpeg.png" alt="Puppy">
        </div>
    </div>

    <!-- Container do formulário -->
    <div class="right-container">
        <header>
            <h1>Uhull, que bom ter você conosco!</h1>

            <!-- Formulário de registro -->
            <form method="POST" action="/register">
                <label for="nome">Nome completo:</label>
                <input type="text" id="nome" name="nome" required><br>

                <label for="birthdate">Data de nascimento:</label>
                <input type="date" id="birthdate" name="birthdate" required><br>
               
                <label for="mother_name">Nome da Mãe:</label>
                <input type="text" name="mother_name" id="mother_name" required><br>
               
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required><br>

                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" required><br>

                <label for="confirm_password">Confirmar Senha:</label>
                <input type="password" id="confirm_password" name="confirm_password" required><br>

                <input type="submit" value="Registrar">
                <a href="<?= site_url('blog'); ?>">Voltar para o blog</a>
            </form>
        </header>
    </div>
</body>
</html>
