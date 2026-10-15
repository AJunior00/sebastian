<?php

    function apresentarSistema() {
        echo "Bem vindo(a) ao Help Desk!";
    }

    apresentarSistema();

    function abrirChamado($nome, $problema) {
        echo "$nome abriu um chamado: $problema";
    }

    abrirChamado("Sebastian", "Impressora não funciona");

    function contarChamados($quantidade) {
        return "Existem $quantidade chamados registrados";
    }

    $resultado = contarChamados(5);
    
?>

