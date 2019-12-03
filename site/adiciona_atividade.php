<?php

    $dsn = 'mysql:host=127.0.0.1;dbname=ceu';
    $user = 'root';
    $senha = '1219';

    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    try {
        $conexao = new PDO($dsn, $user, $senha);

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
            header('Location: evento_cadastro_atividade.php' . $_GET['id'] . '?acao=naoDeuCerto');
        }

    } catch (PDOException $e) {
        echo 'Erro: '.$e->getCode().' Mensagem: '.$e->getMessage();
        //podendo ser feito um registro de erros(logs) do sistema
    }
?>