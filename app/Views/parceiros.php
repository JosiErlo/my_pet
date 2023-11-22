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
        <a href="/localizador_petshops">Pet Shops</a>
        <a href="/login">Criar post</a>
        <a href="/login">Entrar</a>
    </div>

   <h1 id="fraseParceiros">Parceiros do MY PET Blog</h1>

<body id="pagina">
 <div class="grupo">
            <div class="card" style="--clr: #009688">
            <div class="img-box">
            <img src=<?= base_url('assets/img/saudeanimal.jpg') ?> alt="Clinic Vet">
            </div>
            <div class="content">
                <h2>Pets Shops</h2>
                <p> 
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                    Architecto, hic? Magnam eum error saepe doloribus corrupti
                    repellat quisquam alias doloremque!
                </p>
                <a href="">Saiba Mais</a>
            </div>
        </div>
        <div class="card" style="--clr: #FF3E7F">
            <div class="img-box">
                <img src=<?= base_url('assets/img/cachorro1.jpg') ?> alt="Clinic Vet">
            </div>
            <div class="content">
                <h2>Hospedagem para Animais</h2>
                <p>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                    Architecto, hic? Magnam eum error saepe doloribus corrupti
                    repellat quisquam alias doloremque!
                </p>
                <a href="">Saiba Mais</a>
            </div>
        </div>
        <div class="card" style="--clr: #03A9F4">
            <div class="img-box">
                <img src=<?= base_url('assets/img/logoclinicvet.jpg') ?> alt="Clinic Vet">
            </div>
            <div class="content">
                <h2>Clínicas Vaterinárias</h2>
                <p>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                    Architecto, hic? Magnam eum error saepe doloribus corrupti
                    repellat quisquam alias doloremque!
                </p>
                <a href="">Saiba Mais</a>
            </div>
        </div>
    </div>
</body>
</html>
</html>
</body>


<div class="botãoPaceiro"> 
    <button id="voltarbotãoParceiros"><a href="<?= site_url('index.php'); ?>">Volte ao blog</a></button>         
    </div>

<footer>
    <p>&copy;
        <?php echo date("Y"); ?> Blog XYZ. Todos os direitos reservados.
    </p>
</footer>


