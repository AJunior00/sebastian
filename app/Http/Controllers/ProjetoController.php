<?php

class ProjetoController
{
    private const PAGINAS = [
        'funcoes' => 'funcoes.php',
        'helpdesk' => 'helpdesk.php',
        'http' => 'http.php',
        'idade' => 'idade.php',
        'jogos' => 'jogos.php',
        'json' => 'json.php',
        'login-basico' => 'login-basico.php',
        'login-jogos' => 'login-jogos.php',
        'notas' => 'notas.php',
        'notas-GET' => 'notas-GET.php',
        'notas-desafio' => 'notas-desafio.php',
        'teste-post' => 'teste-post.php',
        'api/api-teste' => 'api/api-teste.php',
    ];

    public function exibir(): void
    {
        $rota = $_GET['rota'] ?? '';

        if (!isset(self::PAGINAS[$rota])) {
            http_response_code(404);
            echo 'Projeto não encontrado.';
            return;
        }

        require __DIR__ . '/../../../resources/views/projetos/' . self::PAGINAS[$rota];
    }
}
