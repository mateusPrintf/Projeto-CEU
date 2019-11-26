<?php

    session_start();

    $dsn = 'mysql:host=127.0.0.1;dbname=ceu';
    $user = 'root';
    $senha = '';

    try {
        $conexao = new PDO($dsn, $user, $senha);

        $query = '
            insert into tb_evento(
                id_usuario, nome, email, descricao, area, preco_evento, data_inicio, data_fim, qntd_part, estado, cidade, cep
                ) values (
                    :id_usuario,
                    :nome, 
                    :email,
                    :descricao,
                    :area,
                    :preco_evento,
                    :data_inicio,
                    :data_fim,
                    :qntd_part,
                    :estado,
                    :cidade,
                    :cep)
        ';

        if ($_POST['tipo'] == 'gratis') {
            $_POST['valor'] = 0.00;
        }

        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id_usuario', $_SESSION['id']);
        $stmt->bindValue(':nome', $_POST['nome']);
        $stmt->bindValue(':email', $_POST['email']);
        $stmt->bindValue(':descricao', $_POST['descricao']);
        $stmt->bindValue(':area', $_POST['area']);
        $stmt->bindValue(':preco_evento', $_POST['valor']);
        $stmt->bindValue(':data_inicio', $_POST['data_inicio']);
        $stmt->bindValue(':data_fim', $_POST['data_fim']);
        $stmt->bindValue(':qntd_part', $_POST['qntd_part']);
        $stmt->bindValue(':estado', $_POST['estado']);
        $stmt->bindValue(':cidade', $_POST['cidade']);
        $stmt->bindValue(':cep', $_POST['cep']);

        $stmt->execute();

        $usuario = $stmt->fetch();
        echo '<hr>';

        header('Location: gerenciamento_user_evento.php');

    } catch (PDOException $e) {
        echo 'Erro: '.$e->getCode().' Mensagem: '.$e->getMessage();
        //podendo ser feito um registro de erros(logs) do sistema
    }
?>