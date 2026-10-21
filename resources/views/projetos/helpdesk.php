<?php
require_once __DIR__ . '/../../../app/Models/Chamado.php';

$modeloChamado = new Chamado();

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $acao = $_POST["acao"] ?? "";

   if ($acao === "cadastrar") {
        $sucesso = $modeloChamado->cadastrarChamados(
            $_POST["nome"] ?? "",
            $_POST["setor"] ?? "",
            $_POST["equipamento"] ?? "",
            $_POST["descricao"] ?? "",
            $_POST["prioridade"] ?? ""
        );

        $mensagem = $sucesso ? "Chamado cadastrado com sucesso!" : "Erro ao cadastrar. Verifique os dados.";
    }

    if ($acao === "atualizar") {
        $sucesso = $modeloChamado->atualizarChamado(
            (int) ($_POST["posicao"] ?? -1),
            $_POST["status"] ?? ""
        );

        $mensagem = $sucesso ? "Status atualizado!" : "Não foi possível atualizar.";
    }

    if ($acao === "excluir") {
        $sucesso = $modeloChamado->excluirChamado(
            (int) ($_POST["posicao"] ?? -1)
        );

        $mensagem = $sucesso
            ? "Chamado excluído!"
            : "Não foi possível excluir.";
    }
}

$chamados = $modeloChamado->LerChamados();
$relatorio = $modeloChamado->gerarRelatorio();

function escapar($valor) {
    return htmlspecialchars((string) $valor, ENT_QUOTES, "UTF-8");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/resources/css/helpdesk.css">
    <title>Chamados</title>
</head>
<body>
    <form method="POST">

        <label>Nome:</label>
        <input type="text" name="nome">

        <label>Setor da empresa:</label>
        <select name="setor" id="setor">
            <option value="producao">Produção</option>
            <option value="administrativo">Administrativo</option>
            <option value="logistica">Logística</option>
            <option value="financeiro">Financeiro</option>
            <option value="ti">TI</option>
        </select>

        <label>Equipamento afetado:</label>
        <select name="equipamento" id="equipamento">
            <option value="computador">Computador</option>
            <option value="impressora">Impressora</option>
            <option value="rede">Rede</option>
            <option value="sistema">Sistema</option>
            <option value="outro">Outro</option>
        </select>

        <label>Descrição do problema:</label>
        <textarea name="descricao"></textarea>

        <label>Prioridade:</label>
        <select name="prioridade" id="prioridade">
            <option value="baixa">Baixa</option>
            <option value="media">Média</option>
            <option value="alta">Alta</option>
        </select>

        <input type="hidden" name="acao" value="cadastrar">

        <button type="submit">Enviar</button>
        
        <a href="/?rota=portfolio" class="bt-voltar">Voltar ao início</a>

    </form>

    <h2>Lista Dos Chamados</h2>
    <table>
        <tbody>
            <?php foreach($chamados as $posicao => $chamado){ ?>
                <tr>
                    <td><?php echo $posicao; ?></td>
                    <td>Nome:<br> <?php echo $chamado['nome']; ?></td>
                    <td>Setor:<br> <?php echo $chamado['setor']; ?></td>
                    <td>Equipamento:<br> <?php echo $chamado['equipamento']; ?></td>
                    <td>Descrição:<br> <?php echo nl2br ($chamado['descricao']); ?></td>
                    <td>Prioridade:<br> <?php echo $chamado['prioridade']; ?></td>
                    
                    <td>
                        <form method="POST">
                            <input type="hidden" name="acao" value="atualizar">
                            <input type="hidden" name="posicao" value="<?php echo $posicao; ?>">
                            
                            <select name="status">
                                <option value="Aberto" <?php if($chamado['status'] == 'Aberto') echo 'selected'; ?>>Aberto</option>
                                <option value="Em andamento" <?php if($chamado['status'] == 'Em andamento') echo 'selected'; ?>>Em andamento</option>
                                <option value="Resolvido" <?php if($chamado['status'] == 'Resolvido') echo 'selected'; ?>>Resolvido</option>
                            </select>
                            <button type="submit">OK</button>
                        </form>
                    </td>

                    <td>
                        <form method="POST">
                            <input type="hidden" name="acao" value="excluir">
                            <input type="hidden" name="posicao" value="<?php echo $posicao; ?>">
                            <button type="submit">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>  

    <div>
        <h3>Relatório de Atendimentos</h3>
        <p>Total de chamados: <?php echo $relatorio["total"]; ?></p>
        <p>Abertos: <?php echo $relatorio["abertos"]; ?></p>
        <p>Em andamento: <?php echo $relatorio["andamento"]; ?></p>
        <p>Resolvido: <?php echo $relatorio["resolvidos"]; ?></p>
    </div>


</body>
</html>


