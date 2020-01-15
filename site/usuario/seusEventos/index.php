<? require_once "../../service/validador_acesso.php"; ?>

<?php

    include_once "../../service/conexao.php";

    try {
        $conexao = new Conexao();
        
        $query = "select * from tb_evento where id_usuario = :id_usuario";

        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id_usuario', $_SESSION['id']);
        $stmt->execute();

        $eventos_dados = $stmt->fetchAll(PDO::FETCH_OBJ); //PDO::FETCH_BOTH, _ASSOC, _NUM, _OBJ  
        
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
    <link rel="stylesheet" href="../../_css/style_menu.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../../_css/style_gerenciamento_usuario.css">
    <link rel="stylesheet" href="../../_css/style_menu.css">
</head>

<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark navbar-full fixed-top" style="background-color: rgb(50, 150, 255); height: 80px;">
        <div class="logo" style="height: 80px">
            <a href="#inicio";>
                <img src="../../_imagens/CEU_noname_pequeno.png" />
            </a>
        </div>
        <!-- <a class="navbar-brand" href="#">Inicio</a> -->
        <!-- <button class="navbar-toggler" type="button" <img src="../../_imagens/CEU_noname_pequeno.png" alt="logo" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> -->
        <div class="collapse navbar-collapse menuTeste" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../evento/">Eventos</a>
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
            <a class="nav-link" href="../../service/logoff.php">Sair</a>
        </aside>
    </nav>

    <div class="sidebar-container">
        <div class="sidebar-logo">
            Gerenciamento
        </div>
        <ul class="sidebar-navigation">
            <li>
                <a href="../">
                    <i class="fa fa-home" aria-hidden="true"></i> Meu usuário
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Eventos criados
                </a>
            </li>
            <li>
                <a href="../eventosInscritos/">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Eventos inscritos
                </a>
            </li>
            <!-- <li>
                <a href="../../metodo_pagamento.php">
                    <i class="fa fa-users" aria-hidden="true"></i> Pagamentos
                </a>
            </li> -->
            <li>
                <a href="../informacoes/">
                    <i class="fa fa-info-circle" aria-hidden="true"></i> Informações
                </a>
            </li>
        </ul>
    </div>

    <div class="content-container">

        <div class="container-fluid">
            <div class="container-fluid">
                <h1 class="display-4 font-inicio"> Seus eventos criados</h1>
                <hr>
                <? foreach ($eventos_dados as $evento) { ?>
                    <div class="card text-center mb-5">
                        <div class="card-header card-header-centerC">
                            
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= $evento->nome ?></h5>
                            <p class="card-text"><?= $evento->descricao ?></p>
                            <a href="./gerenciamento/?id=<?=$evento->id?>" class="btn btn-primary">Ir para a pagina de gerenciamento do evento</a>
                        </div>
                        <div class="card-footer text-muted card-header-centerC">
                            Data de inicio: <?= $evento->data_inicio ?> | Data de termino: <?= $evento->data_fim ?>
                        </div>
                    </div>
                <?}?>
                <hr>
            </div> 
        </div>
    </div>


</body>

</html>