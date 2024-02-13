
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de CEP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Consulta de CEP</h1>
        <form action="" method="POST">
            <label for="cep">CEP:</label>
            <input type="text" name="cep" id="cep" maxlength="9" placeholder="Digite o CEP" required>
            <button type="submit">Consultar</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $cep = $_POST["cep"];
            $endereco = consultarCEP($cep);

            if ($endereco && !isset($endereco["erro"])) {
                echo $endereco;
                echo "<h2>Resultado:</h2>";
                echo "<p><strong>CEP:</strong> {$endereco['cep']}</p>";
                echo "<p><strong>Logradouro:</strong> {$endereco['logradouro']}</p>";
                echo "<p><strong>Bairro:</strong> {$endereco['bairro']}</p>";
                echo "<p><strong>Cidade:</strong> {$endereco['localidade']}</p>";
                echo "<p><strong>Estado:</strong> {$endereco['uf']}</p>";
            } else {
                echo "<p class='error'>CEP não encontrado. Verifique se o formato está correto.</p>";
            }
        }
        ?>
    </div>
</body>
</html>

<?php
function consultarCEP($cep) {
    $url = "https://viacep.com.br/ws/$cep/json/";
    $ch = curl_init($url);
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);

    curl_close($ch);

    return json_decode($response, true);
}
?>
