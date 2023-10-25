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
</body>

</html>
<div class="signup-container">
    <div class="left-container">
        <h1>
            <i class="fas fa-paw"></i>
            PUPASSURE
        </h1>
        <div class="puppy">
            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/38816/image-from-rawpixel-id-542207-jpeg.png" alt="Puppy">
        </div>
    </div>
    <div class="right-container">
        <header>
            <h1>Yay, puppies! Ensure your pup gets the best care!</h1>
            <div class="set">
                <div class="pets-name">
                    <label for="pets-name">Name</label>
                    <input type="text" id="pets-name" placeholder="Pet's name">
                </div>
                <div class="pets-photo">
                    <button id="pets-upload">
                        <i class="fas fa-camera-retro"></i>
                    </button>
                    <label for="pets-upload">Upload a photo</label>
                </div>
            </div>
            <div class="set">
                <div class="pets-breed">
                    <label for="pets-breed">Breed</label>
                    <input type="text" id="pets-breed" placeholder="Pet's breed">
                </div>
                <div class="pets-birthday">
                    <label for="pets-birthday">Birthday</label>
                    <input type="text" id="pets-birthday" placeholder="MM/DD/YYYY">
                </div>
            </div>
            <div class="set">
                <div class="pets-gender">
                    <label for="pet-gender-female">Gender</label>
                    <div class="radio-container">
                        <input type="radio" id="pet-gender-female" name="pet-gender" value="female" checked>
                        <label for="pet-gender-female">Female</label>
                        <input type="radio" id="pet-gender-male" name="pet-gender" value="male">
                        <label for="pet-gender-male">Male</label>
                    </div>
                </div>
                <div class="pets-spayed-neutered">
                    <label for="pet-spayed">Spayed or Neutered</label>
                    <div class="radio-container">
                        <input type="radio" id="pet-spayed" name="spayed-neutered" value="spayed" checked>
                        <label for="pet-spayed">Spayed</label>
                        <input type="radio" id="pet-neutered" name="spayed-neutered" value="neutered">
                        <label for="pet-neutered">Neutered</label>
                    </div>
                </div>
            </div>
            <div class="pets-weight">
                <label for="pet-weight-0-25">Weight</label>
                <div class="radio-container">
                    <input type="radio" id="pet-weight-0-25" name="pet-weight" value="0-25" checked>
                    <label for="pet-weight-0-25">0-25 lbs</label>
                    <input type="radio" id="pet-weight-25-50" name="pet-weight" value="25-50">
                    <label for="pet-weight-25-50">25-50 lbs</label>
                    <input type="radio" id="pet-weight-50-100" name="pet-weight" value="50-100">
                    <label for="pet-weight-50-100">50-100 lbs</label>
                    <input type="radio" id="pet-weight-100-plus" name="pet-weight" value="100+">
                    <label for="pet-weight-100-plus">100+ lbs</label>
                </div>
            </div>
        </header>
        <footer>
            <div class="set">
                <button id="back">Back</button>
                <button id="next">Next</button>
            </div>
        </footer>
    </div>
</div>