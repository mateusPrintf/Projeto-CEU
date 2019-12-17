<?php

    include_once "./conexao.php";
    session_start();

    try {
        $conexao = new Conexao();

        $query = '
            insert into tb_evento(
                id_usuario, nome, email, descricao, tipo, area, preco_evento, qntd_part, data_inicio, data_fim, endereco, bairro, estado, cidade, cep
                ) values (
                    :id_usuario,
                    :nome,
                    :email,
                    :descricao,
                    :tipo,
                    :area,
                    :preco_evento,
                    :qntd_part,
                    :data_inicio,
                    :data_fim,
                    :endereco,
                    :bairro,
                    :estado,
                    :cidade,
                    :cep
                )';

        if ($_POST['tipo'] == 'gratis' || isset($_POST['tipo'])) {
            $_POST['valor'] = 0.00;
        }

        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id_usuario', $_SESSION['id']);
        $stmt->bindValue(':nome', $_POST['nome']);
        $stmt->bindValue(':email', $_POST['email']);
        $stmt->bindValue(':descricao', $_POST['descricao']);
        $stmt->bindValue(':tipo', $_POST['tipo']);
        $stmt->bindValue(':area', $_POST['area']);
        $stmt->bindValue(':preco_evento', $_POST['valor']);
        $stmt->bindValue(':qntd_part', $_POST['qntd_part']);
        $stmt->bindValue(':data_inicio', $_POST['data_inicio']);
        $stmt->bindValue(':data_fim', $_POST['data_fim']);
        $stmt->bindValue(':endereco', $_POST['endereco']);
        $stmt->bindValue(':bairro', $_POST['bairro']);
        $stmt->bindValue(':estado', $_POST['estado']);
        $stmt->bindValue(':cidade', $_POST['cidade']);
        $stmt->bindValue(':cep', $_POST['cep']);

        if ($stmt->execute()) {
            header('Location: gerenciamento_user_evento.php?acao=sucesso');
        }else {
            header('Location: gerenciamento_user_evento.php?acao=naoSucesso');
        }


    } catch (PDOException $e) {
        echo 'Erro: '.$e->getCode().' Mensagem: '.$e->getMessage();
        //podendo ser feito um registro de erros(logs) do sistema
    }
?>