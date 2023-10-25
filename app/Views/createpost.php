<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="stylesheet" href="<?= base_url('../../../assets/css/style.css'); ?>">
    <meta charset="UTF-8">
    <title>Formulário de Criação de Post</title>
</head>

<body>
    <div class="createpost">
        <h1>Formulário de Criação de Post</h1>
        <form method="post" action="/createpost">
            <div>
                <label for="title">Título:</label>
                <input type="text" name="title" id="title" required>
            </div>
            <div>
                <label for="content">Conteúdo:</label>
                <textarea name="content" id="content" rows="5" required></textarea>
            </div>
            <div>
                <label for="tipo_post_id">Categoria:</label>
                <select name="tipo_post_id" id="tipo_post_id" required>
                    <option value="">Selecione a Categoria</option>
                    <option value="1">Cachorro</option>
                    <option value="2">Gato</option>
                    <option value="3">Peixe</option>
                    <option value="4">Pássaros</option>
                    <option value="5">Diversos</option>
                </select>
            </div>
            <div>
                <button type="submit">Criar Postagem</button>
            </div>
    </div>
    </form>
</body>

</html>