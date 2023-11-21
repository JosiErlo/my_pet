<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Localizador de Pet Shops</title>
    <!-- Inclua a API do Google Maps com sua chave -->
    <script src="https://maps.googleapis.com/maps/api/js?key=SuaChaveRealAqui&libraries=places"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('caminho/para/sua/imagem.jpg'); /* Substitua pelo caminho da sua imagem de fundo */
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh; /* 100% da altura da viewport */
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
            width: 100%;
        }

        h1 {
            margin: 0;
        }

        #map-container {
            position: relative;
            width: 100%;
            height: 400px;
            margin-top: 20px;
        }

        #map {
            width: 100%;
            height: 100%;
        }

        #screenshot {
            text-align: center;
            margin-top: 20px;
            max-width: 100%;
            right: 10px;
        }

        #screenshot img {
            max-width: 85%;
            height: auto;
            border: 3px solid #fff; /* Borda branca ao redor da imagem */
        }

        button {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <h1>Localizador de Pet Shops</h1>
    </header>

    <button onclick="getUserLocation()">Localizar</button>

    <div id="map-container">
        <div id="map"></div>
    </div>

    <div id="screenshot">
        <!-- Adicione a imagem de captura de tela aqui -->
        <img src="../../../assets/img/locali.jpg" alt="Captura de Tela da Localização">
    </div>

    <script>
        // ... (seu código JavaScript existente)
    </script>
</body>
</html>
