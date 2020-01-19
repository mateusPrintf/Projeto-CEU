<?php

    /**
     * Classe responsavel por fazer as operacoes de CRUD de uma inscricao.
     */
    Class InscricaoService {
        private $conexao;
        private $inscricao;

        public function __construct(Inscricao $inscricao, ConexaoModel $conexao) {
            $this->conexao = $conexao->conectar();
            $this->inscricao = $inscricao;
        }

        /**
         * Funcao responsavel por inscrever um usuario em um evento no banco de dados.
         */
        public function inserir() {

            $queryQntPart = "select data_inicio, data_fim, num_usuario_cads, qntd_part from tb_evento where id = :id";
            $stmtQntPart = $this->conexao->prepare($queryQntPart);
            $stmtQntPart->bindValue(':id', $_GET['id_evento']);
            $stmtQntPart->execute();

            $qntdEvento = $stmtQntPart->fetch(PDO::FETCH_OBJ);

            echo '<pre>';
            print_r($qntdEvento);
            echo '</pre>';

            $queryInsc = "select * from tb_inscricao where id_evento = :id";
            $stmtInsc = $this->conexao->prepare($queryInsc);
            $stmtInsc->bindValue(':id', $_GET['evento']);
            $stmtInsc->execute();

            $users = $stmtInsc->fetchAll(PDO::FETCH_OBJ);

            echo '<pre>';
            print_r($users);
            echo '</pre>';

            if (chockHorario($this->conexao, $qntdEvento)) {
                if ($qntdEvento->num_usuario_cads <= $qntdEvento->qntd_part) {
                    foreach ($users as $usr) {
                        if ($usr->id_usuario == $_SESSION['id']) {
                            //header('Location: evento.php?acao=jaCadastrado');
                            $jaCadastrado = true;
                        }
                    }
            
                    if (!$jaCadastrado) {
                        $query = '
                            insert into tb_inscricao(
                                id_evento, id_usuario
                                ) values (
                                    :id_evento,
                                    :id_usuario
                                )
                        ';
                        $stmt = $this->conexao->prepare($query);
                        $stmt->bindValue(':id_evento', $this->inscricao->__get('id_evento'));
                        $stmt->bindValue(':id_usuario', $this->inscricao->__get('id_usuario'));
                        $stmt->execute();
                
                        $query3 = 'update tb_evento set num_usuario_cads = :num_usuario_cads where id = :id';
                        $stmt3 = $this->conexao->prepare($query3);
                        $stmt3->bindValue(':num_usuario_cads', $qntdEvento->num_usuario_cads + 1);
                        $stmt3->bindValue(':id', $_GET['id_evento']);
                        $stmt3->execute();
            
                        return 'sucesso';

                    }else {
                        return 'jaCadastrado';
                    }

                }else {
                    return 'numMaxAtingido';
                }
            }else {
                return 'chockHorario';
            }
        }

        public function inserirAdm() {

            $queryInsc = "select * from tb_inscricao where id_evento = :id";
            $stmtInsc = $this->conexao->prepare($queryInsc);
            $stmtInsc->bindValue(':id', $this->inscricao->__get('id_evento'));
            $stmtInsc->execute();

            $users = $stmtInsc->fetchAll(PDO::FETCH_OBJ);

            $queryNovoAdm = 'select id from tb_usuario where email = :email';
            $stmtNovoAdmm = $this->conexao->prepare($queryNovoAdm);
            $stmtNovoAdmm->bindValue(':email', $_POST['emailAdm']);
            $stmtNovoAdmm->execute();
            $idNovoAdm = $stmtNovoAdmm->fetch(PDO::FETCH_OBJ);
            
            if (empty($idNovoAdm)) return 'emailNaoEncontrado';
                
            $this->inscricao->__set('id_usuario', $idNovoAdm->id);

            foreach ($users as $usr) {
                if ($usr->id_usuario == $this->inscricao->__get('id_usuario')) {
                    $jaCadastrado = true;
                }
            }

            if (!$jaCadastrado) {
                $query = '
                    insert into tb_inscricao(
                        id_evento, id_usuario, papel
                        ) values (
                            :id_evento,
                            :id_usuario,
                            :papel
                        )
                ';
    
                $stmt = $this->conexao->prepare($query);
                $stmt->bindValue(':id_evento', $this->inscricao->__get('id_evento'));
                $stmt->bindValue(':id_usuario', $this->inscricao->__get('id_usuario'));
                $stmt->bindValue(':papel', $this->inscricao->__get('papel'));
                
                if ($stmt->execute()) return 'sucesso';
                else return 'error';
            
            }else return 'jaCadastrado';
        }

        /**
         * Funcao responsavel por recuparar todas inscricao de um usuario do banco de dados.
         */
        public function recuperarInscricaoUsuario() {
            $query = 'select * from tb_inscricao where id_usuario = :id_usuario';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id_usuario', $this->inscricao->__get('id_usuario'));

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        /**
         * Funcao responsavel por recuparar todas as inscricoes feitas em um evento do banco de dados.
         */
        public function recuperarInscricaoEvento() {
            $query = 'select * from tb_inscricao where id_evento = :id_evento';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id_evento', $this->inscricao->__get('id_evento'));

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        /**
         * Funcao reponsavel por recuperar todas as inscricoes.
         */
        public function recuperarTodos() {
            $query = 'select * from tb_inscricao';

            $stmt =  $this->conexao->prepare($query);
            
            $stmt->execute();
            
            return $inscricoes = $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        /**
         * Funcao responsavel por remover uma inscricao do banco de dados.
         */
        public function remover() {
            $query = '
                delete from tb_inscricao
                where id_usuario = :id_usuario AND id_evento = :id_evento';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id_usuario', $this->inscricao->__get('id_usuario'));
            $stmt->bindValue(':id_evento', $this->inscricao->__get('id_evento'));

            return $stmt->execute();
        }
    }

    function chockHorario($conexao, $qntdEvento) {
        $dataInicio = new DateTime();
        $dataFim = new DateTime();
        $dataEventoInicio = new DateTime();
        $dataEventoFim = new DateTime();

        list($diaIni, $mesIni, $anoIni) = explode('/',$qntdEvento->data_inicio);
        list($diaFim, $mesFim, $anoFim) = explode('/',$qntdEvento->data_fim);
        $dataEventoInicio->setDate($anoIni, $mesIni, $diaIni);
        $dataEventoFim->setDate($anoFim, $mesFim, $diaFim);

        // echo $dataEventoInicio->format('z') . '/';
        // echo $dataEventoFim->format('z') . '<br>';

        $query = '
            select data_inicio, data_fim from tb_evento left join tb_inscricao on(tb_evento.id = tb_inscricao.id_evento) where tb_inscricao.id_usuario = :id
        ';

        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id', $_SESSION['id']);
        $stmt->execute();
        $eventos = $stmt->fetchAll(PDO::FETCH_OBJ);

        // echo '<pre>';
        // print_r($eventos);
        // echo '</pre>';

        foreach ($eventos as $evento) {
            list($diaIni, $mesIni, $anoIni) = explode('/',$evento->data_inicio);
            list($diaFim, $mesFim, $anoFim) = explode('/',$evento->data_fim);
            $dataInicio->setDate($anoIni, $mesIni, $diaIni);
            $dataFim->setDate($anoFim, $mesFim, $diaFim);

            // echo $dataInicio->format('z') . '/';
            // echo $dataFim->format('z') . '<br>';

            if (($dataEventoInicio->format('z') >= $dataInicio->format('z') && $dataEventoInicio->format('z') <= $dataFim->format('z') || 
                ($dataEventoFim->format('z') >= $dataInicio->format('z') && $dataEventoFim->format('z') <= $dataFim->format('z')))) {
                    return false;
            }
        }
        return true;
    }

?>