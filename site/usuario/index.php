<? require_once "../service/validador_acesso.php"; ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> <!-- ssl -->
    <title>CEU Online</title>
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link rel="stylesheet" href="../_css/style_menu.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../_css/style_gerenciamento_usuario.css">
    <link rel="stylesheet" href="../_css/style_menu.css">
</head>

<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark navbar-full fixed-top" style="background-color: rgb(50, 150, 255); height: 80px;">
        <div class="logo" style="height: 80px">
            <a href="#inicio";>
                <img src="../_imagens/CEU_noname_pequeno.png" />
            </a>
        </div>
        <!-- <a class="navbar-brand" href="#">Inicio</a> -->
        <!-- <button class="navbar-toggler" type="button" <img src="./_imagens/CEU_noname_pequeno.png" alt="logo" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> -->
        <div class="collapse navbar-collapse menuTeste" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../evento/">Eventos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Sobre</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li> -->
                
            </ul>
        </div>
        <aside class="nav-item">
            <a class="nav-link" href="../service/logoff.php">Sair</a>
        </aside>
    </nav>

    <div class="sidebar-container">
        <div class="sidebar-logo">
            Gerenciamento
        </div>
        <ul class="sidebar-navigation">
            <li>
                <a href="">
                    <i class="fa fa-home" aria-hidden="true"></i> Meu usuário
                </a>
            </li>
            <li>
                <a href="./seusEventos/">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Seus eventos
                </a>
            </li>
            <li>
                <a href="./eventosInscritos/">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Eventos inscritos
                </a>
            </li>
            <!-- <li>
                <a href="../metodo_pagamento.php">
                    <i class="fa fa-users" aria-hidden="true"></i> Pagamentos
                </a>
            </li> -->
            <li>
                <a href="./informacoes/">
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