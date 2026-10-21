<?php

    function LerChamados() {
        $arquivo = __DIR__ . "/../dados/chamados.json";

        if(!file_exists($arquivo)){
            file_put_contents($arquivo, "[]");
        }

        $conteudo = file_get_contents($arquivo);

        $chamados = json_decode($conteudo, true);

        return is_array($chamados) ? $chamados : [];
    }

    function salvarChamados($chamados) {
        $arquivo = __DIR__ . "/../dados/chamados.json";

        return file_put_contents(
            $arquivo, json_encode(
                $chamados, 
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            )
        ) !== false;
    }

    function cadastrarChamados($nome, $setor, $equipamento, $descricao, $prioridade) {
        if (trim($nome) == "" || trim($descricao) == "") {
            return false;
        }
    
        $chamados = LerChamados();

        $novoChamado = [
            "nome" => trim($nome),
            "setor" => $setor,
            "equipamento" => $equipamento,
            "descricao" => trim($descricao),
            "prioridade" => $prioridade,
            "status" => "Aberto"
        ];

        $chamados[] = $novoChamado;

        return salvarChamados($chamados);
    }

    function atualizarChamado($posicao, $novoStatus) {
        $chamados = LerChamados();

        $statusPermitidos = [
            "Aberto",
            "Em andamento",
            "Resolvido"
        ];

        if (!isset($chamados[$posicao])) {
            return false;
        }

        if (!in_array($novoStatus, $statusPermitidos, true)) {
            return false;
        }

        $chamados[$posicao]["status"] = $novoStatus;
        return salvarChamados($chamados);
    }

    function excluirChamado($posicao) {
        $chamados = LerChamados();

         if (!isset($chamados[$posicao])) {
            return false;
        }

        unset($chamados[$posicao]);

        $chamados = array_values($chamados);
        return salvarChamados($chamados);
    }

    function gerarRelatorio() {
        $chamados = LerChamados();

        $relatorio = [
            "total" => count($chamados),
            "abertos" => 0,
            "andamento" => 0,
            "resolvidos" => 0
        ];

        foreach ($chamados as $chamado) {
            if ($chamado["status"] === "Aberto") {
                $relatorio["abertos"]++;
            } elseif ($chamado["status"] === "Em andamento") {
                $relatorio["andamento"]++;
            } elseif ($chamado["status"] === "Resolvido") {
                $relatorio["resolvidos"]++;
            }
        }

        return $relatorio;
    }

    
?>
