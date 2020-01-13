<?php

    /**
     * Classe do modelo do evento.
     */
    Class Evento {
        private $id_usuario;
        private $nome;
        private $email;
        private $descricao;
        private $tipo;
        private $area;
        private $preco_evento;
        private $qntd_part;
        private $data_inicio;
        private $data_fim;
        private $endereco;
        private $bairro;
        private $estado;
        private $cidade;
        private $cep;
        private $num_usuario_cads;

        public function __get($atributo) {
            return $this->$atributo;
        }

        public function __set($atributo, $valor) {
            $this->$atributo = $valor;
        }
    }

?>