<?php

    Class Cupom {
        private $id_atividade;
        private $codigo;
        private $valor;
        private $porcentagem;
        private $qntd;
        private $validade;

        public function __get($atributo) {
            return $this->$atributo;
        }

        public function __set($atributo, $valor) {
            $this->$atributo = $valor;
        }
    }

?>