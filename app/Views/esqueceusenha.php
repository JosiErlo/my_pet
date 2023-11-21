<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="<?= base_url('../../../assets/css/style.css'); ?>">
    <title>Redefinir Senha</title>
</head>



<body id="FundoEsqueceuSenha">
  
        <img src="../../../assets/img/gatinhosemfundo.png">
  
    <div class="login">
        <h1>Redefinir Senha</h1>
        <br><br>
        
        <form method="post" action="<?= site_url('auth/updatePassword') ?>">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required><br><br>
            <label for="birthdate">Data de Aniversário:</label>
            <input type="date" name="birthdate" id="birthdate" required><br><br>
            <label for="mother_name">Nome da Mãe:</label>
            <input type="text" name="mother_name" id="mother_name" required><br><br>
            <label for="password">Nova Senha:</label>
            <input type="password" name="new_password" id="new_password" required>
            <br><br>

            <button id="submit2">Salvar Nova Senha</button>
        
        </form>
    </div>
 </div>

</body>

</html>