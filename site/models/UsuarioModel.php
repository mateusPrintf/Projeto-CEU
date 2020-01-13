<?php
    /**
     * Classe modelo para o usuario
     */
    Class Usuario {
        private $nome;
        private $usuario;
        private $email;
        private $senha;
        private $estado;
        private $cidade;
        private $cep;

        public function __get($atributo) {
            return $this->$atributo;
        }

        public function __set($atributo, $valor) {
            $this->$atributo = $valor;
        }
    }
?>