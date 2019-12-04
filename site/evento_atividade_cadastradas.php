<? require_once "validador_acesso.php"; ?>

<?php

    $dsn = 'mysql:host=127.0.0.1;dbname=ceu';
    $user = 'root';
    $senha = '1219';

    try {
        $conexao = new PDO($dsn, $user, $senha);
        
        $query = "select * from tb_atividade where id_evento = :id";

        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id', $_GET['id']);
        $stmt->execute();

        $eventos = $stmt->fetchAll(PDO::FETCH_OBJ); //PDO::FETCH_BOTH, _ASSOC, _NUM, _OBJ  
        
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
    <link rel="stylesheet" href="./_css/style_menu.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./_css/style_gerenciamento_usuario.css">
    <link rel="stylesheet" href="./_css/style_menu.css">
    <link rel="stylesheet" href="./_css/style_evento_gerenciamento.css">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
    <?php include_once('./Pagina 2/modal_cupom.php') ?>
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
            Gerenciamento evento
        </div>
        <ul class="sidebar-navigation">
            <li>
                <a href="./evento_gerenciamento.php?id=<?=$_GET['id']?>">
                    <i class="fa fa-home" aria-hidden="true"></i> Informações
                </a>
            </li>
            <li>
                <a href="./evento_cadastro_atividade.php?id=<?=$_GET['id']?>">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Cadastrar Atividade
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Atividades Cadastradas
                </a>
            </li>
        </ul>
    </div>

    <div class="content-container">

        <div class="container-fluid">
            <div class="container-fluid">
                <? foreach($eventos as $evento) {?>
                    <div class="card container-branco">
                        <div class="card-header">
                            <!--nome qualquer-->
                        </div>
                        <div class="card-body">
                            <h2 class="card-title"><?=$evento->nome?></h2>
                            <hr>
                            <p class="card-text"><strong>Tipo</strong>: <?=$evento->tipo?></p>
                            <p class="card-text"><strong>Data de inicio</strong>: <?=$evento->data_inicio?></p>
                            <p class="card-text"><strong>Data do fim</strong>: <?=$evento->data_fim?></p>
                            <p class="card-text"><strong>Inscrição</strong>: <?=$evento->inscricao?></p>
                            <p class="card-text"><strong>Quantidade máxima de participantes</strong>: <?=$evento->qntd_part?></p>
                            <p class="card-text"><strong>Valor da Inscrição</strong>: <?=$evento->valor?> R$</p>
                            <a href="#" class="btn btn-primary">Excluir atividade</a>
                            <!-- Botão para acionar modal -->
                            <a class="btn btn-primary" data-toggle="modal" data-target="#ExemploModalCentralizado">
                                Cadastrar cupom
                            </a>
                        </div>
                    </div>
                <?}?>
            </div>
        </div>
    </div>


</body>

</html>