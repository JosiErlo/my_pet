<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="<?= base_url('../../../assets/css/style.css'); ?>">
    <title>Blog My Pet</title>

</head>



<body id="FundoLogin">
<div class="imgFundoLogin">
<div class="login">
    <h1>Bem-vindo(a) ao My Pet Blog!</h1>
    <br><br><br><br><br>
    
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
                <br><br>
                <button id="submit">Entrar</button>
            </div>
            <br><br>
            </form>
            <!-- Link para a página de registro -->
            <p>Não tem uma conta? 
                <div class="butõesGrupo">
                <button id="registerBotão"><a href="<?= site_url('register'); ?>">Registre-se</a></button>
                <button id="voltarbotão"><a href="<?= site_url('index.php'); ?>">Volte ao blog</a></button>
            </p>

        <?php endif; ?>
    
        
</body>

</html>

