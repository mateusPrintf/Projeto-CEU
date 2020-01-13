<?php

    /**
     * Classe responsavel por fazer as operacoes de CRUD de um cupom.
     */
    Class CupomService {
        private $conexao;
        private $cupom;

        public function __construct(Cupom $cupom, ConexaoModel $conexao) {
            $this->conexao = $conexao->conectar();
            $this->cupom = $cupom;
        }

        /**
         * Funcao responsavel por inserir um cupom de uma atividade no banco de dados.
         */
        public function inserir() {
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

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id_atividade', $this->cupom->__get('id_atividade'));
            $stmt->bindValue(':codigo', $this->cupom->__get('codigo'));
            $stmt->bindValue(':valor', $this->cupom->__get('valor'));
            $stmt->bindValue(':porcentagem', $this->cupom->__get('porcentagem'));
            $stmt->bindValue(':qntd', $this->cupom->__get('qntd'));
            $stmt->bindValue(':validade', $this->cupom->__get('validade'));

            return $stmt->execute();
        }

        /**
         * Funcao responsavel por recuparar um cupom de um banco de dados.
         */
        public function recuperar() {
            $query = 'select * from tb_cupom where id = :id';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id', $_GET['id_cupom']);
            $stmt->execute();

            $cupomAchado = $stmt->fetch(PDO::FETCH_OBJ);

            if (empty($cupomAchado)) return false;
            else {
                $this->cupom->__set('id_atividade', $cupomAchado->id_atividade);
                $this->cupom->__set('codigo', $cupomAchado->codigo);
                $this->cupom->__set('valor', $cupomAchado->valor);
                $this->cupom->__set('porcentagem', $cupomAchado->porcentagem);
                $this->cupom->__set('qntd', $cupomAchado->qntd);
                $this->cupom->__set('validade', $cupomAchado->validade);

                return true;
            }
        }

        /**
         * Funcao reponsavel por recuperar todas os cupons, dado um id de uma atividade.
         */
        public function recuperarTodos() {
            $query = 'select * from tb_cupom';

            $stmt = $this->conexao->prepare($query);
            $stmt->execute();

            $cuponsAchados = $stmt->fetchAll(PDO::FETCH_OBJ);

            return $cuponsAchados;
        }

        /**
         * Funcao reponsavel por atualizar um cupom no banco de dados.
         */
        public function atualizar() {
            $query = '
                UPDATE tb_cupom 
                    SET 
                        codigo = :codigo,
                        valor = :valor,
                        porcentagem = :porcentagem,
                        qntd = :qntd,
                        validade = :validade
                    WHERE id = :id';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':codigo', $this->cupom->__get('codigo'));
            $stmt->bindValue(':valor', $this->cupom->__get('valor'));
            $stmt->bindValue(':porcentagem', $this->cupom->__get('porcentagem'));
            $stmt->bindValue(':qntd', $this->cupom->__get('qntd'));
            $stmt->bindValue(':validade', $this->cupom->__get('validade'));
            $stmt->bindValue(':id', $_GET['id_cupom']);
            
            return $stmt->execute();
        }

        /**
         * Funcao responsavel por remover um cupom no banco de dados, dado um id.
         */
        public function remover() {
           $query = 'delete from tb_cupom where id = :id';

           $stmt = $this->conexao->prepare($query);
           $stmt->bindValue(':id', $_GET['id_cupom']);

           return $stmt->execute();
        }
    }

?>