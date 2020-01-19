<?php
    include_once "../../../service/conexao.php";
    session_start();

    try {
        $conexao = new Conexao();
        
        $queryEvento = '
            select * from tb_evento where id = :id
        ';

        $stmtEvento = $conexao->prepare($queryEvento);
        $stmtEvento->bindValue(':id', $_GET['id']);
        $stmtEvento->execute();

        $evento = $stmtEvento->fetch(PDO::FETCH_OBJ); //PDO::FETCH_BOTH, _ASSOC, _NUM, _OBJ  S
        
    } catch (PDOException $e) {
        echo 'Erro: '.$e->getCode().' Mensagem: '.$e->getMessage();
        //podendo ser feito um registro de erros(logs) do sistema
    }
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> <!-- ssl -->
    <title>CEU Online</title>
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link rel="stylesheet" href="../../../_css/style_menu.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../_css/style_gerenciamento_usuario.css">
    <link rel="stylesheet" href="../../../_css/style_menu.css">
</head>

<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark navbar-full fixed-top" style="background-color: rgb(50, 150, 255); height: 80px;">
        <div class="logo" style="height: 80px">
            <a href="#inicio";>
                <img src="../../../_imagens/CEU_noname_pequeno.png" />
            </a>
        </div>
        <!-- <a class="navbar-brand" href="#">Inicio</a> -->
        <!-- <button class="navbar-toggler" type="button" <img src="../../../_imagens/CEU_noname_pequeno.png" alt="logo" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> -->
        <div class="collapse navbar-collapse menuTeste" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../../evento/">Eventos</a>
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
            <a class="nav-link" href="../../../service/logoff.php">Sair</a>
        </aside>
    </nav>

    <div class="sidebar-container">
        <div class="sidebar-logo">
            Gerenciamento
        </div>
        <ul class="sidebar-navigation">
            <li>
                <a href="../../">
                    <i class="fa fa-home" aria-hidden="true"></i> Meu usuário
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Evento
                </a>
            </li>
            <li>
                <a href="./atividades/?id=<?= $_GET['id'] ?>">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Atividades do evento
                </a>
            </li>
            <li>
                <a href="./atividadesInscritas/?id=<?= $_GET['id'] ?>">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Atividades inscritas
                </a>
            </li>
        </ul>
    </div>

    <div class="content-container">

        <div class="container-fluid">

            <nav aria-label="breadcrumb" style="margin-top: 3.5em">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../../">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="../">Eventos inscritos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Evento</li>
                </ol>
            </nav>

            <div class="container-fluid">

                <div class="card" style="margin-top: 0em">
                    <div class="card-header">
                        <h1>Informações sobre o evento</h1>
                    </div>
                    <div class="card-body">
                        <h2 class="card-title"><?=$evento->nome?></h2>
                        <hr>
                        <p class="card-text"><strong>Nome</strong>: <?= $evento->nome ?></p>
                        <p class="card-text"><strong>Descrição</strong>: <?= $evento->descricao ?></p>
                        <p class="card-text"><strong>Tipo</strong>: <?= $evento->tipo ?></p>
                        <p class="card-text"><strong>Área</strong>: <?= $evento->area ?></p>
                        <p class="card-text"><strong>Preço da inscrição do evento</strong>: <?= $evento->preco_evento ?></p>
                        <p class="card-text"><strong>Quantidade máxima de participantes</strong>: <?= $evento->qntd_part ?></p>
                        <p class="card-text"><strong>Data de inicio</strong>: <?= $evento->data_inicio ?></p>
                        <p class="card-text"><strong>Data do fim</strong>: <?= $evento->data_fim ?></p>
                        <p class="card-text"><strong>Endereço do evento</strong>: <?= $evento->endereco ?></p>
                        <p class="card-text"><strong>Bairro</strong>: <?= $evento->bairro ?></p>
                        <p class="card-text"><strong>Cidade</strong>: <?= $evento->cidade ?>-<?= $evento->estado ?> </p>
                        <p class="card-text"><strong>Cep</strong>: <?= $evento->cep ?></p>
                    </div>
                </div>
        </div>
    </div>


</body>

</html>