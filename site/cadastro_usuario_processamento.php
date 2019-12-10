<?php

    $dsn = 'mysql:host=127.0.0.1;dbname=ceu';
    $user = 'root';
    $senha = '';

    try {
        $conexao = new PDO($dsn, $user, $senha);

        $queryEmail = '
            select * from tb_usuario where email = :email
        ';

        $stmtEmail = $conexao->prepare($queryEmail);
        $stmtEmail->bindValue(':email', $_POST['email']);
        $resultado = $stmtEmail->execute();
        $userAchado = $stmtEmail->fetch(PDO::FETCH_OBJ);

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

        if ($_POST['senha1'] != $_POST['senha2']) {
            header('Location: cadastro_usuario.php?erro=senhaDesigual');

        }else if (!empty($userAchado)) {
            echo '<pre>';
            print_r($userAchado);
            echo '</pre>';
            header('Location: cadastro_usuario.php?erro=emailJaCadastrado');

        }else {
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
    
            header('Location: login.php');
        }

    } catch (PDOException $e) {
        echo 'Erro: '.$e->getCode().' Mensagem: '.$e->getMessage();
        //podendo ser feito um registro de erros(logs) do sistema
    }
?>