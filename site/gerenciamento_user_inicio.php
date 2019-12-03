<? require_once "validador_acesso.php"; ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>CEU Online</title>
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link rel="stylesheet" href="./_css/style_menu.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./_css/style_gerenciamento_usuario.css">
    <link rel="stylesheet" href="./_css/style_menu.css">
</head>

<body>
    <div class="menu-top menu-font">
        <header class="cabecalho">
            <div class="logo">
                <a href="#inicio">
                    <img src="./_imagens/CEU_noname_pequeno.png" alt="Logo" />
                </a>
            </div>
            <button class="menu-toggle">
              <i class="fa fa-lg fa-bars"></i>
          </button>
            <nav class="menu">
                <ul>
                    <li>
                        <a href="#inicio">Início</a>
                    </li>
                    <li>
                        <a href="evento.php">Eventos</a>
                    </li>
                    <li>
                        <a href="#sobre">Sobre</a>
                    </li>
                    <li>
                        <a href="#contato">Contato</a>
                    </li>
                </ul>
            </nav>
            <aside class="autenticacao">
                <a href="logoff.php">Sair</a>
            </aside>

        </header>
    </div>

    <div class="sidebar-container">
        <div class="sidebar-logo">
            Gerenciamento
        </div>
        <ul class="sidebar-navigation">
            <li class="header">Navegação</li>
            <li>
                <a href="">
                    <i class="fa fa-home" aria-hidden="true"></i> Meu usuário
                </a>
            </li>
            <li>
                <a href="./gerenciamento_user_evento.php">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Seus eventos
                </a>
            </li>
            <li>
                <a href="./gerenciamento_user_evento.php">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Eventos inscritos
                </a>
            </li>
            <li class="header">Configuração da conta</li>
            <li>
                <a href="./metodo_pagamento.php">
                    <i class="fa fa-users" aria-hidden="true"></i> Pagamentos
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-cog" aria-hidden="true"></i> Configurações
                </a>
            </li>
            <li>
                <a href="./gerenciamento_user_info.php">
                    <i class="fa fa-info-circle" aria-hidden="true"></i> Informações
                </a>
            </li>
        </ul>
    </div>

    <div class="content-container">

        <div class="container-fluid">

            <!-- Main component for a primary marketing message or call to action -->
            <div class="jumbotron">
                <h1>Bem vindo!</h1>
                <p>
                    Já possui um evento cadastrado no CEU? Caso ainda não possua, venha gerenciar seu evento no CEU!
                </p>
                <p>
                    <a class="btn btn-lg btn-primary" href="./cadastro_eventos.php" role="button">Cadastrar evento &raquo;</a>
                </p>
            </div>

            <div class="container-fluid">

            </div>
        </div>
    </div>


</body>

</html>