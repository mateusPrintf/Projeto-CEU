<?php

    require_once "../models/ConexaoModel.php";
    require_once "../models/AtividadeModel.php";
    require_once "../service/AtividadeService.php";

    //RECEBE AS INFORMAÇÕES DO POST OU GET E ADICIONA/REMOVE/ATUALIZA/RECUPERA AO MODELO ATIVIDADE
    
    if (isset($_GET['acao'])) {

        if ($_GET['acao'] == "inserir") {
            $atividade = new Atividade();
            $atividade->__set('id_evento', $_GET['id']);
            $atividade->__set('nome', $_POST['nome']);
            $atividade->__set('qntd_part', $_POST['qntd_part']);
            $atividade->__set('inscricao', $_POST['inscricao']);
            $atividade->__set('valor', $_POST['valor']);
            $atividade->__set('tipo', $_POST['tipo']);
            $atividade->__set('carga_hr', $_POST['carga_hr']);
            $atividade->__set('data_inicio', $_POST['data_inicio']);
            $atividade->__set('data_fim', $_POST['data_fim']);

            if ($_POST['inscricao'] == 'gratis') {
                $atividade->__set('valor', 0);
            }

            if(preg_match("/,/", $atividade->__get('valor'))) {
                $atividade->__set('valor', str_replace(',', '.', $atividade->__get('valor')));
            }

            $conexao = new ConexaoModel();
            $atividadeService = new AtividadeService($atividade, $conexao);
            if ($atividadeService->inserir()) echo header('Location: ../usuario/seusEventos/gerenciamento/cadastrarAtividade/?id=' . $_GET['id'] . '&acao=sucesso');
            else echo header('Location: ../usuario/seusEventos/gerenciamento/cadastrarAtividade/?id=' . $_GET['id'] . '&acao=erro');

        }else if ($_GET['acao'] == 'recuperar') {
            $atividade = new Atividade();
            $conexao = new ConexaoModel();

            $atividadeService = new AtividadeService($atividade, $conexao);

            if ($atividadeService->recuperar()) echo 'sucesso';
            else echo 'error';
        
        }else if ($_GET['acao'] == 'atualizar') {
            $atividade = new Atividade();
            $atividade->__set('id_evento', $_GET['id']);
            $atividade->__set('nome', $_POST['nome']);
            $atividade->__set('qntd_part', $_POST['qntd_part']);
            $atividade->__set('inscricao', $_POST['inscricao']);
            $atividade->__set('valor', $_POST['valor']);
            $atividade->__set('tipo', $_POST['tipo']);
            $atividade->__set('carga_hr', $_POST['carga_hr']);
            $atividade->__set('data_inicio', $_POST['data_inicio']);
            $atividade->__set('data_fim', $_POST['data_fim']);

            // $atividade = new Atividade();
            // $atividade->__set('id_evento', 8);
            // $atividade->__set('nome', "mudado");
            // $atividade->__set('qntd_part', 10);
            // $atividade->__set('inscricao', "gratis");
            // $atividade->__set('valor', 0);
            // $atividade->__set('tipo', "um tipo");
            // $atividade->__set('carga_hr', 20);
            // $atividade->__set('data_inicio', "uma data att");
            // $atividade->__set('data_fim', "outra data att");

            $conexao = new ConexaoModel();

            $atividadeService = new AtividadeService($atividade, $conexao);
            
            if ($atividadeService->atualizar()) echo 'sucesso';
            else echo 'error';

        }else if ($_GET['acao'] == 'remover') {
            $atividade = new Atividade();
            $conexao = new ConexaoModel();

            $atividadeService = new AtividadeService($atividade, $conexao);

            // $atividadeService->remover();
            
            if ($atividadeService->remover()) header('Location: ../usuario/seusEventos/gerenciamento/atividadesCadastradas/?id=' . $_GET["id"] . '&acao=sucesso');
            else header('Location: ../usuario/seusEventos/gerenciamento/atividadesCadastradas/?id=' . $_GET['id'] . '&acao=error');
        }
    }
?>