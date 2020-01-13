<?php

    require_once "../models/ConexaoModel.php";
    require_once "../models/InscricaoModel.php";
    require_once "../service/InscricaoService.php";

    //RECEBE AS INFORMAÇÕES DO POST OU GET E ADICIONA/REMOVE/ATUALIZA/RECUPERA AO MODELO ATIVIDADE
    
    if (isset($_GET['acao'])) {

        if ($_GET['acao'] == "inserir") {
            $inscricao = new Inscricao();
            $conexao = new ConexaoModel();

            $inscricao->__set('id_evento', $_GET['id_evento']);
            $inscricao->__set('id_usuario', $_GET['id_usuario']);

            $inscricaoService = new InscricaoService($inscricao, $conexao);

            if ($inscricaoService->inserir()) echo 'sucesso';
            else echo 'error';
            
        }else if ($_GET['acao'] == 'recuperarInscricaoUsuario') {
            $inscricao = new Inscricao();
            $inscricao->__set('id_usuario', $_GET['id_usuario']);
            $conexao = new ConexaoModel();

            $inscricaoService = new InscricaoService($inscricao, $conexao);

            echo '<pre>';
            print_r($inscricaoService->recuperarInscricaoUsuario());
            echo '</pre>';

        }else if ($_GET['acao'] == 'recuperarInscricaoEvento') {
            $inscricao = new Inscricao();
            $inscricao->__set('id_evento', $_GET['id_evento']);
            $conexao = new ConexaoModel();

            $inscricaoService = new InscricaoService($inscricao, $conexao);

            echo '<pre>';
            print_r($inscricaoService->recuperarInscricaoEvento());
            echo '</pre>';

        }else if ($_GET['acao'] == 'recuperarTodos') {
            $inscricao = new Inscricao();
            $conexao = new ConexaoModel();

            $inscricaoService = new InscricaoService($inscricao, $conexao);

            echo '<pre>';
            print_r($inscricaoService->recuperarTodos());
            echo '</pre>';

        }else if ($_GET['acao'] == 'remover') {
            $inscricao = new Inscricao();
            $inscricao->__set('id_usuario', $_GET['id_usuario']);
            $inscricao->__set('id_evento', $_GET['id_evento']);

            $conexao = new ConexaoModel();

            $inscricaoService = new InscricaoService($inscricao, $conexao);

            if ($inscricaoService->remover()) echo 'sucesso';
            else echo 'error';
        }
    }
?>