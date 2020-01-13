<?php

    require_once "../models/ConexaoModel.php";
    require_once "../models/CupomModel.php";
    require_once "../service/CupomService.php";

    //RECEBE AS INFORMAÇÕES DO POST OU GET E ADICIONA/REMOVE/ATUALIZA/RECUPERA AO MODELO ATIVIDADE
    
    if (isset($_GET['acao'])) {

        if ($_GET['acao'] == "inserir") {
            $cupom = new Cupom();
            $cupom->__set('id_atividade', $_POST['id_att']);
            $cupom->__set('codigo', $_POST['codigo']);
            $cupom->__set('valor', $_POST['valor']);
            $cupom->__set('porcentagem', $_POST['porcentagem']);
            $cupom->__set('qntd', $_POST['qntd']);
            $cupom->__set('validade', $_POST['validade']);

            if (empty($_POST['valor'])) $cupom->__set('valor', 0);
            else if (empty($_POST['porcentagem'])) $cupom->__set('porcentagem', 0);
            
            $conexao = new ConexaoModel();
            $cupomService = new CupomService($cupom, $conexao);

            if ($cupomService->inserir()) header('Location: ../usuario/seusEventos/gerenciamento/atividadesCadastradas/?id=' . $_GET['id'] . '&acao=sucesso');
            else header('Location: ../usuario/seusEventos/gerenciamento/atividadesCadastradas/?id=' . $_GET['id'] . '&acao=error');
            
        }else if ($_GET['acao'] == 'recuperar') {
            $cupom = new Cupom();
            $conexao = new ConexaoModel();

            $cupomService = new CupomService($cupom, $conexao);

            if ($cupomService->recuperar()) echo 'sucesso';
            else echo 'error';

            // echo '<pre>';
            // print_r($cupom);
            // echo '</pre>';

        }else if ($_GET['acao'] == 'recuperarTodos') {
            $cupom = new Cupom();
            $conexao = new ConexaoModel();

            $cupomService = new CupomService($cupom, $conexao);

            echo '<pre>';
            print_r($cupomService->recuperarTodos());
            echo '</pre>';

        }else if ($_GET['acao'] == 'atualizar') {
            $cupom = new Cupom();
            $cupom->__set('codigo', $_POST['codigo']);
            $cupom->__set('valor', $_POST['valor']);
            $cupom->__set('porcentagem', $_POST['porcentagem']);
            $cupom->__set('qntd', $_POST['qntd']);
            $cupom->__set('validade', $_POST['validade']);

            // $cupom->__set('codigo', "LANCAABRABA");
            // $cupom->__set('valor', 2.00);
            // $cupom->__set('porcentagem', 0);
            // $cupom->__set('qntd', 10);
            // $cupom->__set('validade', "UMA DATA AÍ");
            
            $conexao = new ConexaoModel();

            $cupomService = new CupomService($cupom, $conexao);

            if ($cupomService->atualizar()) echo 'sucesso';
            echo 'error';

        }else if ($_GET['acao'] == 'remover') {
            $cupom = new Cupom();
            $conexao = new ConexaoModel();

            $cupomService = new CupomService($cupom, $conexao);

            if ($cupomService->remover()) echo 'sucesso';
            else echo 'error';
        }
    }
?>