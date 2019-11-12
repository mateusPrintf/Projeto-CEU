<? require_once "validador_acesso.php"; ?>

<?php
    $dsn = 'mysql:host=127.0.0.1;dbname=ceu';
    $user = 'root';
    $senha = '1219';

    try {
        $conexao = new PDO($dsn, $user, $senha);
        
        $query = "select * from tb_evento where ";
        $query .= " id = :id";

        $stmt = $conexao->prepare($query);

        $stmt->bindValue(':id', $_SESSION['id']);

        $stmt->execute();

        $eventos_dados = $stmt->fetch(); //PDO::FETCH_BOTH, _ASSOC, _NUM, _OBJ  
        
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
                        <a href="./tela Evento/evento.html">Eventos</a>
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
            <li class="header">Navegação</li>
            <li>
                <a href="./gerenciamento_user_inicio.php">
                    <i class="fa fa-home" aria-hidden="true"></i> Meu usuário
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Eventos
                </a>
            </li>
            <li class="header">Conta</li>
            <li>
                <a href="./metodo_pagamento.php">
                    <i class="fa fa-users" aria-hidden="true"></i> Pagamentos
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-cog" aria-hidden="true"></i> Configurações
                </a>
            </li>
            <li>
                <a href="./gerenciamento_user_info.php">
                    <i class="fa fa-info-circle" aria-hidden="true"></i> Informações
                </a>
            </li>
        </ul>
    </div>

    <div class="content-container">

        <div class="container-fluid">
            <div class="container-fluid">
                <h1 class="display-4 font-inicio"> Seus eventos</h1>
                <hr>
                <!-- Aqui -->
                <div class="card text-center">
                    <div class="card-header card-header-centerC">
                        Destaque
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Título do evento</h5>
                        <p class="card-text">Descrição a respeito do evento</p>
                        <a href="#" class="btn btn-primary">Ir para a pagina do evento</a>
                    </div>
                    <div class="card-footer text-muted card-header-centerC">
                        2 dias atrás
                    </div>
                </div>
                <!-- Aqui -->
                <hr>
            </div> 
        </div>
    </div>


</body>

</html>