<?php
$usuarioCorreto = "sebas";
$senhaCorreta = "1234";
$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" || $_SERVER["REQUEST_METHOD"] === "GET") {
    $dados = $_SERVER["REQUEST_METHOD"] === "POST" ? $_POST : $_GET;
    $usuario = $dados["usuario"] ?? "";
    $senha = $dados["senha"] ?? "";

    if ($usuario !== "" || $senha !== "") {
        if ($usuario === $usuarioCorreto && $senha === $senhaCorreta) {
            $mensagem = "Login realizado com sucesso";
        } else {
            $mensagem = "Usuário ou senha incorretos";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/login-jogos.css">
    <title>Login</title>
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

        <?php if ($mensagem !== "") { ?>
            <p class="login-mensagem" role="status"><?= htmlspecialchars($mensagem, ENT_QUOTES, "UTF-8") ?></p>
        <?php } ?>
        <p><a class="voltar-inicio" href="../index.php">← Voltar ao início</a></p>
    </main>
</body>
</html>
<?php

?>
