<?php

    /**
     * Classe responsável por setar os atributos de comunicação com o banco de dados
     */
    Class Conexao extends PDO{

        public function __construct() {
            return parent::__construct('mysql:host=127.0.0.1;dbname=ceu', 'root', '1219'); 
        }
    }
?>