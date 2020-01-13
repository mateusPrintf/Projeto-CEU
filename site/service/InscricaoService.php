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

            return $stmt->execute();
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

?>