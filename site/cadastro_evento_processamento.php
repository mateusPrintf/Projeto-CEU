<?php

    $dsn = 'mysql:host=127.0.0.1;dbname=ceu';
    $user = 'root';
    $senha = '1219';

    try {
        $conexao = new PDO($dsn, $user, $senha);

        $query = '
            insert into tb_evento(
                nome, email, qntd_part, estado, cidade, cep
                ) values (
                    :nome, 
                    :email,
                    :qntd_part,
                    :estado,
                    :cidade,
                    :cep)
        ';

        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':nome', $_POST['nome']);
        $stmt->bindValue(':email', $_POST['email']);
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