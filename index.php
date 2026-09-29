<?php
$resultado = "";
$classificacao = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $peso = str_replace(',', '.', $_POST['peso']);
    $altura = str_replace(',', '.', $_POST['altura']);

    if (is_numeric($peso) && is_numeric($altura) && $altura > 0) {
        $imc = $peso / ($altura * $altura);
        $imc_formatado = number_format($imc, 2, ',', '.');
        
        $resultado = "Seu IMC é: $imc_formatado";

        if ($imc < 18.5) {
            $classificacao = "Abaixo do peso";
        } elseif ($imc < 25) {
            $classificacao = "Peso normal";
        } elseif ($imc < 30) {
            $classificacao = "Sobrepeso";
        } else {
            $classificacao = "Obesidade";
        }
    } else {
        $resultado = "Por favor, insira valores válidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Calculadora de IMC básica em PHP</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); width: 300px; }
        h2 { text-align: center; color: #333; }e

         
        label { display: block; margin-top: 10px; color: #666; }
        input { width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { background-color: #007BFF; color: white; border: none; width: 100%; padding: 10px; margin-top: 15px; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #0056b3; }
        .resultado { margin-top: 15px; text-align: center; font-weight: bold; color: #333; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Calculadora IMC</h2>
        <form method="POST" action="">
            <label>Peso (kg):</label>
            <input type="text" name="peso" placeholder="Ex: 70" required>
            
            <label>Altura (m):</label>
            <input type="text" name="altura" placeholder="Ex: 1.75" required>
            
            <button type="submit">Calcular</button>
        </form>

        <?php if (!empty($resultado)): ?>
            <div class="resultado">
                <p><?php echo $resultado; ?></p>
                <?php if (!empty($classificacao)): ?>
                    <p>Condição: <?php echo $classificacao; ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>