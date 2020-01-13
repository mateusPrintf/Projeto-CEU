<?php

    Class ConexaoModel {
        private $dsn = 'mysql:host=127.0.0.1;dbname=ceu';
        private $userName = 'root';
        private $password = '1219';

        public function conectar() {
            try {
                $conexao = new PDO($this->dsn, $this->userName, $this->password);

                return $conexao;

            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

?>