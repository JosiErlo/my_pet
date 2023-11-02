<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="<?= base_url('../../../assets/css/style.css'); ?>">
    <title>Parceiros do Blog</title>
    <br>
    <br>
    <div class="navbar">
            <a href="/blog">Blog</a>
            <a href="/parceiros">Parceiros</a>
            <a href="#">ONGs</a>
            <a href="/localizador_petshops">Pet Shops</a>
            <a href="/login">Criar post</a>
            <a href="/login">Entrar</a>
        </div>
    <header>
        
        
        <h1>Nossos Parceiros</h1>
     
    </header>
   
</head>
<div class="parceiro-container">
    <a href="https://www.youtube.com" class="parceiro" target="_blank">
        <img src="<?= base_url('assets/img/saudeanimal.jpeg') ?>" alt="Saúde Animal">
    </a>

    <a href="https://www.google.com" class="parceiro" target="_blank">
        <img src="<?= base_url('assets/img/logoclinicvet.jpg') ?>" alt="Clinic Vet">
    </a>

    <a href="https://www.google.com" class="parceiro" target="_blank">
        <img src="<?= base_url('assets/img/arara.jpg') ?>" alt="Clinic Vet">
    </a>

    <a href="https://www.google.com" class="parceiro" target="_blank">
        <img src="<?= base_url('assets/img/fundo.jpg') ?>" alt="Clinic Vet">
    </a>

    <a href="https://www.google.com" class="parceiro" target="_blank">
        <img src="<?= base_url('assets/img/cachorro.jpg') ?>" alt="Clinic Vet">
    </a>

    <a href="https://www.google.com" class="parceiro" target="_blank">
        <img src="<?= base_url('assets/img/laga.jpg') ?>" alt="Clinic Vet">
    </a>

    <a href="https://www.google.com" class="parceiro" target="_blank">
        <img src="<?= base_url('assets/img/cachorro1.jpg') ?>" alt="Clinic Vet">
    </a>

    <a href="https://www.google.com" class="parceiro" target="_blank">
        <img src="<?= base_url('assets/img/onca.webp') ?>" alt="Clinic Vet">
    </a>
    <a href="<?= site_url('blog'); ?>">Voltar para o blog</a>
</div>
<footer>
    <p>&copy; <?php echo date("Y"); ?> Blog XYZ. Todos os direitos reservados.</p>
</footer>
</body>

</html>