<?php
    include_once "../../../../service/conexao.php";
    session_start();

    try {
        $conexao = new Conexao();

        $queryAtt = '
            SELECT * FROM tb_atividade 
                INNER JOIN tb_inscricao_atividade ON(
                    tb_atividade.id = tb_inscricao_atividade.id_atividade)
                         WHERE id_usuario = :id_usuario AND tb_inscricao_atividade.id_evento = :id_evento
        ';
        
        $stmtAtt = $conexao->prepare($queryAtt);
        $stmtAtt->bindValue(':id_usuario', $_SESSION['id']);
        $stmtAtt->bindValue(':id_evento', $_GET['id']);
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
    <link rel="stylesheet" href="../../../../_css/style_menu.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../../_css/style_gerenciamento_usuario.css">
    <link rel="stylesheet" href="../../../../_css/style_menu.css">
    <link rel="stylesheet" href="../../../../_ceu/style_evento_gerenciamento.css">
</head>

<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark navbar-full fixed-top" style="background-color: rgb(50, 150, 255); height: 80px;">
        <div class="logo" style="height: 80px">
            <a href="#inicio";>
                <img src="../../../../_imagens/CEU_noname_pequeno.png" />
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
                    <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../../../evento/">Eventos</a>
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
            <a class="nav-link" href="../../../../service/logoff.php">Sair</a>
        </aside>
    </nav>

    <div class="sidebar-container">
        <div class="sidebar-logo">
            Gerenciamento
        </div>
        <ul class="sidebar-navigation">
            <li>
                <a href="../../../">
                    <i class="fa fa-home" aria-hidden="true"></i> Meu usuário
                </a>
            </li>
            <li>
                <a href="../?id=<?= $_GET['id']?>">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Evento
                </a>
            </li>
            <li>
                <a href="../atividades/?id=<?= $_GET['id']?>">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Atividades do evento
                </a>
            </li>
            <li>
                <a href="../atividadesInscritas/?id=<?= $_GET['id'] ?>">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Atividades inscritas
                </a>
            </li>
        </ul>
    </div>

    <div class="content-container">

        <div class="container-fluid">
            <div class="container-fluid">

                <div class="card container-branco" style="margin-top: 4em">
                    <div class="card-header">
                        <h1>Atividades inscritas</h1>
                    </div>
                    <div class="card-body">
                        
                        <? if (!empty($atividades)) { ?>
                            <hr>
                            <? foreach($atividades as $att) { ?>
                                <h2 class="card-title"><?=$att->nome?></h2>
                                <hr>
                                <p class="card-text"><strong>Tipo</strong>: <?=$att->tipo?></p>
                                <p class="card-text"><strong>Data de inicio</strong>: <?=$att->data_inicio?></p>
                                <p class="card-text"><strong>Data do fim</strong>: <?=$att->data_fim?></p>
                                <p class="card-text"><strong>Inscrição</strong>: <?=$att->inscricao?></p>
                                <p class="card-text"><strong>Quantidade máxima de participantes</strong>: <?=$att->qntd_part?></p>
                                <p class="card-text"><strong>Valor da Inscrição</strong>: <?=$att->valor?> R$</p>
                                <a href="../../../../controller/InscricaoAtividadeController.php?acao=remover&id=<?=$_GET['id']?>&id_atividade=<?=$att->id?>" class="btn btn-primary">Desinscrever-se</a><hr><br><br>
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


</body>

</html>