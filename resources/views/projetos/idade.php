<?php

$resultado = "";

if ($_SERVER ["REQUEST_METHOD"] == "POST"){
    $idade = filter_input(INPUT_POST, "idade", FILTER_VALIDATE_INT);

    if ($idade !== false && $idade !== null && $idade >= 0) {
        $resultado = $idade >= 18 ? "Maior de idade" : "Menor de idade";
    }
}
?>

<!DOCTYPE html>
<html lang="PT-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/idade.css">
    
    <title>Verificador de idade</title>
</head>
<body class="pagina-idade">
<h1>Verificador de idade</h1>

<form method="POST" class="formulario-idade">
    <label for="nome">Seu nome</label>
    <input type="text" id="nome" name="nome" maxlength="100" placeholder="Digite seu nome" required>
    <label for="idade">Sua idade</label>
    <input type="number" id="idade" name="idade" min="0" step="1" placeholder="Digite sua idade" required>
    <input type="submit" value="Enviar">
</form>

    <?php if ($resultado !== "") { ?>
    <div class="card" role="status" aria-live="polite">
        <h2 class="resultado-idade"><?= htmlspecialchars($resultado, ENT_QUOTES, "UTF-8") ?></h2>
    </div>
    <?php } ?>
    <p class="voltar-inicio"><a href="../index.php">← Voltar ao início</a></p>
    </body>
    </html>
