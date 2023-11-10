<!DOCTYPE html>
<html lang="pt-Br">

<h1>Gerenciamento de Usuários</h1>

<!-- Listagem de Usuários -->
<h2>Lista de Usuários</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Data de Nascimento</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <!-- Loop through the users and display them -->
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id']; ?></td>
                <td><?= $user['email']; ?></td>
                <td><?= $user['birthdate']; ?></td>
                <td>
                    <a href="/user/edit/<?= $user['id']; ?>">Editar</a>
                    <a href="/user/delete/<?= $user['id']; ?>">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Formulário de Criação de Usuário -->
<h2>Criar Novo Usuário</h2>
<form method="post" action="/user/store">
    <!-- Form fields for user input -->
    <label for="email">Email:</label>
    <input type="text" name="email" required><br>

    <label for="birthdate">Data de Nascimento:</label>
    <input type="date" name="birthdate" required><br>

    <button type="submit">Criar Usuário</button>
</form>

<!-- Formulário de Edição de Usuário -->
<h2>Editar Usuário</h2>
<form method="post" action="/user/update/<?= $user['id']; ?>">
    <!-- Form fields for user input -->
    <label for="email">Email:</label>
    <input type="text" name="email" value="<?= $user['email']; ?>" required><br>

    <label for="birthdate">Data de Nascimento:</label>
    <input type="date" name="birthdate" value="<?= $user['birthdate']; ?>" required><br>

    <button type="submit">Salvar Alterações</button>
</form>

<!-- Confirmação de Exclusão -->
<h2>Excluir Usuário</h2>
<p>Você tem certeza de que deseja excluir este usuário?</p>
<form method="post" action="/user/delete/<?= $user['id']; ?>">
    <button type="submit">Confirmar Exclusão</button>
</form>
<!-- oi -->