<?php

require_once __DIR__ . '/../app/Http/Controllers/ProjetoController.php';
require_once __DIR__ . '/../app/Http/Controllers/PortfolioControllers.php';

$projetoController = new ProjetoController();
$rotasProjeto = [
    'funcoes',
    'helpdesk',
    'http',
    'idade',
    'jogos',
    'json',
    'login-basico',
    'login-jogos',
    'notas',
    'notas-GET',
    'notas-desafio',
    'teste-post',
    'api/api-teste',
];

$rotasGet = [
    'portfolio' => [new PortfolioController(), 'index'],
];
$rotasPost = [];

foreach ($rotasProjeto as $rotaProjeto) {
    $rota = [$projetoController, 'exibir'];
    $rotasGet[$rotaProjeto] = $rota;
    $rotasPost[$rotaProjeto] = $rota;
}

return [
    'GET' => $rotasGet,
    'POST' => $rotasPost,
];

?>
