<?php

    $dsn = 'mysql:host=127.0.0.1;dbname=ceu';
    $user = 'root';
    $senha = '1219';

    try {
        $conexao = new PDO($dsn, $user, $senha);

        $query = '
            insert into tb_usuario(
                nome, usuario, email, senha, estado, cidade, cep
                ) values (
                    :nome, 
                    :usuario, 
                    :email,
                    :senha,
                    :estado,
                    :cidade,
                    :cep)
        ';

        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':nome', $_POST['nome']);
        $stmt->bindValue(':usuario', $_POST['usuario']);
        $stmt->bindValue(':email', $_POST['email']);
        $stmt->bindValue(':senha', $_POST['senha1']);
        $stmt->bindValue(':estado', $_POST['estado']);
        $stmt->bindValue(':cidade', $_POST['cidade']);
        $stmt->bindValue(':cep', $_POST['cep']);

        $stmt->execute();

        $usuario = $stmt->fetch();
        echo '<hr>';

        header('Location: login.php');

    } catch (PDOException $e) {
        echo 'Erro: '.$e->getCode().' Mensagem: '.$e->getMessage();
        //podendo ser feito um registro de erros(logs) do sistema
    }

?>