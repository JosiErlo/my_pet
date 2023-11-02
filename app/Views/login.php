<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="<?= base_url('../../../assets/css/style.css'); ?>">
    <title>Blog My Pet</title>

</head>

<body>
    <h1>Bem-vindo ao Meu Blog</h1>
    
        <?php if (!session()->get('user_id')) : ?>
            <!-- Formulário de login -->
            <form method="POST" action="<?= site_url('/login'); ?>">
            <div class= "inicio">
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" required>
                <br>
                <label for="password">Senha:</label>
                <input type="password" name="password" id="password" required>
                <br>
                <a href="<?= site_url('esqueceusenha') ?>">Esqueceu a senha?</a>

                <button type="submit">Entrar</button></div>
              
            </form>
            <!-- Link para a página de registro -->
            <p>Não tem uma conta? <a href="<?= site_url('register'); ?>">Registre-se</a></p>
            <a href="<?= site_url('index.php'); ?>">Voltar para o blog</a>
        <?php endif; ?>
    
</body>

</html>