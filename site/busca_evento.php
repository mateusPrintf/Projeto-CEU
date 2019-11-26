<?php
    
    $eventosProcurado = [];
    $dsn = 'mysql:host=127.0.0.1;dbname=ceu';
    $user = 'root';
    $senha = '';

    $dataInicio = new DateTime();
    $dataFim = new DateTime();

    try {
        $conexao = new PDO($dsn, $user, $senha);
        
        $query = 'select * from tb_evento';

        if(!empty($_POST['nome']) && isset($_POST['tipo']) && $_POST['tipo'] != 'todos') {
            $query .= ' where lower(nome) = lower(:nome) and area = :area';
            $stmt = $conexao->prepare($query);
            $stmt->bindValue(':nome', $_POST['nome']);
            $stmt->bindValue(':area', $_POST['tipo']);
        }
        
        if (!empty($_POST['nome'])) {
            echo 'aqui';
            $query .= ' where lower(nome) = lower(:nome)';
            $stmt = $conexao->prepare($query);
            $stmt->bindValue(':nome', $_POST['nome']);
        
        }else if (isset($_POST['tipo']) && $_POST['tipo'] != 'todos') {
            $query .= ' where area = :area';
            $stmt = $conexao->prepare($query);
            $stmt->bindValue(':area', $_POST['tipo']);
        
        }else {
            $stmt = $conexao->prepare($query);
        }

        $stmt->execute();
        $eventos = $stmt->fetchAll(PDO::FETCH_OBJ);

        if (isset($_POST['data'])) {
            foreach ($eventos as $evento) {
                list($diaIni, $mesIni, $anoIni) = explode('/',$evento->data_inicio);
                list($diaFim, $mesFim, $anoFim) = explode('/',$evento->data_fim);
                $dataInicio->setDate($anoIni, $mesIni, $diaIni);
                $dataFim->setDate($anoFim, $mesFim, $diaFim);

                if ($_POST['data'] == 'hoje') {
                    if (date('z') >= $dataInicio->format('z') && date('z') <= $dataFim->format('z')) {
                        array_push($eventosProcurado, $evento);
                    }

                }else if ($_POST['data'] == 'semana') {
                    if (date('W') >= $dataInicio->format('W') && date('W') <= $dataFim->format('W')) {
                        array_push($eventosProcurado, $evento);
                    }

                }else if ($_POST['data'] == 'mes') {
                    if (date('m') == $mesIni || date('m') == $mesFim) {
                        array_push($eventosProcurado, $evento);
                    }
                    
                }else {
                    array_push($eventosProcurado, $evento);
                }
            }
        }
        
    } catch (PDOException $e) {
        echo 'Erro: '.$e->getCode().' Mensagem: '.$e->getMessage();
        //podendo ser feito um registro de erros(logs) do sistema
    }
?>