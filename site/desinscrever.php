<? require_once "validador_acesso.php"; ?>

<?php

    $dsn = 'mysql:host=127.0.0.1;dbname=ceu';
    $user = 'root';
    $senha = '';

    try {
        $conexao = new PDO($dsn, $user, $senha);
        
        $query = "delete from tb_inscricoes_atividade where id_atividade = :id";

        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id', $_GET['id_att']);
        
        if ($stmt->execute()) {
            header('Location: info_evento_att_inscritas.php?id=' . $_GET['id']) . '&acao=sucesso';
        }else {
            header('Location: info_evento_att_inscritas.php?id=' . $_GET['id']) . '&acao=error';
        }
        
    } catch (PDOException $e) {
        echo 'Mensagem: '.$e->getMessage();
        //podendo ser feito um registro de erros(logs) do sistema
    }

?>