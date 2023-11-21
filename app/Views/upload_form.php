<!-- app/Views/upload_form.php -->

<!DOCTYPE html>
<html lang="en">
<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Upload de Imagem</title>
</head>
<body>

<h1>Formulário de Upload de Imagem</h1>

<?php if (isset($validation)): ?>
    <div><?= $validation->listErrors() ?></div>
<?php endif; ?>

<?= form_open_multipart('img/visualizar_postagem/' . $postId) ?>

<label for="userfile">Escolha uma imagem:</label>
<input type="file" name="userfile" accept="image/*" required>

<button type="submit">Enviar</button>

<?= form_close() ?>

</body>
</html>
