<!DOCTYPE html>
<html>
<head>
    <title>Esqueceu a senha</title>
</head>
<body>
    <h1>Esqueceu a senha</h1>
    <form method="post" action="<?= site_url('enviar-link-recuperacao') ?>">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <button type="submit">Enviar Link de Recuperação</button>
    </form>
</body>
</html>