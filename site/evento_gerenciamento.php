<? require_once "validador_acesso.php"; ?>

<?php

    include_once "./conexao.php";

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
            Gerenciamento evento
        </div>
        <ul class="sidebar-navigation">
            <li>
                <a href="./gerenciamento_user_inicio.php">
                    <i class="fa fa-home" aria-hidden="true"></i> Meu usuario
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fa fa-home" aria-hidden="true"></i> Informações
                </a>
            </li>
            <li>
                <a href="./evento_cadastro_atividade.php?id=<?=$_GET['id']?>">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Cadastrar Atividade
                </a>
            </li>
            <li>
                <a href="evento_atividade_cadastradas.php?id=<?=$_GET['id']?>">
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