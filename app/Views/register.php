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
    <div class="left-container">
        <h1>
            <i class="fas fa-paw"></i>
  Blog My Pet 
        </h1>
        <div class="puppy">
            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/38816/image-from-rawpixel-id-542207-jpeg.png" alt="Puppy">
        </div>
    </div>
    <div class="video-container">
    <video class="video" width="640" height="360" controls>
        <source src="../../../assets/video/MY_PET_1.mp4" type="video/mp4">
    </video>
    <div class="right-container">
        <header>
            <h1>Uhull, que bom ter você conosco!</h1>
          
          
        <div class="register">
        <form method="POST" action="/register">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="senha">Senha:</label>
            <input type="password" id="password" name="password" required><br>
            <input type="submit" value="Registrar">
        </form>
                </div>
               
            </div>
                    
            </div>
                      
            </div>
        </header>
        
    </div>
</div>