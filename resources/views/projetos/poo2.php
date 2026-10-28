<?php
// ==========================================
// SISTEMA DE CONTROLE DE PRODUÇÃO INDUSTRIAL
// ==========================================

    // 1. CLASSE ABSTRATA
abstract class Maquina {
    public $nome;
    private $producao;

    public function __construct($nome){
        $this->nome = $nome;
        $this->producao = 0;
    }

    public function getProducao(){
        return $this->producao;
    }

    public function registrarProducao($quantidade){
        if ($quantidade <= 0){
            return false;
        }

        $this->producao += $quantidade;
        return true;
    }

    // ABSTRAÇÃO
    abstract public function operar();
}

    // 2. HERANÇA
class Esteira extends Maquina {
    public function operar(){
        return "Transportando peças...";
    }
}

class Prensa extends Maquina {
    public function operar(){
        return "Prensando peças...";
    }
}

class RoboSoldagem extends Maquina {
    public function operar(){
        return "Soldando peças...";
    }
}

    // 3. SESSÃO = ARMAZENAMENTO TEMPORÁRIO
    if (!isset($_SESSION["máquinas"])){
        $_SESSION["máquinas"] = [];
}

$mensagem = "";

    // 4. RECEBER FORMULÁRIO VIA POST
if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $nome = $_POST["nome"] ?? "";
    $tipo = $_POST["tipo"] ?? "";
    $quantidade = $_POST["quantidade"] ?? null;

    if(
        $nome === "" ||
        $quantidade === false ||
        $quantidade <= 0
    ){
        $mensagem = "Por favor, preencha todos os campos corretamente!";
    } else {
    // 5. CRIAR OBJETOS COM BSE NO FORMULÁRIO
    if ($tipo === "esteira") {
        $maquina = new Esteira($nome);
        } 
        
    elseif ($tipo === "prensa") {
        $maquina = new Prensa($nome);
        } 

    elseif ($tipo === "robosaldagem") {
        $maquina = new RoboSoldagem($nome);
        } 
        
    // EXECUTANDO OS METODOS DO OBJETO
    $maquina->registrarProducao($quantidade);

    // GUARDANDO O OBJETO NA SESSÃO
    $_SESSION["máquinas"][] = $maquina;

    $mensagem = "Máquina cadastrada com sucesso!";
    }
}

    // EVITAR INTERPRETAR TEXTOS COMO HTML
    function escapar($texto) {
        return htmlspecialchars((string) $texto, ENT_QUOTES, "UTF-8");
    }
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Produção Industrial</title>
    </head>
    <body>
        
        <h1>Controle de Produção Industrial</h1>

        <form method="POST">
            <label for="nome">Nome da Máquina:</label>
            <input type="text" name="nome" id="nome" required>

            <label for="tipo">Tipo de Máquina:</label>
            <select name="tipo" id="tipo" required>
                <option value="">Selecione</option>
                <option value="esteira">Esteira</option>
                <option value="prensa">Prensa</option>
                <option value="robosaldagem">Robô de Soldagem</option>
            </select>

            

?>
