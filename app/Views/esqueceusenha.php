<!DOCTYPE html>
<html>
<head>
    <title>Redefinir Senha</title>
</head>
<body>
    <h1>Redefinir Senha</h1>
    <form method="post" action="<?= site_url('auth/updatePassword') ?>">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>
        <label for="birthdate">Data de Aniversário:</label>
        <input type="date" name="birthdate" id="birthdate" required><br><br>
        <label for="mother_name">Nome da Mãe:</label>
        <input type="text" name="mother_name" id="mother_name" required><br><br>
        <label for="password">Nova Senha:</label>
        <input type="password" name="password" id="password" required><br><br>
        <button type="submit">Salvar Nova Senha</button>
    </form>

    <!-- Adicione um link para o CRUD de usuário após o envio bem-sucedido -->
    <p>Deseja alterar seu usuário?<a href="<?= site_url('user.php') ?>"><br>Clique aqui!</a>.</p>
</body>
</html>
