<?php

    session_start();

    require_once "../models/ConexaoModel.php";
    require_once "../models/InscricaoAtividadeModel.php";
    require_once "../service/InscricaoAtividadeService.php";

    //RECEBE AS INFORMAÇÕES DO POST OU GET E ADICIONA/REMOVE/ATUALIZA/RECUPERA AO MODELO ATIVIDADE
    
    if (isset($_GET['acao'])) {

        if ($_GET['acao'] == "inserir") {
            $inscricaoAtividade = new InscricaoAtividade();
            $inscricaoAtividade->__set('id_atividade', $_GET['id_atividade']);
            $inscricaoAtividade->__set('id_evento', $_GET['id']);
            $inscricaoAtividade->__set('id_usuario', $_SESSION['id']);

            $conexao = new ConexaoModel();

            $inscricaoAtividadeService = new InscricaoAtividadeService($inscricaoAtividade, $conexao);

            if ($inscricaoAtividadeService->inserir() == 'sucesso') header('Location: ../usuario/eventosInscritos/evento/atividades/?id='. $_GET['id'] . '&acao=sucesso');
            else if ($inscricaoAtividadeService->inserir() == 'error') header('Location: ../usuario/eventosInscritos/evento/atividades/?id='. $_GET['id'] . '&acao=error');
            else if ($inscricaoAtividadeService->inserir() == 'jaCadastrado') header('Location: ../usuario/eventosInscritos/evento/atividades/?id='. $_GET['id'] . '&acao=jaCadastrado');
            else if ($inscricaoAtividadeService->inserir() == 'chockHorario') header('Location: ../usuario/eventosInscritos/evento/atividades/?id='. $_GET['id'] . '&acao=chockHorario');
            
        }else if ($_GET['acao'] == 'recuperarInscricaoUsuario') {
            $inscricaoAtividade = new InscricaoAtividade();
            $inscricaoAtividade->__set('id_usuario', $_GET['id_usuario']);

            $conexao = new ConexaoModel();

            $inscricaoAtividadeService = new InscricaoAtividadeService($inscricaoAtividade, $conexao);

            echo '<pre>';
            print_r($inscricaoAtividadeService->recuperarInscricaoUsuario());
            echo '</pre>';

        }else if ($_GET['acao'] == 'recuperarInscricaoEvento') {
            $inscricaoAtividade = new InscricaoAtividade();
            $inscricaoAtividade->__set('id_evento', $_GET['id_evento']);

            $conexao = new ConexaoModel();

            $inscricaoAtividadeService = new InscricaoAtividadeService($inscricaoAtividade, $conexao);

            echo '<pre>';
            print_r($inscricaoAtividadeService->recuperarInscricaoEvento());
            echo '</pre>';
        
        }else if ($_GET['acao'] == 'recuperarInscricaoAtividade') {
            $inscricaoAtividade = new InscricaoAtividade();
            $inscricaoAtividade->__set('id_atividade', $_GET['id_atividade']);

            $conexao = new ConexaoModel();

            $inscricaoAtividadeService = new InscricaoAtividadeService($inscricaoAtividade, $conexao);

            echo '<pre>';
            print_r($inscricaoAtividadeService->recuperarInscricaoAtividade());
            echo '</pre>';

        }else if ($_GET['acao'] == 'recuperarTodos') {
            $inscricaoAtividade = new InscricaoAtividade();
            $conexao = new ConexaoModel();

            $inscricaoAtividadeService = new InscricaoAtividadeService($inscricaoAtividade, $conexao);

            echo '<pre>';
            print_r($inscricaoAtividadeService->recuperarTodos());
            echo '</pre>';

        }else if ($_GET['acao'] == 'remover') {
            $inscricaoAtividade = new InscricaoAtividade();
            $inscricaoAtividade->__set('id_usuario', $_SESSION['id']);
            $inscricaoAtividade->__set('id_evento', $_GET['id']);
            $inscricaoAtividade->__set('id_atividade', $_GET['id_atividade']);

            $conexao = new ConexaoModel();

            $inscricaoAtividadeService = new InscricaoAtividadeService($inscricaoAtividade, $conexao);

            if ($inscricaoAtividadeService->remover()) header('Location: ../usuario/eventosInscritos/evento/atividadesInscritas/?id='. $_GET['id'] . '&acao=sucesso');
            else header('Location: ../usuario/eventosInscritos/evento/atividadesInscritas/?id='. $_GET['id'] . '&acao=error');;
        }
    }
?>