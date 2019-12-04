<? require_once "validador_acesso.php"; ?>

<?php

    $dsn = 'mysql:host=127.0.0.1;dbname=ceu';
    $user = 'root';
    $senha = '1219';

    try {
        $conexao = new PDO($dsn, $user, $senha);
        
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
    <title>CEU Online</title>
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link rel="stylesheet" href="./_css/style_menu.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./_css/style_gerenciamento_usuario.css">
    <link rel="stylesheet" href="./_css/style_menu.css">
</head>

<body>

    <header class="cabecalho menu-font">
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
                <a href="./gerenciamento_user_evento.php">
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
                <a href="">
                    <i class="fa fa-info-circle" aria-hidden="true"></i> Informações
                </a>
            </li>
        </ul>
    </div>

    <div class="content-container">

        <div class="container-fluid">

            <!-- Main component for a primary marketing message or call to action -->

            <div class="container-fluid">
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