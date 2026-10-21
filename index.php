<?php

    $rotas = require __DIR__ . "/routes/web.php";

    $rota = $_GET['rota'] ?? 'portfolio';

    $metodo = $_SERVER['REQUEST_METHOD'];

    if (!isset($rotas[$metodo][$rota])) {
        http_response_code(404);
        echo "Página não encontrada!";
        exit;
    }

    [$controller, $acao] = $rotas[$metodo][$rota];

    $controller->$acao();
?>
