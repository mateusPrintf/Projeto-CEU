<?php

    session_start();

    $jaCadastrado = false;
    $dsn = 'mysql:host=127.0.0.1;dbname=ceu';
    $user = 'root';
    $senha = '';

    try {

        $conexao = new PDO($dsn, $user, $senha);

        $query = "select usuario_cads, num_usuario_cads, qntd_part from tb_evento where id = :id";
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id', $_GET['evento']);
        $stmt->execute();

        $users = $stmt->fetch(PDO::FETCH_OBJ);
        $listaUsers = explode("#", $users->usuario_cads);

        if ($users->num_usuario_cads <= $users->qntd_part) {
            foreach ($listaUsers as $id) {
                if ($id == $_SESSION['id']) {
                    //header('Location: evento.php?acao=jaCadastrado');
                    $jaCadastrado = true;
                }
            }
    
            if (!$jaCadastrado) {
                $query1 = "update tb_evento set usuario_cads = :id_user where id = :id";
                $stmt1 = $conexao->prepare($query1);
                $stmt1->bindValue(':id_user', $users->usuario_cads . $_SESSION['id'] . '#');
                $stmt1->bindValue(':id', $_GET['evento']);
                $stmt1->execute();
        
                $query2 = "select num_usuario_cads from tb_evento where id = :id";
                $stmt2 = $conexao->prepare($query2);
                $stmt2->bindValue(':id', $_GET['evento']);
                $stmt2->execute();
        
                $numUser = $stmt2->fetch(PDO::FETCH_OBJ);
        
                $query3 = "update tb_evento set num_usuario_cads = :num_usuario_cads where id = :id";
                $stmt3 = $conexao->prepare($query3);
                $stmt3->bindValue(':num_usuario_cads', $numUser->num_usuario_cads + 1);
                $stmt3->bindValue(':id', $_GET['evento']);
                $stmt3->execute();
    
                header('Location: evento.php?acao=inscricaoFeita');
            }

        }else {
            header('Location: evento.php?acao=numMaxAtingido');
        }
        

    } catch (PDOException $e) {
        echo $e->getMessage;
    }
?>