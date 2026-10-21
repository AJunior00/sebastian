<?php

require_once __DIR__ . '/../app/Http/Controllers/HelpdeskController.php';

return [
    'GET' => [
        'portfolio' => [new PortfolioController(), 'index'],
        'helpdesk' => [new HelpdeskController(), 'index'],
        'jogos' => [],
        'funcoes' => [],
        'login-basico' => [],
        'idade' => [],

        ],
        'POST' => [
        'helpdesk' => [new HelpdeskController(), ''],
        ]
    ];

?>