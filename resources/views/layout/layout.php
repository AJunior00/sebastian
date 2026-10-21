<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/layout.css">
    <title>Layout de Atividades | Meu Portfólio</title>
</head>
<body>
    <header>

        <nav class="navbar">
            <h2 class="logo">
                Meu Portfólio
            </h2>
            <ul class="menu">
                <li>
                    <a href="../index.php"> Início </a>
                </li>
                <li>
                    <a href="../index.php#projetos"> Projetos </a>
                </li>
            </ul>
        </nav>
    </header>

    <main class="pagina-projeto">

        <section class="cabecalho-projeto">
            <p class="projeto-tipo">
                Projeto
            </p>
            <h1> 
                Cadastro de Jogos 

            </h1>
            <p>
                Atividade desenvolvida durante as aulas
                de Desenvolvimento de Sistemas.
            </p>
        </section>

        <section class="conteudo-projeto">
            <h2>Cadastro de Jogos</h2>
        </section>
        <form method="post" class="formulario-jogos">
        <input type="text" name="nome" maxlength="100" placeholder="Nome do jogo" required>
        <input type="text" name="genero" maxlength="50" placeholder="Gênero" required>
        <input type="number" name="nota" min="0" max="10" placeholder="Nota" required>
        <input type="number" name="ano_lancamento" placeholder="Ano de lançamento" required>
        <button type="submit">Cadastrar</button>
    </form>



        <div class="voltar-projetos">
            <a href="../index.php#projetos"> ← Voltar para projetos </a>
        </div>
    </main>

    <footer>
        <p> Desenvolvido por <a href="sebastian315.devlook.xyz"> Sebastián Andrade </a> • 2026 </p>
    </footer>
</body>
</html>