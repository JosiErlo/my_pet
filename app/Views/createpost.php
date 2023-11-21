<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= base_url('../../../assets/css/style.css'); ?>">
    <meta charset="UTF-8">
    <title>Formulário de Criação de Post</title>
</head>

<body>
<body id="createpost">
<div id="imgcreatepost">
<img src="../../../assets/img/vistaLateralCachorro.jpg">
</div>
<div class="login">

        <h1>Formulário de Criação de Post</h1>
        <br><br>

        <form method="post" action="/createpost" enctype="multipart/form-data">
            <div>
                <label for="title">Título:</label>
                <br>
                <input type="text" name="title" id="title" required>
            </div>
            <br>
            <div>
                <label for="content">Conteúdo:</label>
                <textarea name="content" id="content" rows="6" required></textarea>
            </div>
            <br>
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
                <label for="userfile"></label>
                <input type="file" name="userfile" id="userfile" required>
            </div>
            <a href="<?= site_url('blog'); ?>">Voltar para o blog</a>
            <div>
                <button id="submit3">Criar Postagem</button>
            </div>
        </form>
    </div>
</body>

</html>
