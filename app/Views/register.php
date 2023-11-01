<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="<?= base_url('../../../assets/css/style.css'); ?>">
    <title>Registro de Usuário</title>
</head>

<body>
    <h1>Registro de Usuário</h1>

    <!-- Exibir mensagens de erro, se houver -->
    <?php if (session('errors')) : ?>
        <div class="alert alert-danger">
            <?php foreach (session('errors') as $error) : ?>
                <?= $error ?><br>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
        </div>
    </div>
</body>

</html>
<div class="signup-container">
  
        <div class="logo">
        <img src="<?= base_url('../../../assets/img/MyPet.png') ?>" alt="blog">
            </div>
  

        <div class="cachorroregistro">
            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/38816/image-from-rawpixel-id-542207-jpeg.png" alt="Puppy">
        </div>
    </div>
       <div class="right-container">
        <header>
            <h1>Uhull, que bom ter você conosco!</h1>
                        
        <form method="POST" action="/register">
            <label for="nome">Nome completo:</label>
            <input type="nome" id="nome" name="nome" required><br>

            <label for="birthdate">Data de nascimento:</label>
            <input type="date" id="birthdate" name="birthdate" required><br>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="senha">Senha:</label>
            <input type="password" id="password" name="password" required><br>
            <input type="submit" value="Registrar">
        </form>
                </div>
               
            </div>
                    
          
                      
            </div>
        </header>
        
    </div>
</div>