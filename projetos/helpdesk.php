<?php
require_once "helpdesk-func.php";

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $acao = $_POST["acao"] ?? "";

   if ($acao === "cadastrar") {
        $sucesso = cadastrarChamados(
            $_POST["nome"] ?? "",
            $_POST["setor"] ?? "",
            $_POST["equipamento"] ?? "",
            $_POST["descricao"] ?? "",
            $_POST["prioridade"] ?? ""
        );

        $mensagem = $sucesso ? "Chamado cadastrado com sucesso!" : "Erro ao cadastrar. Verifique os dados.";
    }

    if ($acao === "atualizar") {
        $sucesso = atualizarChamado(
            (int) ($_POST["posicao"] ?? -1),
            $_POST["status"] ?? ""
        );

        $mensagem = $sucesso ? "Status atualizado!" : "Não foi possível atualizar.";
    }

    if ($acao === "excluir") {
        $sucesso = excluirChamado(
            (int) ($_POST["posicao"] ?? -1)
        );

        $mensagem = $sucesso
            ? "Chamado excluído!"
            : "Não foi possível excluir.";
    }
}
?>
