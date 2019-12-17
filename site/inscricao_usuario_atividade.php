<? require_once "validador_acesso.php"; ?>

<?php

    include_once "./conexao.php";
    session_start();
    $jaCadastrado = false;

    try {

        $conexao = new Conexao();

        $queryQntdPart = 'select data_inicio, data_fim, id_evento from tb_atividade where id = :id';

        $stmtQntdPart = $conexao->prepare($queryQntdPart);
        $stmtQntdPart->bindValue(':id', $_GET['id']);
        $stmtQntdPart->execute();

        $dataAtt = $stmtQntdPart->fetch(PDO::FETCH_OBJ);

        $queryInsc = "select * from tb_inscricoes_atividade where id_atividade = :id";
        $stmtInsc = $conexao->prepare($queryInsc);
        $stmtInsc->bindValue(':id', $_GET['id']);
        $stmtInsc->execute();

        $insc = $stmtInsc->fetchAll(PDO::FETCH_OBJ);

        echo '<pre>';
        print_r($dataAtt);
        echo '</pre>';

        foreach ($insc as $inscricao) {
            if ($inscricao->id_usuario == $_SESSION['id']) {
                //header('Location: evento.php?acao=jaCadastrado');
                $jaCadastrado = true;
            }
        }

        //chockHorario($conexao, $dataAtt);

        if (chockHorario($conexao, $dataAtt)) {
            if (!$jaCadastrado) {
                $query1 = '
                    insert into tb_inscricoes_atividade(id_atividade, id_evento, id_usuario)
                    values(:id_atividade, :id_evento, :id_usuario)';

                $stmt1 = $conexao->prepare($query1);
                $stmt1->bindValue(':id_atividade', $_GET['id']);
                $stmt1->bindValue(':id_evento', $dataAtt->id_evento);
                $stmt1->bindValue(':id_usuario', $_SESSION['id']);
                echo $stmt1->execute();
                
                /*
                $query3 = 'update tb_evento set num_usuario_cads = :num_usuario_cads where id = :id';
                $stmt3 = $conexao->prepare($query3);
                $stmt3->bindValue(':num_usuario_cads', $qntdEvento->num_usuario_cads + 1);
                $stmt3->bindValue(':id', $_GET['evento']);
                echo $stmt3->execute();*/

                header('Location: info_atividade.php?id='. $dataAtt->id_evento . '&acao=inscricaoFeita');

            }else {
                header('Location: info_atividade.php?id='. $dataAtt->id_evento . '&acao=jaCadastrado');
            }

        } else {
            header('Location: info_atividade.php?id='. $dataAtt->id_evento . '&acao=chockHorario');
        }

    } catch (PDOException $e) {
        echo $e->getMessage;
    }

    function chockHorario($conexao, $dataAtt) {
        $dataInicio = new DateTime();
        $dataFim = new DateTime();
        $dataEventoInicio = new DateTime();
        $dataEventoFim = new DateTime();

        list($diaIni, $mesIni, $anoIni) = explode('/',$dataAtt->data_inicio);
        list($diaFim, $mesFim, $anoFim) = explode('/',$dataAtt->data_fim);
        $dataEventoInicio->setDate($anoIni, $mesIni, $diaIni);
        $dataEventoFim->setDate($anoFim, $mesFim, $diaFim);

        echo $dataEventoInicio->format('z') . '/';
        echo $dataEventoFim->format('z') . '<br>';

        $query = '
            select data_inicio, data_fim from tb_atividade left join tb_inscricoes_atividade on (tb_atividade.id = tb_inscricoes_atividade.id_atividade) where tb_inscricoes_atividade.id_usuario = :id
        ';

        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id', $_SESSION['id']);
        $stmt->execute();
        $eventos = $stmt->fetchAll(PDO::FETCH_OBJ);

        echo '<pre>';
        print_r($eventos);
        echo '</pre>';

        if (!empty($eventos)) {
            foreach ($eventos as $att) {
                list($diaIni, $mesIni, $anoIni) = explode('/',$att->data_inicio);
                list($diaFim, $mesFim, $anoFim) = explode('/',$att->data_fim);
                $dataInicio->setDate($anoIni, $mesIni, $diaIni);
                $dataFim->setDate($anoFim, $mesFim, $diaFim);

                echo $dataInicio->format('z') . '/';
                echo $dataFim->format('z') . '<br>';

                if (($dataEventoInicio->format('z') >= $dataInicio->format('z') && $dataEventoInicio->format('z') <= $dataFim->format('z') || 
                    ($dataEventoFim->format('z') >= $dataInicio->format('z') && $dataEventoFim->format('z') <= $dataFim->format('z')))) {
                        echo 'false';
                        return false;
                    }
            }
        }
        echo 'true';
        return true;
    }
?>