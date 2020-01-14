<?php

    /**
     * Classe responsavel por fazer as operacoes de CRUD de uma atividade.
     */
    Class AtividadeService {
        private $conexao;
        private $atividade;

        public function __construct(Atividade $atividade, ConexaoModel $conexao) {
            $this->conexao = $conexao->conectar();
            $this->atividade = $atividade;
        }

        /**
         * Funcao responsavel por inserir uma atividade em um evento no banco de dados.
         */
        public function inserir() {
            $query = '
                insert into tb_atividade(
                    id_evento, nome, qntd_part, inscricao, valor, tipo, carga_hr, data_inicio, data_fim
                    ) values ( 
                        :id_evento, 
                        :nome, 
                        :qntd_part, 
                        :inscricao, 
                        :valor, 
                        :tipo, 
                        :carga_hr, 
                        :data_inicio, 
                        :data_fim
                    )';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id_evento', $this->atividade->__get('id_evento'));
            $stmt->bindValue(':nome', $this->atividade->__get('nome'));
            $stmt->bindValue(':qntd_part', $this->atividade->__get('qntd_part'));
            $stmt->bindValue(':inscricao', $this->atividade->__get('inscricao'));
            $stmt->bindValue(':valor', $this->atividade->__get('valor'));
            $stmt->bindValue(':tipo', $this->atividade->__get('tipo'));
            $stmt->bindValue(':carga_hr', $this->atividade->__get('carga_hr'));
            $stmt->bindValue(':data_inicio', $this->atividade->__get('data_inicio'));
            $stmt->bindValue(':data_fim', $this->atividade->__get('data_fim'));

            return $stmt->execute();
        }

        /**
         * Funcao responsavel por recuparar uma atividade se um banco de dados.
         */
        public function recuperar() {
            $query = "select * from tb_atividade where id = :id";

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id', $_GET['id_att']);
            // $stmt->bindValue(':id', 8);
            $stmt->execute();

            $atividadeAchada = $stmt->fetch(PDO::FETCH_OBJ);

            if (empty($atividadeAchada)) return false;
            else {
                $this->atividade->__set('id_evento', $atividadeAchada->id_evento);
                $this->atividade->__set('nome', $atividadeAchada->nome);
                $this->atividade->__set('qntd_part', $atividadeAchada->qntd_part);
                $this->atividade->__set('inscricao', $atividadeAchada->inscricao);
                $this->atividade->__set('valor', $atividadeAchada->valor);
                $this->atividade->__set('tipo', $atividadeAchada->tipo);
                $this->atividade->__set('carga_hr', $atividadeAchada->carga_hr);
                $this->atividade->__set('data_inicio', $atividadeAchada->data_inicio);
                $this->atividade->__set('data_fim', $atividadeAchada->data_fim);

                return true;
            }
        }

        /**
         * Funcao reponsavel por recuperar todas as atividades, dado um id de um evento.
         */
        public function recuperarTodos() {
            $query = "select * from tb_atividade where id_evento = :id";

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id', $_GET['id']);
            // $stmt->bindValue(':id', 8);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        /**
         * Funcao reponsavel por atualizar uma atividade no banco de dados.
         */
        public function atualizar() {
            $query = '
                UPDATE tb_atividade 
                    set 
                        nome = :nome,
                        qntd_part = :qntd_part,
                        inscricao = :inscricao,
                        valor = :valor,
                        tipo = :tipo,
                        carga_hr = :carga_hr,
                        data_inicio = :data_inicio,
                        data_fim = :data_fim
                    WHERE
                        id = :id
            ';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id', $_GET['id_att']);
            $stmt->bindValue(':nome', $this->atividade->__get('nome'));
            $stmt->bindValue(':qntd_part', $this->atividade->__get('qntd_part'));
            $stmt->bindValue(':inscricao', $this->atividade->__get('inscricao'));
            $stmt->bindValue(':valor', $this->atividade->__get('valor'));
            $stmt->bindValue(':tipo', $this->atividade->__get('tipo'));
            $stmt->bindValue(':carga_hr', $this->atividade->__get('carga_hr'));
            $stmt->bindValue(':data_inicio', $this->atividade->__get('data_inicio'));
            $stmt->bindValue(':data_fim', $this->atividade->__get('data_fim'));

            return $stmt->execute();
        }

        /**
         * Funcao responsavel por remover uma atividade no banco de dados.
         */
        public function remover() {
            
            $queryVerificaInscricao = '
            select * from tb_inscricao_atividade where id_atividade = :id_atividade    
            ';
            
            $stmtInscAtt = $this->conexao->prepare($queryVerificaInscricao);
            $stmtInscAtt->bindValue(':id_atividade', $_GET['id_att']);
            $stmtInscAtt->execute();
            
            $inscAtt = $stmtInscAtt->fetchAll(PDO::FETCH_OBJ);
            
            // echo '<pre>';
            // print_r($inscAtt);
            // echo '</pre>';
            
            if (!empty($inscAtt)) {
                foreach ($inscAtt as $inscAttInd) {
                    $queryDeleteInscAtt = 'delete from tb_inscricao_atividade where 
                    id_atividade = :id_atividadeDel and 
                    id_evento = :id_eventoDel and 
                    id_usuario = :id_usuarioDel';
                    
                    $stmtInscAttDel = $this->conexao->prepare($queryDeleteInscAtt);
                    $stmtInscAttDel->bindValue(':id_atividadeDel', $inscAttInd->id_atividade);
                    $stmtInscAttDel->bindValue(':id_eventoDel', $inscAttInd->id_evento);
                    $stmtInscAttDel->bindValue(':id_usuarioDel', $inscAttInd->id_usuario);
                    $stmtInscAttDel->execute();
                }
            }

            $queryInscCupomAtt = '
                select * from tb_cupom where id_atividade = :id_atividadeCupDel
            ';

            $stmtInscCupomAtt = $this->conexao->prepare($queryInscCupomAtt);
            $stmtInscCupomAtt->bindValue(':id_atividadeCupDel', $_GET['id_att']);
            $stmtInscCupomAtt->execute();

            $cupomAtt = $stmtInscCupomAtt->fetchAll(PDO::FETCH_OBJ);

            // echo '<pre>';
            // print_r($cupomAtt);
            // echo '</pre>';

            if (!empty($cupomAtt)) {
                foreach ($cupomAtt as $cupomAttInd) {
                    $queryDeleteCupomAtt = '
                        delete from tb_cupom where id = :id_cupomDel
                    ';

                    echo $cupomAttInd->id;

                    $stmtInscCupomAttDel = $this->conexao->prepare($queryDeleteCupomAtt);
                    $stmtInscCupomAttDel->bindValue(':id_cupomDel', $cupomAttInd->id);
                    $stmtInscCupomAttDel->execute();
                }
            }
            
            $query = '
                delete from tb_atividade 
                where id = :id';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id', $_GET['id_att']);

            return $stmt->execute();
        }
    }

?>