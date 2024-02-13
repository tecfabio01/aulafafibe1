<?php
function calcularIMC($peso, $altura) {
    if ($altura > 0) {
        $imc = $peso / ($altura * $altura);
        return number_format($imc, 2); // Arredonda o IMC para duas casas decimais
    } else {
        return "Altura inválida";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de IMC</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="container">
        <h1>Calculadora de IMC</h1>
        <form action="" method="POST">
            <label for="peso">Peso (kg):</label>
            <input type="number" step="0.01" name="peso" id="peso" placeholder="Digite o peso" required>

            <label for="altura">Altura (m):</label>
            <input type="number" step="0.01" name="altura" id="altura" placeholder="Digite a altura" required>

            <button type="submit">Calcular IMC</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $peso = $_POST["peso"];
            $altura = $_POST["altura"];
            $imc = calcularIMC($peso, $altura);

            if (!is_numeric($imc)) {
                echo "<p class='error'>$imc</p>";
            } else {
                echo "<h2>Resultado:</h2>";
                echo "<p><strong>IMC:</strong> $imc</p>";
            }
        }
        ?>
    </div>
</body>
</html>
