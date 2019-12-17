<?php
    include_once "./conexao.php";
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
            <li>
                <a href="./gerenciamento_user_inicio.php">
                    <i class="fa fa-home" aria-hidden="true"></i> Meu usuário
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Informações do evento
                </a>
            </li>
            <li>
                <a href="./info_atividade.php?id=<?= $_GET['id'] ?>">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Atividades inscritas
                </a>
            </li>
        </ul>
    </div>

    <div class="content-container">

        <div class="container-fluid">
            <div class="container-fluid">

                <div class="card container-branco">
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