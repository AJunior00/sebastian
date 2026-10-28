<?php 

class Chamado{

public function LerChamados() {
    
        $arquivo = __DIR__ . "/../dados/chamados.json";

        if(!file_exists($arquivo)){
            file_put_contents($arquivo, "[]");
        }

        $conteudo = file_get_contents($arquivo);

        $chamados = json_decode($conteudo, true);

        return is_array($chamados) ? $chamados : [];
    }

    public function salvarChamados($chamados) {
        $arquivo = __DIR__ . "/../dados/chamados.json";

        return file_put_contents(
            $arquivo, json_encode(
                $chamados, 
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            )
        ) !== false;
    }

    public function cadastrarChamados($nome, $setor, $equipamento, $descricao, $prioridade) {
        if (trim($nome) == "" || trim($descricao) == "") {
            return false;
        }
    
        $chamados = $this->LerChamados();

        $novoChamado = [
            "nome" => trim($nome),
            "setor" => $setor,
            "equipamento" => $equipamento,
            "descricao" => trim($descricao),
            "prioridade" => $prioridade,
            "status" => "Aberto"
        ];

        $chamados[] = $novoChamado;

        return $this->salvarChamados($chamados);
    }

    public function atualizarChamado($posicao, $novoStatus) {
        $chamados = $this->LerChamados();

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
        return $this->salvarChamados($chamados);
    }

    public function excluirChamado($posicao) {
        $chamados = $this->LerChamados();

         if (!isset($chamados[$posicao])) {
            return false;
        }

        unset($chamados[$posicao]);

        $chamados = array_values($chamados);
        return $this->salvarChamados($chamados);
    }

    public function gerarRelatorio() {
        $chamados = $this->LerChamados();

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

    }

?>