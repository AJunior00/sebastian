<?php
$nome = "";
$idade = "";
$nota1 = "";
$nota2 = "";
$nota3 = "";
$nota4 = "";
$nota5 = "";
$media = "";
$resultado = "";
$erro = "";
$pontosFaltam = "";
$classeResultado = "";


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nome"])) {
    $nome = $_POST["nome"];
    $idade = $_POST["idade"];
    $nota1 = $_POST["nota1"];
    $nota2 = $_POST["nota2"];
    $nota3 = $_POST["nota3"];
    $nota4 = $_POST["nota4"];
    $nota5 = $_POST["nota5"];


    if ($nota1 < 0 || $nota1 > 10 || $nota2 < 0 || $nota2 > 10 || $nota3 < 0 || $nota3 > 10 || $nota4 < 0 || $nota4 > 10 || $nota5 < 0 || $nota5 > 10) {
        $erro = "As notas devem estar entre 0 e 10.";
    } elseif ($idade <= 0) {
        $erro = "A idade deve ser maior que zero.";
    } else {
        $media = ($nota1 * 2 + $nota2 * 3 + $nota3 + $nota4 + $nota5 * 3) / 10;

        if ($media == 10) {
            $resultado = "APROVADO COM EXCELÊNCIA";
            $classeResultado = "aprovado";
        } elseif ($media >= 7) {
            $resultado = "APROVADO";
            $classeResultado = "aprovado";
        } elseif ($media >= 5) {
            $resultado = "RECUPERAÇÃO";
            $classeResultado = "recuperacao";
        } else {
            $resultado = "REPROVADO";
            $classeResultado = "reprovado";
        }

        if ($media < 7) {
            $pontosFaltam = 7 - $media;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/notas.css">
    <title>Notas</title>
</head>
<body class="pagina-notas">
    <h1>Cadastro de aluno</h1>

    <form method="POST" class="formulario-notas">
        <input type="text" name="nome" placeholder="Digite seu nome" required>
        <input type="number" name="idade" placeholder="Digite sua idade" required>
        <input type="number" name="nota1" min="0" max="10" placeholder="Nota 1" step="0.1" required>
        <input type="number" name="nota2" min="0" max="10" placeholder="Nota 2" step="0.1" required>
        <input type="number" name="nota3" min="0" max="10" placeholder="Nota 3" step="0.1" required>
        <input type="number" name="nota4" min="0" max="10" placeholder="Nota 4" step="0.1" required>
        <input type="number" name="nota5" min="0" max="10" placeholder="Nota 5" step="0.1" required>
        <button type="submit">Calcular</button>
    </form>

    <?php if ($erro != "") { ?>
        <p><?= $erro ?></p>
    <?php } ?>

    <?php if ($resultado != "") { ?>
        <div class="card-resultado">
            <h2>Resultado</h2>
            <p>Nome: <?= $nome ?></p>
            <p>Idade: <?= $idade ?> anos</p>
            <p>Média: <?= number_format($media, 2, ",", ".") ?></p>
            <p class="situacao <?= $classeResultado ?>">Situação: <?= $resultado ?></p>
            <?php if ($pontosFaltam != "") { ?>
                <p>Faltaram <?= number_format($pontosFaltam, 1, ",", ".") ?> pontos para atingir a média 7.</p>
            <?php } ?>
        </div>
    <?php } ?>
    <p class="voltar-inicio"><a href="../index.php">← Voltar ao início</a></p>
</body>
</html>
