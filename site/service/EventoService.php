<?php 

    /**
     * Classe responsavel pelas operacoes de CRUDE de um evento.
     */
    class EventoService {
        private $conexao;
        private $evento;

        /**
         * @param - $evento - evento que será feita alguma operacao de CRUD.
         * @param - $conexao - objeto conexao necessaria para se conectar ao banco de dados.   
         */
        public function __construct(Evento $evento, ConexaoModel $conexao) {
            $this->conexao = $conexao->conectar();
            $this->evento = $evento;
        }

        /**
         * Funcao responsável por inserir um evento no banco de dados.
         */
        public function inserir() {
            $query = '
                insert into tb_evento(
                    id_usuario, nome, email, descricao, tipo, area, preco_evento, qntd_part, data_inicio, data_fim, endereco, bairro, estado, cidade, cep
                    ) values (
                        :id_usuario,
                        :nome,
                        :email,
                        :descricao,
                        :tipo,
                        :area,
                        :preco_evento,
                        :qntd_part,
                        :data_inicio,
                        :data_fim,
                        :endereco,
                        :bairro,
                        :estado,
                        :cidade,
                        :cep
                    )';

            if ($_POST['tipo'] == 'gratis' || isset($_POST['tipo'])) {
                $_POST['valor'] = 0.00;
            }

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id_usuario', $this->evento->__get('id_usuario'));
            $stmt->bindValue(':nome', $this->evento->__get('nome'));
            $stmt->bindValue(':email', $this->evento->__get('email'));
            $stmt->bindValue(':descricao', $this->evento->__get('descricao'));
            $stmt->bindValue(':tipo', $this->evento->__get('tipo'));
            $stmt->bindValue(':area', $this->evento->__get('area'));
            $stmt->bindValue(':preco_evento', $this->evento->__get('preco_evento'));
            $stmt->bindValue(':qntd_part', $this->evento->__get('qntd_part'));
            $stmt->bindValue(':data_inicio', $this->evento->__get('data_inicio'));
            $stmt->bindValue(':data_fim', $this->evento->__get('data_fim'));
            $stmt->bindValue(':endereco', $this->evento->__get('endereco'));
            $stmt->bindValue(':bairro', $this->evento->__get('bairro'));
            $stmt->bindValue(':estado', $this->evento->__get('estado'));
            $stmt->bindValue(':cidade', $this->evento->__get('cidade'));
            $stmt->bindValue(':cep', $this->evento->__get('cep'));

            $resul = $stmt->execute();

            if ($resul) {
                $queryEvento = 'select * from tb_evento where 
                    id_usuario = :id_usuario and
                    nome = :nome and
                    email = :email and
                    descricao = :descricao and
                    tipo = :tipo and
                    area = :area and
                    preco_evento = :preco_evento and
                    qntd_part = :qntd_part and
                    data_inicio = :data_inicio and
                    data_fim = :data_fim and
                    endereco = :endereco and
                    bairro = :bairro and
                    estado = :estado and
                    cidade = :cidade and
                    cep = :cep';

                $stmtEvento = $this->conexao->prepare($queryEvento);
                $stmtEvento->bindValue(':id_usuario', $this->evento->__get('id_usuario'));
                $stmtEvento->bindValue(':nome', $this->evento->__get('nome'));
                $stmtEvento->bindValue(':email', $this->evento->__get('email'));
                $stmtEvento->bindValue(':descricao', $this->evento->__get('descricao'));
                $stmtEvento->bindValue(':tipo', $this->evento->__get('tipo'));
                $stmtEvento->bindValue(':area', $this->evento->__get('area'));
                $stmtEvento->bindValue(':preco_evento', $this->evento->__get('preco_evento'));
                $stmtEvento->bindValue(':qntd_part', $this->evento->__get('qntd_part'));
                $stmtEvento->bindValue(':data_inicio', $this->evento->__get('data_inicio'));
                $stmtEvento->bindValue(':data_fim', $this->evento->__get('data_fim'));
                $stmtEvento->bindValue(':endereco', $this->evento->__get('endereco'));
                $stmtEvento->bindValue(':bairro', $this->evento->__get('bairro'));
                $stmtEvento->bindValue(':estado', $this->evento->__get('estado'));
                $stmtEvento->bindValue(':cidade', $this->evento->__get('cidade'));
                $stmtEvento->bindValue(':cep', $this->evento->__get('cep'));

                if ($stmtEvento->execute()) {

                    $eventoCriado = $stmtEvento->fetchAll(PDO::FETCH_OBJ);

                    echo '<pre>';
                    print_r($eventoCriado);
                    echo '</pre>';

                    $queryInscricao = 'insert into tb_inscricao(
                            id_evento, id_usuario, papel 
                                ) values (
                                    :id_evento, 
                                    :id_usuario, 
                                    :papel
                                )';
                    
                    $stmtInscricaoAdmin = $this->conexao->prepare($queryInscricao);
                    $stmtInscricaoAdmin->bindValue(':id_evento', $eventoCriado[0]->id);
                    $stmtInscricaoAdmin->bindValue(':id_usuario', $_SESSION['id']);
                    $stmtInscricaoAdmin->bindValue(':papel', 1);
                    
                    return $stmtInscricaoAdmin->execute();
                }
            }
            return 0;
        }

        /**
         * Funcao responsavel por recuperar/buscar um evento no banco de dados.
         */
        public function recuperar() {
            $query = '
                select * from tb_evento 
                where id = :id
            ';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id', $_GET['id']);
            // $stmt->bindValue(':id', 24);
            $stmt->execute();

            $eventoAchado = $stmt->fetch(PDO::FETCH_OBJ);

            if (empty($eventoAchado)) {
                return false;
            
            }else {
                $this->evento->__set('id_usuario', $eventoAchado->id_usuario);
                $this->evento->__set('nome', $eventoAchado->nome);
                $this->evento->__set('email', $eventoAchado->email);
                $this->evento->__set('descricao', $eventoAchado->descricao);
                $this->evento->__set('tipo', $eventoAchado->tipo);
                $this->evento->__set('area', $eventoAchado->area);
                $this->evento->__set('preco_evento', $eventoAchado->preco_evento);
                $this->evento->__set('qntd_part', $eventoAchado->qntd_part);
                $this->evento->__set('data_inicio', $eventoAchado->data_inicio);
                $this->evento->__set('data_fim', $eventoAchado->data_fim);
                $this->evento->__set('endereco', $eventoAchado->endereco);
                $this->evento->__set('bairro', $eventoAchado->bairro);
                $this->evento->__set('estado', $eventoAchado->estado);
                $this->evento->__set('cidade', $eventoAchado->cidade);
                $this->evento->__set('cep', $eventoAchado->cep);
                $this->evento->__set('num_usuario_cads', $eventoAchado->num_usuario_cads);

                return true;
            }

        }

        /**
         * Funcao responsavel por atualizar um evento no banco de dados.
         */
        public function atualizar() {
            $query = '
                UPDATE tb_evento 
                    SET 
                        id_usuario = :id_usuario,
                        nome = :nome,
                        email = :email,
                        descricao = :descricao,
                        tipo = :tipo,
                        area = :area,
                        preco_evento = :preco_evento,
                        qntd_part = :qntd_part,
                        data_inicio = :data_inicio,
                        data_fim = :data_fim,
                        endereco = :endereco,
                        bairro = :bairro,
                        estado = :estado,
                        cidade = :cidade,
                        cep = :cep,
                        num_usuario_cads = :num_usuario_cads
                    WHERE id = :id
            ';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id', $_GET['id']);
            // $stmt->bindValue(':id', 24);
            $stmt->bindValue(':id_usuario', $this->evento->__get('id_usuario'));
            $stmt->bindValue(':nome', $this->evento->__get('nome'));
            $stmt->bindValue(':email', $this->evento->__get('email'));
            $stmt->bindValue(':descricao', $this->evento->__get('descricao'));
            $stmt->bindValue(':tipo', $this->evento->__get('tipo'));
            $stmt->bindValue(':area', $this->evento->__get('area'));
            $stmt->bindValue(':preco_evento', $this->evento->__get('preco_evento'));
            $stmt->bindValue(':qntd_part', $this->evento->__get('qntd_part'));
            $stmt->bindValue(':data_inicio', $this->evento->__get('data_inicio'));
            $stmt->bindValue(':data_fim', $this->evento->__get('data_fim'));
            $stmt->bindValue(':endereco', $this->evento->__get('endereco'));
            $stmt->bindValue(':bairro', $this->evento->__get('bairro'));
            $stmt->bindValue(':estado', $this->evento->__get('estado'));
            $stmt->bindValue(':cidade', $this->evento->__get('cidade'));
            $stmt->bindValue(':cep', $this->evento->__get('cep'));
            $stmt->bindValue(':num_usuario_cads', $this->evento->__get('num_usuario_cads'));

            return $stmt->execute();
        }

        /**
         * Funcao responsavel por remover um evento do banco de dados.
         */
        public function remover() {
            $query = '
                delete from tb_evento 
                where id = :id';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id', $_GET['id']);
            // $stmt->bindValue(':id', 24);

            return $stmt->execute();
        }
    }

?>