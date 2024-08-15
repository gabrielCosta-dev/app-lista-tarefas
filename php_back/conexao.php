<?php 

    class Conexao {
        private string $host = "localhost";
        private string $dbname = "php_com_pdo";
        private string $user = "root";
        private string $pass = "";

        public function conectar(){
            try {
                
                $conexao = new PDO(
                    "mysql:host=$this->host;dbname=$this->dbname",
                    $this->user,
                    $this->pass
                );

                return $conexao;

            } catch (PDOException $e) {
                echo '<p>'. $e->getMessage() .'</p>';
            }
        }
    }

?>