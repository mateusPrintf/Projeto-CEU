<?php

    session_start();

    $user_autenticado = false;
    $user_id = null;
    $user_perfil_id = null;

    $dsn = 'mysql:host=127.0.0.1;dbname=ceu';
    $user = 'root';
    $senha = '1219';

    try {
        $conexao = new PDO($dsn, $user, $senha);
        
        $query = "select * from tb_usuario where ";
        $query .= " email = :email";
        $query .= " AND senha = :senha";

        print_r($_POST);

        echo $query;

        $stmt = $conexao->prepare($query);

        $stmt->bindValue(':email', $_POST['email']);
        $stmt->bindValue(':senha', $_POST['senha']);

        $stmt->execute();

        $usuario = $stmt->fetch(); //PDO::FETCH_BOTH, _ASSOC, _NUM, _OBJ

        if ($usuario['email'] == $_POST['email'] && $usuario['senha'] == $_POST['senha']) {
            $user_autenticado = true;
            $user_id = $user['id'];
            $user_perfil_id = $user['perfil_id'];
        }
        
        if ($user_autenticado) {
            $_SESSION['autenticado'] = 'sim';
            $_SESSION['id'] = $usuario['id'];
            header('Location: gerenciamento_user_inicio.php');
        }else {
            $_SESSION['autenticado'] = 'nao';
            header('Location: login.php?login=erro');
        }
        

    } catch (PDOException $e) {
        echo 'Erro: '.$e->getCode().' Mensagem: '.$e->getMessage();
        //podendo ser feito um registro de erros(logs) do sistema
    }
?>