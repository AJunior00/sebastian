<?php

//require_once __DIR__ . '/../app/Http/Controllers/Helpdesk.Controller.php';
require_once __DIR__ . '/../app/Http/Controllers/PortfolioControllers.php';

return [
    'GET' => [
        'portfolio' => [new PortfolioController(), 'index'],
        //'helpdesk' => [new HelpdeskController(), 'index'],
        // 'jogos' => [],
        // 'funcoes' => [],
        // 'login-basico' => [],
        // 'idade' => [],

        ],
        'POST' => [
        //'helpdesk' => [new HelpdeskController(), ''],
        ]
    ];

?>
