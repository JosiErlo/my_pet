<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('../../../assets/css/style.css'); ?>">
</head>

<body>
    <!-- Exibir mensagens de erro, se houver -->
    <?php if (session('errors')) : ?>
        <div class="alert alert-danger">
        <?php foreach (session('errors') as $error) : ?>
            <?= $error ?><br>
        <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Container principal -->


<div class="cachorroregistro">
<div class="loginCachorroRegistro">
    <!-- Container do formulário -->
   
        <h1>Uhull, que bom ter você conosco!</h1>
       <br><br><br><br><br>

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
        </div>
    </div>
    </div>
</body>

</html>