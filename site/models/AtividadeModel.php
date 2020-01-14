<?php

    Class Atividade {
        private $id_evento;
        private $nome;
        private $qntd_part;
        private $inscricao;
        private $valor;
        private $tipo;
        private $carga_hr;
        private $data_inicio;
        private $data_fim;

        public function __get($atributo) {
            return $this->$atributo;
        }

        public function __set($atributo, $valor) {
            $this->$atributo = $valor;
        }
    }
?>  