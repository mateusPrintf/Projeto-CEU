<?php

    Class Inscricao {
        private $id_evento;
        private $id_usuario;

        public function __get($atributo) {
            return $this->$atributo;
        }

        public function __set($atributo, $valor) {
            $this->$atributo = $valor;
        }
    }

?>