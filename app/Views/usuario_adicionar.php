<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuário</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/css/styl.css') ?>">


    <script src="https://unpkg.com/imask"></script>
    <style>
      /* CSS personalizado */
        @keyframes changerColor {
            0%{
                background-color: #005e9f;
            }
            25% {
                background-color: #002546;
            }
            50%{
                background-color: #156a96;
            }
            60%{
                background-color: #002546;
            }
            75% {
                background-color: #156a96;
            }
            100%{
                background-color: #005e9f;
            }
        }
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #723172;
            animation: changerColor 10s infinite;
        }
/* Estilos para o container do formulário */
.container {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff; /* Cor de fundo do formulário */
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
}

/* Estilos para o título da página de registro */
h1 {
    font-size: 24px;
    font-weight: bold;
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

/* Estilos para os rótulos dos campos */
label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

/* Estilos para os campos de entrada de texto */
input[type="text"],
input[type="password"],
input[type="email"] {
    width: 95%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 3px;
    font-size: 16px;
}

/* Estilos para o botão de registro */
.btn-register {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 3px;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-register:hover {
    background-color: #0056b3;
}
/* Estilo padrão para .genero */
.genero {
    display: flex;
    justify-content: flex-end; /* Alinha à direita */
    align-items: center; /* Alinha verticalmente ao centro */
    height: 30px;
    align-items: center;
    

}


    </style>
</head>

<body>
    <div class="container">
        <h1>Registrar Usuário</h1>
        <form action="<?= base_url('usuarios/add') ?>" method="post" onsubmit="return validateForm();">
            <?php if (session()->has('message')) : ?>
                <div><?= session()->getFlashdata('message') ?></div>
            <?php endif; ?>

            <label for="nome">Nome:</label>
            <input type="text" name="nome" required placeholder="Nome"><br>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" required placeholder="Senha">
            <input type="checkbox" id="mostrarSenha" onclick="mostrarOcultarSenha()"> Mostrar Senha<br>

            <label for="confirmar_senha">Confirmar Senha:</label>
            <input type="password" name="confirmar_senha" required placeholder="Confirmar Senha"><br>

            <label for="email">E-mail:</label>
            <input type="email" name="email" required placeholder="E-mail"><br>

            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" required placeholder="CPF (apenas números)" id="cpf"><br>

            <label for="numero">Número:</label>
            <input type="text" name="numero" required placeholder="Número (apenas números)" id="numero"><br>

            <label for="data_nascimento">Data de Nascimento:</label>
            <input type="text" name="data_nascimento" required placeholder="Data de Nascimento (DD/MM/AAAA)" id="data_nascimento"><br>
            
            <div class="genero">

    <input type="radio" id="female" name="genero_id" value="1">
    <label for="female">Feminino</label>
    
    <input type="radio" id="male" name="genero_id" value="2">
    <label for="male">Masculino</label>

    <input type="radio" id="other" name="genero_id" value="3">
    <label for="other">Outro</label>
</div>


            <button type="submit" class="btn-register" value="Registrar">Registrar</button>
        </form>

        </form>
    </div>

    <script>
        function validateForm() {
            var senha = document.forms["registrationForm"]["senha"].value;
            var confirmarSenha = document.forms["registrationForm"]["confirmar_senha"].value;

            if (senha !== confirmarSenha) {
                alert("A senha e a confirmação de senha não correspondem.");
                return false; // Impede o envio do formulário
            }
            return true; // Envio do formulário permitido se as senhas coincidirem
        }

        function mostrarOcultarSenha() {
            var senhaInput = document.getElementById("senha");
            var mostrarSenhaCheckbox = document.getElementById("mostrarSenha");

            if (mostrarSenhaCheckbox.checked) {
                senhaInput.type = "text";
            } else {
                senhaInput.type = "password";
            }
        }

        var cpfInput = document.getElementById('cpf');
        var maskOptionsCpf = {
            mask: '000.000.000-00' // Define a máscara como ###.###.###-##
        };
        var cpfMask = IMask(cpfInput, maskOptionsCpf);

        var numeroInput = document.getElementById('numero');
        var maskOptionsNumero = {
            mask: '(00) 00000-0000' // Define a máscara como (00) 00000-0000
        };
        var numeroMask = IMask(numeroInput, maskOptionsNumero);

        var dataInput = document.getElementById('data_nascimento');
        var maskOptionsData = {
            mask: '00/00/0000' // Define a máscara como ##/##/####
        };
        var dataMask = IMask(dataInput, maskOptionsData);
    </script>
</body>

</html> -->