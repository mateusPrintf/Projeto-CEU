<?php

    session_start();

    require_once "../models/ConexaoModel.php";
    require_once "../models/EventoModel.php";
    require_once "../service/EventoService.php";

    //RECEBE AS INFORMAÇÕES DO POST OU GET E ADICIONA/REMOVE/ATUALIZA/RECUPERA AO MODELO USUARIO
    
    if (isset($_GET['acao'])) {
        if ($_GET['acao'] == "inserir") {
            $evento = new Evento();
            $evento->__set('id_usuario', $_SESSION['id']);
            $evento->__set('nome', $_POST['nome']);
            $evento->__set('email', $_POST['email']);
            $evento->__set('descricao', $_POST['descricao']);
            $evento->__set('tipo', $_POST['tipo']);
            $evento->__set('area', $_POST['area']);
            $evento->__set('preco_evento', $_POST['valor']);
            $evento->__set('qntd_part', $_POST['qntd_part']);
            $evento->__set('data_inicio', $_POST['data_inicio']);
            $evento->__set('data_fim', $_POST['data_fim']);
            $evento->__set('endereco', $_POST['endereco']);
            $evento->__set('bairro', $_POST['bairro']);
            $evento->__set('estado', $_POST['estado']);
            $evento->__set('cidade', $_POST['cidade']);
            $evento->__set('cep', $_POST['cep']);
            $evento->__set('num_usuario_cads', 0);

            $conexao = new ConexaoModel();
            $eventoService = new EventoService($evento, $conexao);

            // echo '<pre>';
            // print_r($_SESSION);
            // echo '</pre>';

            // $eventoService->inserir();
            
            if ($eventoService->inserir()) header('Location: ../usuario/?acao=sucesso');
            else header('Location: ../usuario/?acao=error');

        
        }else if ($_GET['acao'] == 'recuperar') {
            $evento = new Evento();
            $conexao = new ConexaoModel();

            $eventoService = new EventoService($evento, $conexao);
            
            if ($eventoService->recuperar()) echo "sucesso";
            else echo "error";
        
        }else if ($_GET['acao'] == 'atualizar') {
            $evento = new Evento();
            $evento->__set('id_usuario', $_POST['id_usuario']);
            $evento->__set('nome', $_POST['nome']);
            $evento->__set('email', $_POST['email']);
            $evento->__set('descricao', $_POST['descricao']);
            $evento->__set('tipo', $_POST['tipo']);
            $evento->__set('area', $_POST['area']);
            $evento->__set('preco_evento', $_POST['preco_evento']);
            $evento->__set('qntd_part', $_POST['qntd_part']);
            $evento->__set('data_inicio', $_POST['data_inicio']);
            $evento->__set('data_fim', $_POST['data_fim']);
            $evento->__set('endereco', $_POST['endereco']);
            $evento->__set('bairro', $_POST['bairro']);
            $evento->__set('estado', $_POST['estado']);
            $evento->__set('cidade', $_POST['cidade']);
            $evento->__set('cep', $_POST['cep']);
            $evento->__set('num_usuario_cads', $_POST['num_usuario_cads']);

            // $evento = new Evento();
            // $evento->__set('id_usuario', 8);
            // $evento->__set('nome', 'Um evento teste de Classe ATT');
            // $evento->__set('email', 'Lucianolps07@gmail.com');
            // $evento->__set('descricao', 'Uma descricao ATT');
            // $evento->__set('tipo', "Um tipo la ATT");
            // $evento->__set('area', "Uma area la ATT");
            // $evento->__set('preco_evento', 2);
            // $evento->__set('qntd_part', 30);
            // $evento->__set('data_inicio', '21/12/2019');
            // $evento->__set('data_fim', '22/12/2019');
            // $evento->__set('endereco', 'Rua Capitão Manoel de Oliveira ATT, 865');
            // $evento->__set('bairro', 'recreio');
            // $evento->__set('estado', 'pI');
            // $evento->__set('cidade', 'piripiri');
            // $evento->__set('cep', '64260000');
            // $evento->__set('num_usuario_cads', 1);

            $conexao = new ConexaoModel();
            $eventoService = new EventoService($evento, $conexao);

            if ($eventoService->atualizar()) echo 'sucesso';
            else echo 'error';

        }else if ($_GET['acao'] == 'remover') {
            $evento = new Evento();
            $conexao = new ConexaoModel();

            $eventoService = new EventoService($evento, $conexao);
            
            if ($eventoService->remover()) echo 'sucesso';
            else echo 'error';
        }
    }

?>