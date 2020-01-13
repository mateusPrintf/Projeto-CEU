<? require_once "../../../service/validador_acesso.php"; ?>

<?php

    include_once "../../../service/conexao.php";

    try {
        $conexao = new Conexao();
        
        $query = "select * from tb_evento where id = :id";

        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id', $_GET['id']);
        $stmt->execute();

        $evento = $stmt->fetch(PDO::FETCH_OBJ); //PDO::FETCH_BOTH, _ASSOC, _NUM, _OBJ  
        
    } catch (PDOException $e) {
        echo 'Mensagem: '.$e->getMessage();
        //podendo ser feito um registro de erros(logs) do sistema
    }

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
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
            Gerenciamento evento
        </div>
        <ul class="sidebar-navigation">
            <li>
                <a href="../../">
                    <i class="fa fa-home" aria-hidden="true"></i> Meu usuario
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fa fa-home" aria-hidden="true"></i> Informações
                </a>
            </li>
            <li>
                <a href="./cadastrarAtividade/?id=<?=$_GET['id']?>">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Cadastrar Atividade
                </a>
            </li>
            <li>
                <a href="./atividadesCadastradas/?id=<?=$_GET['id']?>">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Atividades Cadastradas
                </a>
            </li>
        </ul>
    </div>

    <div class="content-container">

        <div class="container-fluid container-branco">

            <!-- Main component for a primary marketing message or call to action -->
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Evento</h1>
                    <hr>
                    <h4 class="display-6">Nome do evento: <?=$evento->nome?></h4>
                    <h4 class="display-6">Descrição do evento: <?=$evento->descricao?></h4>
                    <h4 class="display-6">Data do inicio: <?=$evento->data_inicio?></h4>
                    <h4 class="display-6">Data do fim: <?=$evento->data_fim?></h4>
                    <h4 class="display-6">Local: <?=$evento->cidade?>-<?=$evento->estado?></h4>
                </div>
            </div>

            <div class="container-fluid">

            </div>
        </div>
    </div>


</body>

</html>