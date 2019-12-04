<? require_once "validador_acesso.php"; ?>

<?php
    $dsn = 'mysql:host=127.0.0.1;dbname=ceu';
    $user = 'root';
    $senha = '1219';

    try {
        $conexao = new PDO($dsn, $user, $senha);
        
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
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Seus eventos
                </a>
            </li>
            <li>
                <a href="./gerenciamento_user_evento_inscrito.php">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Eventos inscritos
                </a>
            </li>
            <li>
                <a href="./metodo_pagamento.php">
                    <i class="fa fa-users" aria-hidden="true"></i> Pagamentos
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
                <h1 class="display-4 font-inicio"> Seus eventos criados</h1>
                <hr>
                <? foreach ($eventos_dados as $evento) { ?>
                    <div class="card text-center mb-5">
                        <div class="card-header card-header-centerC">
                            
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= $evento->nome ?></h5>
                            <p class="card-text"><?= $evento->descricao ?></p>
                            <a href="evento_gerenciamento.php?id=<?=$evento->id?>" class="btn btn-primary">Ir para a pagina do evento</a>
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