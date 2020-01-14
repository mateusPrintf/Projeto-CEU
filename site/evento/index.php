<?php

    include_once "../service/conexao.php";
    
    session_start();

    $eventosProcurado = [];
    $dataInicio = new DateTime();
    $dataFim = new DateTime();

    try {
        $conexao = new Conexao();
        
        $query = 'select * from tb_evento';

        if(!empty($_POST['nome']) && isset($_POST['tipo']) && $_POST['tipo'] != 'todos') {
            $query .= ' where lower(nome) = lower(:nome) and area = :area';
            $stmt = $conexao->prepare($query);
            $stmt->bindValue(':nome', $_POST['nome']);
            $stmt->bindValue(':area', $_POST['tipo']);
        }
        
        if (!empty($_POST['nome'])) {
            $query .= ' where lower(nome) = lower(:nome)';
            $stmt = $conexao->prepare($query);
            $stmt->bindValue(':nome', $_POST['nome']);
        
        }else if (isset($_POST['tipo']) && $_POST['tipo'] != 'todos') {
            $query .= ' where area = :area';
            $stmt = $conexao->prepare($query);
            $stmt->bindValue(':area', $_POST['tipo']);
        
        }else {
            $stmt = $conexao->prepare($query);
        }

        $stmt->execute();
        $eventos = $stmt->fetchAll(PDO::FETCH_OBJ);

        if (isset($_POST['data'])) {
            foreach ($eventos as $evento) {
                list($diaIni, $mesIni, $anoIni) = explode('/',$evento->data_inicio);
                list($diaFim, $mesFim, $anoFim) = explode('/',$evento->data_fim);
                $dataInicio->setDate($anoIni, $mesIni, $diaIni);
                $dataFim->setDate($anoFim, $mesFim, $diaFim);

                if ($_POST['data'] == 'hoje') {
                    if (date('z') >= $dataInicio->format('z') && date('z') <= $dataFim->format('z')) {
                        array_push($eventosProcurado, $evento);
                    }

                }else if ($_POST['data'] == 'semana') {
                    if (date('W') >= $dataInicio->format('W') && date('W') <= $dataFim->format('W')) {
                        array_push($eventosProcurado, $evento);
                    }

                }else if ($_POST['data'] == 'mes') {
                    if (date('m') == $mesIni || date('m') == $mesFim) {
                        array_push($eventosProcurado, $evento);
                    }
                    
                }else {
                    array_push($eventosProcurado, $evento);
                }
            }
        }
        
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../_css/style_menu.css" />
    <link rel="stylesheet" href="../_css/style_lista_evento.css">      

    <script>
       
        function alerta(nomeAlerta) {
            if (nomeAlerta == 'chockHorario') return alert('Você já está inscrito em um evento no mesmo horário deste!')
            else if (nomeAlerta == 'numMaxAtingido') return alert('Número máximo de participantes atingido!')
            else if (nomeAlerta == 'inscricaoFeita') return alert('Inscrição realizada com sucesso')
        }

    </script>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-full fixed-top" style="background-color: rgb(50, 150, 255); height: 80px;">
        <div class="logo" style="height: 80px">
            <a href="../usuario/";>
                <img src="../_imagens/CEU_noname_pequeno.png" />
            </a>
        </div>
        <!-- <a class="navbar-brand" href="#">Inicio</a> -->
        <!-- <button class="navbar-toggler" type="button" <img src="./_imagens/CEU_noname_pequeno.png" alt="logo" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> -->
        <div class="collapse navbar-collapse menuTeste" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="../usuario/">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Eventos</a>
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
            <a class="nav-link" href="../logoff.php">Sair</a>
        </aside>
    </nav>

    <nav id="evento">
        <h1>Área de Eventos</h1>
    </nav>

    <div class="container">
        <div>
            <nav id="evento">
                <form method="post" action="../evento/">
                    <div class="form-row">
                        <div class="col-2">
                            <input type="text" class="form-control" placeholder="Nome do Evento" name="nome">
                        </div>
                        <div class="col-2">
                            <select class="form-control" name="tipo">
                                <option value="palestra">Palestra</option>
                                <option value="minicurso">Minicurso</option>
                                <option value="todos" selected>Todos</option>
                            </select>
                        </div>
                        <div class="col-2">
                            <select class="form-control" name="data">
                                <option value="todos">Todas as datas</option>
                                <option value="hoje">Hoje</option>
                                <option value="semana">Esta semana</option>
                                <option value="mes">Este mês</option>
                            </select>
                        </div>
                        <div class="button-env">
                            <button class="btn btn-primary" type="submit">Buscar Evento</button>
                        </div>
                </form> 
            </nav>

        <div id="lista-evento">
            <div class="row">
                <? if (isset($_GET['acao'])){?>
                    <script>
                        alerta('<?= $_GET['acao'] ?>')
                    </script>
                <?}?> 
                <? if (isset($eventosProcurado) && !empty($eventosProcurado)) {?>
                    <? foreach ($eventosProcurado as $evento) {?>
                        <div class="col-sm-6">
                            <div class="card" id="card-top">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $evento->nome ?></h5>
                                    <p class="card-text"><?= $evento->descricao ?></p>
                                    <a href="../controller/InscricaoController.php?acao=inserir&id_evento=<?=$evento->id?>" class="btn btn-primary">Inscrever</a>
                                </div>
                            </div>
                        </div>
                    <?}?>
                <?}?>
            </div>
        </div>
    </div>
</body>

</html>