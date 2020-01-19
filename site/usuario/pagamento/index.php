<?php

    include_once "../../service/conexao.php";
    session_start();

    try {
        $conexao = new Conexao();

        $queryAtt = '
        SELECT * FROM tb_atividade INNER JOIN tb_inscricao_atividade ON 
        (tb_atividade.id = tb_inscricao_atividade.id_atividade) WHERE tb_inscricao_atividade.id_usuario = :id_usuario
        ';
        
        $stmtAtt = $conexao->prepare($queryAtt);
        $stmtAtt->bindValue(':id_usuario', $_SESSION['id']);
        $stmtAtt->execute();

        $atividades = $stmtAtt->fetchAll(PDO::FETCH_OBJ);


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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../../_css/style_gerenciamento_usuario.css">
    <link rel="stylesheet" href="../../_css/style_menu.css">
    <link rel="stylesheet" href="../../_ceu/style_evento_gerenciamento.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
   
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-full fixed-top"
        style="background-color: rgb(50, 150, 255); height: 80px;">
        <div class="logo" style="height: 80px">
            <a href="#inicio" ;>
                <img src="../../_imagens/CEU_noname_pequeno.png" />
            </a>
        </div>
        <!-- <a class="navbar-brand" href="#">Inicio</a> -->
        <!-- <button class="navbar-toggler" type="button" <img src="../../../../_imagens/CEU_noname_pequeno.png" alt="logo" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> -->
        <div class="collapse navbar-collapse menuTeste" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="../../usuario">Inicio <span class="sr-only">(current)</span></a>
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
            Pagamento
        </div>
        <ul class="sidebar-navigation">
            <li>
                <a href="../../usuario">
                    <i class="fa fa-home" aria-hidden="true"></i> Meu usuário
                </a>
            </li>
        </ul>
    </div>

    <div class="content-container">

        <div class="container-fluid">
            <nav aria-label="breadcrumb" style="margin-top: 3.5em">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../../usuario">Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pagamento</li>
                </ol>
            </nav>
            <div class="container-fluid">

                <div class="card container-branco">
                    <div class="card-header">
                        <h1>Atividades a Pagar</h1>
                    </div>
                    <div class="card-body">

                        <? if (!empty($atividades)) { ?>
                        <hr>
                        <? foreach($atividades as $att) { ?>
                        <?$id_atv = $att->id_atividade;?>
                        <h2 class="card-title"><?=$att->nome?></h2>
                        <hr>
                        <p class="card-text"><strong>Tipo</strong>: <?=$att->tipo?></p>
                        <p class="card-text"><strong>Valor</strong>: R$<?=$att->valor?>.00</p>
                        <p class="card-text"><strong>Data Inico</strong>: <?=$att->data_inicio?></p>
                        <a href="./pagamento.php?id_atv=<?=$att->id_atividade?>" type="button" class="btn btn-primary">Efetuar pagamento</a>
                        <hr><br>
                        <?}?>
                        <? } else { ?>
                        <div class="bg-center">
                            <h4>Sem atividades inscritas.</h4>
                        </div>
                        <? } ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>