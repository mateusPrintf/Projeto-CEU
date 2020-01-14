<?php

    /**
     * Classe responsavel por fazer as operacoes de CRUD de uma inscricao.
     */
    Class InscricaoAtividadeService {
        private $conexao;
        private $inscricaoAtividade;

        public function __construct(InscricaoAtividade $inscricaoAtividade, ConexaoModel $conexao) {
            $this->conexao = $conexao->conectar();
            $this->inscricaoAtividade = $inscricaoAtividade;
        }

        /**
         * Funcao responsavel por inscrever um usuario em uma atividade no banco de dados.
         */
        public function inserir() {

            $queryQntdPart = 'select data_inicio, data_fim, id_evento from tb_atividade where id = :id';//mudar

            $stmtQntdPart = $this->conexao->prepare($queryQntdPart);
            $stmtQntdPart->bindValue(':id', $this->inscricaoAtividade->__get('id_atividade'));
            $stmtQntdPart->execute();

            $dataAtt = $stmtQntdPart->fetch(PDO::FETCH_OBJ);

            $queryInsc = "select * from tb_inscricao_atividade where id_atividade = :id";//mudar
            $stmtInsc = $this->conexao->prepare($queryInsc);
            $stmtInsc->bindValue(':id', $this->inscricaoAtividade->__get('id_atividade'));
            $stmtInsc->execute();

            $insc = $stmtInsc->fetchAll(PDO::FETCH_OBJ);

            // echo '<pre>';
            // print_r($dataAtt);
            // echo '</pre>';

            foreach ($insc as $inscricao) {
                if ($inscricao->id_usuario == $_SESSION['id']) {
                    //header('Location: evento.php?acao=jaCadastrado');
                    $jaCadastrado = true;
                }
            }

            if (chockHorario($this->conexao, $dataAtt)) {
                if (!$jaCadastrado) {
                    $query = '
                        insert into tb_inscricao_atividade(
                            id_atividade, id_evento, id_usuario
                            ) values (
                                :id_atividade,
                                :id_evento,
                                :id_usuario
                            )
                        
                        ';
                    
                    $stmt = $this->conexao->prepare($query);
                    $stmt->bindValue(':id_atividade', $this->inscricaoAtividade->__get('id_atividade'));
                    $stmt->bindValue(':id_evento', $this->inscricaoAtividade->__get('id_evento'));
                    $stmt->bindValue(':id_usuario', $this->inscricaoAtividade->__get('id_usuario'));

                    if ($stmt->execute()) return 'sucesso';
                    else return 'error';
                    
                    /*
                    $query3 = 'update tb_evento set num_usuario_cads = :num_usuario_cads where id = :id';
                    $stmt3 = $conexao->prepare($query3);
                    $stmt3->bindValue(':num_usuario_cads', $qntdEvento->num_usuario_cads + 1);
                    $stmt3->bindValue(':id', $_GET['evento']);
                    echo $stmt3->execute();*/
    
                    // header('Location: info_atividade.php?id='. $dataAtt->id_evento . '&acao=inscricaoFeita');
    
                }else {
                    // header('Location: info_atividade.php?id='. $dataAtt->id_evento . '&acao=jaCadastrado');
                    return 'jaCadastrado';
                }
    
            } else {
                // header('Location: info_atividade.php?id='. $dataAtt->id_evento . '&acao=chockHorario');
                return 'chockHorario';
            }
        }

        /**
         * Funcao responsavel por recuparar todas inscricao de um usuario de uma atividade do banco de dados.
         */
        public function recuperarInscricaoUsuario() {
            $query = 'select * from tb_inscricao_atividade where id_usuario = :id_usuario';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id_usuario', $this->inscricaoAtividade->__get('id_usuario'));

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        /**
         * Funcao responsavel por recuparar todas as inscricoes feitas em uma atividade do banco de dados.
         */
        public function recuperarInscricaoEvento() {
            $query = 'select * from tb_inscricao_atividade where id_evento = :id_evento';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id_evento', $this->inscricaoAtividade->__get('id_evento'));

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        /**
         * Funcao responsavel por recuparar todas as inscricoes feitas em um evento do banco de dados.
         */
        public function recuperarInscricaoAtividade() {
            $query = 'select * from tb_inscricao_atividade where id_atividade = :id_atividade';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id_atividade', $this->inscricaoAtividade->__get('id_atividade'));

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        /**
         * Funcao reponsavel por recuperar todas as inscricoes.
         */
        public function recuperarTodos() {
            $query = 'select * from tb_inscricao_atividade';

            $stmt =  $this->conexao->prepare($query);
            
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        /**
         * Funcao responsavel por remover uma inscricao do banco de dados.
         */
        public function remover() {
            $query = '
                delete from tb_inscricao_atividade
                where id_usuario = :id_usuario AND 
                      id_evento = :id_evento AND
                      id_atividade = :id_atividade';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id_usuario', $this->inscricaoAtividade->__get('id_usuario'));
            $stmt->bindValue(':id_evento', $this->inscricaoAtividade->__get('id_evento'));
            $stmt->bindValue(':id_atividade', $this->inscricaoAtividade->__get('id_atividade'));

            return $stmt->execute();
        }
    }

    /**
     * Funcao responsavel por verificar o choque de horario de uma inscricao de uma atividadade
     */
    function chockHorario($conexao, $dataAtt) {
        $dataInicio = new DateTime();
        $dataFim = new DateTime();
        $dataEventoInicio = new DateTime();
        $dataEventoFim = new DateTime();

        list($diaIni, $mesIni, $anoIni) = explode('/',$dataAtt->data_inicio);
        list($diaFim, $mesFim, $anoFim) = explode('/',$dataAtt->data_fim);
        $dataEventoInicio->setDate($anoIni, $mesIni, $diaIni);
        $dataEventoFim->setDate($anoFim, $mesFim, $diaFim);

        // echo $dataEventoInicio->format('z') . '/';
        // echo $dataEventoFim->format('z') . '<br>';

        $query = '
            select data_inicio, data_fim from tb_atividade left join tb_inscricoes_atividade on (tb_atividade.id = tb_inscricoes_atividade.id_atividade) where tb_inscricoes_atividade.id_usuario = :id
        ';

        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id', $_SESSION['id']);
        $stmt->execute();
        $eventos = $stmt->fetchAll(PDO::FETCH_OBJ);

        // echo '<pre>';
        // print_r($eventos);
        // echo '</pre>';

        if (!empty($eventos)) {
            foreach ($eventos as $att) {
                list($diaIni, $mesIni, $anoIni) = explode('/',$att->data_inicio);
                list($diaFim, $mesFim, $anoFim) = explode('/',$att->data_fim);
                $dataInicio->setDate($anoIni, $mesIni, $diaIni);
                $dataFim->setDate($anoFim, $mesFim, $diaFim);

                // echo $dataInicio->format('z') . '/';
                // echo $dataFim->format('z') . '<br>';

                if (($dataEventoInicio->format('z') >= $dataInicio->format('z') && $dataEventoInicio->format('z') <= $dataFim->format('z') || 
                    ($dataEventoFim->format('z') >= $dataInicio->format('z') && $dataEventoFim->format('z') <= $dataFim->format('z')))) {
                        echo 'false';
                        return false;
                    }
            }
        }
        echo 'true';
        return true;
    }

?>