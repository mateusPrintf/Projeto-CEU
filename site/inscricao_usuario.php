<?php

    include_once "../service/conexao.php";

    session_start();
    $jaCadastrado = false;

    try {

        $conexao = new Conexao();

        $queryQntPart = "select data_inicio, data_fim, num_usuario_cads, qntd_part from tb_evento where id = :id";
        $stmtQntPart = $conexao->prepare($queryQntPart);
        $stmtQntPart->bindValue(':id', $_GET['evento']);
        $stmtQntPart->execute();

        $qntdEvento = $stmtQntPart->fetch(PDO::FETCH_OBJ);

        $queryInsc = "select * from tb_inscricoes where id_evento = :id";
        $stmtInsc = $conexao->prepare($queryInsc);
        $stmtInsc->bindValue(':id', $_GET['evento']);
        $stmtInsc->execute();

        $users = $stmtInsc->fetchAll(PDO::FETCH_OBJ);

        if (chockHorario($conexao, $qntdEvento)) {
            if ($qntdEvento->num_usuario_cads <= $qntdEvento->qntd_part) {
                foreach ($users as $usr) {
                    if ($usr->id_usuario == $_SESSION['id']) {
                        //header('Location: evento.php?acao=jaCadastrado');
                        $jaCadastrado = true;
                    }
                }
        
                if (!$jaCadastrado) {
                    $query1 = '
                        insert into tb_inscricoes(
                            id_evento, id_usuario
                            ) values (
                                :id_evento, :id_usuario
                            )';

                    $stmt1 = $conexao->prepare($query1);
                    $stmt1->bindValue(':id_evento', $_GET['evento']);
                    $stmt1->bindValue(':id_usuario', $_SESSION['id']);
                    echo $stmt1->execute();
            
                    $query3 = 'update tb_evento set num_usuario_cads = :num_usuario_cads where id = :id';
                    $stmt3 = $conexao->prepare($query3);
                    $stmt3->bindValue(':num_usuario_cads', $qntdEvento->num_usuario_cads + 1);
                    $stmt3->bindValue(':id', $_GET['evento']);
                    echo $stmt3->execute();
        
                    header('Location: ./evento/?acao=inscricaoFeita');

                }else {
                    header('Location: ./evento/?acao=jaCadastrado');
                }

            }else {
                header('Location: ./evento/?acao=numMaxAtingido');
            }
        }else {
            header('Location: ./evento/?acao=chockHorario');
        }

    } catch (PDOException $e) {
        echo $e->getMessage;
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

        // echo $dataEventoInicio->format('z') . '/';
        // echo $dataEventoFim->format('z') . '<br>';

        $query = '
            select data_inicio, data_fim from tb_evento left join tb_inscricoes on(tb_evento.id = tb_inscricoes.id_evento) where tb_inscricoes.id_usuario = :id
        ';

        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id', $_SESSION['id']);
        $stmt->execute();
        $eventos = $stmt->fetchAll(PDO::FETCH_OBJ);

        // echo '<pre>';
        // print_r($eventos);
        // echo '</pre>';

        foreach ($eventos as $evento) {
            list($diaIni, $mesIni, $anoIni) = explode('/',$evento->data_inicio);
            list($diaFim, $mesFim, $anoFim) = explode('/',$evento->data_fim);
            $dataInicio->setDate($anoIni, $mesIni, $diaIni);
            $dataFim->setDate($anoFim, $mesFim, $diaFim);

            // echo $dataInicio->format('z') . '/';
            // echo $dataFim->format('z') . '<br>';

            if (($dataEventoInicio->format('z') >= $dataInicio->format('z') && $dataEventoInicio->format('z') <= $dataFim->format('z') || 
                ($dataEventoFim->format('z') >= $dataInicio->format('z') && $dataEventoFim->format('z') <= $dataFim->format('z')))) {
                    return false;
                }
        }
        return true;
    }
?>