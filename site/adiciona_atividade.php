<?php

    include_once "./conexao.php";

    try {
        
        $conexao = new Conexao();

        $query = '
            insert into tb_atividade(
                id_evento, nome, qntd_part, inscricao, valor, tipo, carga_hr, data_inicio, data_fim
                ) values (
                    :id_evento,
                    :nome, 
                    :qntd_part,
                    :inscricao,
                    :valor,
                    :tipo,
                    :carga_hr,
                    :data_inicio,
                    :data_fim)
                ';

        if ($_POST['inscricao'] == 'gratis') {
            $_POST['valor'] = 0.00;
        }

        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id_evento', $_GET['id']);
        $stmt->bindValue(':nome', $_POST['nome']);
        $stmt->bindValue(':qntd_part', $_POST['qntd_part']);
        $stmt->bindValue(':inscricao', $_POST['inscricao']);
        $stmt->bindValue(':valor', $_POST['valor']);
        $stmt->bindValue(':tipo', $_POST['area']);
        $stmt->bindValue(':carga_hr', $_POST['carga_hr']);
        $stmt->bindValue(':data_inicio', $_POST['data_inicio']);
        $stmt->bindValue(':data_fim', $_POST['data_fim']);
        
        if ($stmt->execute()) {
            header('Location: evento_cadastro_atividade.php?id=' . $_GET['id'] . '?acao=sucesso');
        }else {
            header('Location: evento_cadastro_atividade.php?id=' . $_GET['id'] . '?acao=naoDeuCerto');
        }

    } catch (PDOException $e) {
        echo 'Erro: '.$e->getCode().' Mensagem: '.$e->getMessage();
        //podendo ser feito um registro de erros(logs) do sistema
    }

    function chockHorario($conexao, $qntdEvento) {
        $dataInicio = new DateTime();
        $dataFim = new DateTime();
        $dataEventoInicio = new DateTime();
        $dataEventoFim = new DateTime();

        list($diaIni, $mesIni, $anoIni) = explode('/',$qntdEvento->data_inicio);
        list($diaFim, $mesFim, $anoFim) = explode('/',$qntdEvento->data_fim);
        $dataEventoInicio->setDate($anoIni, $mesIni, $diaIni);
        $dataEventoFim->setDate($anoFim, $mesFim, $diaFim);

        echo $dataEventoInicio->format('z') . '/';
        echo $dataEventoFim->format('z') . '<br>';

        $query = '
            select data_inicio, data_fim from tb_evento left join tb_inscricoes on(tb_evento.id = tb_inscricoes.id_evento) where tb_inscricoes.id_usuario = :id
        ';

        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id', $_SESSION['id']);
        $stmt->execute();
        $eventos = $stmt->fetchAll(PDO::FETCH_OBJ);

        echo '<pre>';
        print_r($eventos);
        echo '</pre>';

        foreach ($eventos as $evento) {
            list($diaIni, $mesIni, $anoIni) = explode('/',$evento->data_inicio);
            list($diaFim, $mesFim, $anoFim) = explode('/',$evento->data_fim);
            $dataInicio->setDate($anoIni, $mesIni, $diaIni);
            $dataFim->setDate($anoFim, $mesFim, $diaFim);

            echo $dataInicio->format('z') . '/';
            echo $dataFim->format('z') . '<br>';

            if (($dataEventoInicio->format('z') >= $dataInicio->format('z') && $dataEventoInicio->format('z') <= $dataFim->format('z') || 
                ($dataEventoFim->format('z') >= $dataInicio->format('z') && $dataEventoFim->format('z') <= $dataFim->format('z')))) {
                    return false;
                }
        }
        return true;
    }
?>