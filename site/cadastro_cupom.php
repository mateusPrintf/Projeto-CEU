<?php

    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    include_once "./conexao.php";

    try {
        
        $conexao = new Conexao();

        $query = '
            insert into tb_cupom(
                id_atividade, codigo, valor, porcentagem, qntd, validade
                ) values (
                    :id_atividade,
                    :codigo, 
                    :valor,
                    :porcentagem,
                    :qntd,
                    :validade)
                ';

        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id_atividade', $_POST['id_att']);
        $stmt->bindValue(':codigo', $_POST['codigo']);
        $stmt->bindValue(':valor', $_POST['valor']);
        $stmt->bindValue(':porcentagem', $_POST['porcentagem']);
        $stmt->bindValue(':qntd', $_POST['qntd']);
        $stmt->bindValue(':validade', $_POST['validade']);
        
        if ($stmt->execute()) {
            header('Location: evento_atividade_cadastradas.php?id=' . $_GET['id'] . '?acao=sucesso');
        }else {
            header('Location: evento_atividade_cadastradas.php?id=' . $_GET['id'] . '?acao=naoDeuCerto');
        }

    } catch (PDOException $e) {
        echo 'Erro: '.$e->getCode().' Mensagem: '.$e->getMessage();
        //podendo ser feito um registro de erros(logs) do sistema
    }

?>