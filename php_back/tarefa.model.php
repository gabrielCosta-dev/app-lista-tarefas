<?php 

    class Tarefa {
        private string $id;
        private string $id_status;
        private string $tarefa;
        private string $data_cadastro;

        public function __get($atributo){
            return $this->$atributo;
        }

        public function __set($atributo, $valor){
            $this->$atributo = $valor;
            return $this;
        }
    }
    

    
?>