<?php
    session_start();
    require_once "../models/ConexaoModel.php";
    require_once "../models/UsuarioModel.php";
    /**
     * Classe destinadas as operações de CRUD do usuario
     */
    class UsuarioService {

        private $conexao;
        private $usuario;

        /**
         * @param - $usuario - usuario que será feito alguma operacao de CRUD.
         * @param - $conexao - objeto necessario para se conectar com o banco de dados.
         */
        public function __construct(Usuario $usuario, ConexaoModel $conexao) {
            $this->conexao = $conexao->conectar();
            $this->usuario = $usuario;
        }

        /**
         * Função responsável por inserir um usuario no banco de dados
         */
        public function inserir() {
            $query = '
                insert into tb_usuario(
                    nome, usuario, email, senha, estado, cidade, cep
                    ) values (
                        :nome, 
                        :usuario, 
                        :email,
                        :senha,
                        :estado,
                        :cidade,
                        :cep)
            ';

            echo $this->usuario->__get('cep') . '<br>';
            
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':nome', $this->usuario->__get('nome'));
            $stmt->bindValue(':usuario', $this->usuario->__get('usuario'));
            $stmt->bindValue(':email', $this->usuario->__get('email'));
            $stmt->bindValue(':senha', $this->usuario->__get('senha'));
            $stmt->bindValue(':estado', $this->usuario->__get('estado'));
            $stmt->bindValue(':cidade', $this->usuario->__get('cidade'));
            $stmt->bindValue(':cep', $this->usuario->__get('cep'));
    
            return $stmt->execute();
        }

        /**
         * Funcao responsável por recuperar/buscar um usuario no banco de dados
         */
        public function recuperar() {
            $query = "select * from tb_usuario where id = :id";

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id', $_SESSION['id']);
            // $stmt->bindValue(':id', 1);
            $stmt->execute();

            $usuarioAchado = $stmt->fetch(PDO::FETCH_OBJ);

            if(empty($usuarioAchado)) {
                return false;
            
            }else {
                $this->usuario->__set('nome', $usuarioAchado->nome);
                $this->usuario->__set('usuario', $usuarioAchado->usuario);
                $this->usuario->__set('email', $usuarioAchado->email);
                $this->usuario->__set('senha', $usuarioAchado->senha);
                $this->usuario->__set('estado', $usuarioAchado->estado);
                $this->usuario->__set('cidade', $usuarioAchado->cidade);
                $this->usuario->__set('cep', $usuarioAchado->cep);

                return true;
            }

        }

        /**
         * Funcao responsavel por atualizar os dados do usuario no banco de dados.
         */
        public function atualizar() {
            $query = '
                UPDATE tb_usuario 
                    SET 
                        nome = :nome,
                        usuario = :usuario,
                        email = :email,
                        estado = :estado,
                        cidade = :cidade,
                        cep = :cep
                    WHERE id = :id
            ';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id', 14);
            $stmt->bindValue(':nome', $this->usuario->__get('nome'));
            $stmt->bindValue(':usuario', $this->usuario->__get('usuario'));
            $stmt->bindValue(':email', $this->usuario->__get('email'));
            $stmt->bindValue(':estado', $this->usuario->__get('estado'));
            $stmt->bindValue(':cidade', $this->usuario->__get('cidade'));
            $stmt->bindValue(':cep', $this->usuario->__get('cep'));

            return $stmt->execute();
        }

        /**
         * Funcao que remove um usuario no banco de dados.
         */
        public function remover() {
            $query = '
                delete from tb_usuario 
                where id = :id';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id', $_GET['id']);
            // $stmt->bindValue(':id', 14);

            return $stmt->execute();
        }
    }

?>