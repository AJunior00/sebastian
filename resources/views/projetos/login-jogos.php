<?php
session_start();

if (isset($_GET["sair"])) {
    session_unset();
    session_destroy();
    header("Location: ../index.php");
    exit;
}

$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $_POST["usuario"] ?? "";
    $senha = $_POST["senha"] ?? "";

    if ($usuario === "sebasandrefa" && $senha === "300609") {
        session_regenerate_id(true);
        $_SESSION["jogos_logado"] = true;
        header("Location: jogos.php");
        exit;
    }

    $erro = "Usuário ou senha incorretos.";
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/login-jogos.css">
    <title>Login para jogos</title>
</head>
<body class="pagina-login-jogos">
    <main class="caixa-login-jogos">
        <h1>Login</h1>
        <form method="post">
            <label for="usuario">Usuário:</label>
            <input id="usuario" type="text" name="usuario" required>

            <label for="senha">Senha:</label>
            <input id="senha" type="password" name="senha" required>

            <button type="submit">Entrar</button>
        </form>
        <?php if ($erro !== "") { ?>
            <p role="alert"><?= htmlspecialchars($erro, ENT_QUOTES, "UTF-8") ?></p>
        <?php } ?>
        <p><a class="voltar-inicio" href="../index.php">← Voltar ao início</a></p>
    </main>
</body>
</html>
