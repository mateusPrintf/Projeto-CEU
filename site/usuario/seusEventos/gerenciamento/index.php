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
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> <!-- ssl -->
    <title>CEU Online</title>
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link rel="stylesheet" href="../../../_css/style_menu.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../_css/style_gerenciamento_usuario.css">
    <link rel="stylesheet" href="../../../_css/style_menu.css">

    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../../../_css/style_menu.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
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
        
        <div class="container-fluid">
            <nav aria-label="breadcrumb" style="margin-top: 3.5em">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../../">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="../">Eventos criados</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Gerenciamento</li>
                </ol>
            </nav>

            <!-- Main component for a primary marketing message or call to action -->
            <div class="jumbotron jumbotron-fluid" style="margin-top: 0em">
                <div class="container">
                    <h1 class="display-4">Evento</h1>
                    <hr>
                    <h4 class="display-6">Nome do evento: <?=$evento->nome?></h4>
                    <h4 class="display-6">Descrição do evento: <?=$evento->descricao?></h4>
                    <h4 class="display-6">Data do inicio: <?=$evento->data_inicio?></h4>
                    <h4 class="display-6">Data do fim: <?=$evento->data_fim?></h4>
                    <h4 class="display-6">Local: <?=$evento->cidade?>-<?=$evento->estado?></h4>
                    <br>
                    <button class="btn btn-primary bntConfirma" id="<?=$att->id?>" data-toggle="modal" data-target="#ExemploModalCentralizado1">
                        Adicionar administrador
                    </button>
                </div>
            </div>

            <div class="container-fluid">

            </div>
        </div>
    </div>

     <!-- Modal -->
     <div class="modal fade" id="ExemploModalCentralizado1" tabindex="-1" role="dialog"
        aria-labelledby="TituloModalCentralizado" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header cupom" style="background: rgb(50, 150, 255)">
                   <h4 class="modal-title" id="TituloModalCentralizado">Adicionar novo administrador</h4> 
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <label>Email</label>
                    <form method="POST" action="../../../controller/InscricaoController.php?acao=inserirAdm&id_evento=<?=$_GET['id']?>">
                        <br>
                        <input type="text" class="form-control" name="emailAdm" placeholder="email@email.com">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                            <button type="submit" id="btnConfirmar" class="btn btn-primary">Confirmar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


</body>

</html>