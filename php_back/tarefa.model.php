<?php 

    class Tarefa {
        private number $id;
        private bool $id_status;
        private string $tarefa;
        private string $data_cadastro;

        public function __get($atributo){
            return $this->$atributo;
        }

        public function __set($atributo, $valor){
            $this->$atributo = $valor;
        }
    }
    

    
?>