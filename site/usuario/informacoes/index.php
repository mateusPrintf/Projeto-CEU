<? require_once "../../service/validador_acesso.php"; ?>

<?php
    
    include_once "../../service/conexao.php";

    try {
        $conexao = new Conexao();
        
        $query = "select * from tb_usuario where ";
        $query .= " id = :id";

        $stmt = $conexao->prepare($query);

        $stmt->bindValue(':id', $_SESSION['id']);

        $stmt->execute();

        $usuario_dados = $stmt->fetch(); //PDO::FETCH_BOTH, _ASSOC, _NUM, _OBJ  
        
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
                <a href="../seusEventos/">
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
                <a href="">
                    <i class="fa fa-info-circle" aria-hidden="true"></i> Informações
                </a>
            </li>
        </ul>
    </div>

    <div class="content-container">

        <div class="container-fluid">

            <nav aria-label="breadcrumb" style="margin-top: 3.5em">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../">Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Informações</li>
                </ol>
            </nav>

            <!-- Main component for a primary marketing message or call to action -->

            <div class="container-fluid" style="margin-top: -3.8em">
                <h1 class="display-4 font-inicio font-inicio-info"> Informações cadastrais</h1>
                <hr>

                <div>
                    <h1 class="display-4 font-user">Nome de usuário</h1>
                    <h1 class="display-4 font-informacoes"><?= $usuario_dados['nome'] ?></h1>
                    <hr>
                </div>

                <div>
                    <h1 class="display-4 font-user">Username</h1>
                    <h1 class="display-4 font-informacoes"><?= $usuario_dados['usuario'] ?></h1>
                    <hr>
                </div>

                <div>
                    <h1 class="display-4 font-user">Endereço de email da conta</h1>
                    <h1 class="display-4 font-informacoes"><?= $usuario_dados['email'] ?></h1>
                    <hr>
                </div>

                <div>
                    <h1 class="display-4 font-user">Estado</h1>
                    <h1 class="display-4 font-informacoes"><?= $usuario_dados['estado'] ?></h1>
                    <hr>
                </div>

                <div>
                    <h1 class="display-4 font-user">Cidade</h1>
                    <h1 class="display-4 font-informacoes"><?= $usuario_dados['cidade'] ?></h1>
                    <hr>
                </div>

                <div>
                    <h1 class="display-4 font-user">CEP</h1>
                    <h1 class="display-4 font-informacoes"><?= $usuario_dados['cep'] ?></h1>
                    <hr>
                </div>
            </div>
        </div>
    </div>


</body>

</html>