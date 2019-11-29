<?php

    session_start();

    $jaCadastrado = false;
    $dsn = 'mysql:host=127.0.0.1;dbname=ceu';
    $user = 'root';
    $senha = '';

    try {

        $conexao = new PDO($dsn, $user, $senha);

        $queryQntPart = "select num_usuario_cads, qntd_part from tb_evento where id = :id";
        $stmtQntPart = $conexao->prepare($queryQntPart);
        $stmtQntPart->bindValue(':id', $_GET['evento']);
        $stmtQntPart->execute();

        $qntdEvento = $stmtQntPart->fetch(PDO::FETCH_OBJ);

        $queryInsc = "select * from tb_inscricoes where id_evento = :id";
        $stmtInsc = $conexao->prepare($queryInsc);
        $stmtInsc->bindValue(':id', $_GET['evento']);
        $stmtInsc->execute();

        $users = $stmtInsc->fetchAll(PDO::FETCH_OBJ);

        echo '<pre>';
        print_r($users);
        echo '</pre>';

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
    
                header('Location: evento.php?acao=inscricaoFeita');

            }else {
                header('Location: evento.php?acao=jaCadastrado');
            }

        }else {
            header('Location: evento.php?acao=numMaxAtingido');
        }
        

    } catch (PDOException $e) {
        echo $e->getMessage;
    }
?>