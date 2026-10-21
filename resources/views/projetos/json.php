<?php

    // 1. DECLARAR O CAMINHO DO ARQUIVO JSON
    $caminho = __DIR__. "/dados.json";

    // 2. ABRIR/LER O ARQUIVO JSON
    $json = file_get_contents($caminho);

    // 3. TRANSFORMAR JSON EM ARRAY PHP
    $alunos = json_decode($json, true);
    if (!is_array($alunos)) {
        $alunos = [];
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST"){

        $acao = $_POST["acao"] ?? "";
        
        if($acao === "cadastrar"){

        // 4. CRIAR UM ALUNO
        $novoAluno = [
            "nome" => $_POST["nome"],
            "idade" => $_POST["idade"],
            "curso" => $_POST["curso"]
        ];

        // 5. ADICIONAR O ALUNO NO ARRAY
        $alunos[] = $novoAluno;

        // 6. TRANSFORMAR ARRAY PHP EM JSON
        $jsonAtualizado = json_encode($alunos,
            JSON_PRETTY_PRINT | 
            JSON_UNESCAPED_UNICODE
        );

        // 7. SALVAR NO ARQUIVO
        file_put_contents($caminho, 
        $jsonAtualizado);

    }
        // PEGAR OS DADOS DO FORMULÁRIO
        if ($acao === "atualizar" && isset($_POST["posicao"])) {
            $posicao = filter_var($_POST["posicao"], FILTER_VALIDATE_INT);

            if ($posicao !== false && isset($alunos[$posicao])) {
                $alunos[$posicao]["nome"] = trim($_POST["nome"] ?? "");
                $alunos[$posicao]["idade"] = trim($_POST["idade"] ?? "");
                $alunos[$posicao]["curso"] = trim($_POST["curso"] ?? "");

                $jsonAtualizado = json_encode(
                    $alunos,
                    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
                );

                file_put_contents($caminho, $jsonAtualizado, LOCK_EX);
            }
        }

        if ($acao === "deletar") {
            // PEGAR O NOME QUE QUEREMOS DELETAR
            $nome = $_POST["nome"] ?? "";

            // PERCORRER TODOS OS ALUNOS
            foreach ($alunos as $posicao => $aluno) {

            // VERIFICAR SE ENCONTROU O ALUNO
            if ($aluno["nome"] === $nome) {
                
            // DELETAR O ALUNO DO ARRAY
            unset($alunos[$posicao]);
                }
            }

        }

    }

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>CADASTRAR ALUNOS</h2>
    <form method="POST">
        <label for>Nome:</label>
        <input type="text" name="nome">

        <label for>Idade:</label>
        <input type="number" name="idade">

        <label for>Curso:</label>
        <input type="text" name="curso">
        <button type="submit" name ="acao" value="cadastrar">Cadastrar</button>
    </form>

    <h2>ALUNOS CADASTRADOS</h2>
    <?php foreach($alunos as $posicao => $aluno){ ?>
    <h3><?= htmlspecialchars($aluno["nome"], ENT_QUOTES, "UTF-8") ?></h3>
    <p>Idade: <?= htmlspecialchars((string) $aluno["idade"], ENT_QUOTES, "UTF-8") ?></p>
    <p>Curso: <?= htmlspecialchars($aluno["curso"], ENT_QUOTES, "UTF-8") ?></p>
    <form method="POST">
        <input type="hidden" name="nome" value="<?= htmlspecialchars($aluno["nome"], ENT_QUOTES, "UTF-8") ?>">
        <button type="submit" name="acao" value="deletar">Excluir</button>
    </form>
    <form method="POST">
        <input type="hidden" name="posicao" value="<?= $posicao ?>">
        <label>Nome:
            <input type="text" name="nome" value="<?= htmlspecialchars($aluno["nome"], ENT_QUOTES, "UTF-8") ?>" required>
        </label>
        <label>Idade:
            <input type="number" name="idade" value="<?= htmlspecialchars((string) $aluno["idade"], ENT_QUOTES, "UTF-8") ?>" required>
        </label>
        <label>Curso:
            <input type="text" name="curso" value="<?= htmlspecialchars($aluno["curso"], ENT_QUOTES, "UTF-8") ?>" required>
        </label>
        <button type="submit" name="acao" value="atualizar">Atualizar</button>
    </form>
    <?php } ?>

</body>
</html>
