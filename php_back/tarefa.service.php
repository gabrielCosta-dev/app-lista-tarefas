<?php 

    //CRUD
    class TarefaService {
            private $conexao;
            private $tarefa;

            public function __construct(Conexao $conexao, Tarefa $tarefa) {
                $this->conexao = $conexao->conectar();
                $this->tarefa = $tarefa;
            }

           public function inserir(){//create
                if ($this->tarefa->__get('tarefa') !== ''/*  && strLen($this->tarefa->__get('tarefa'))>= 8 */) {
                    $query = 'insert into tb_tarefas(tarefa) values(:tarefa)';
                    $stmt = $this->conexao->prepare($query); 
                    $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
                    $stmt->execute();

                    header('Location:nova_tarefa.php?inclusao=1');
                } else {
                    header('Location:nova_tarefa.php?inclusao=0');
                }
           }
           
           public function recuperar(){//read
                $query = '
                select
                 t.id, s.status, t.tarefa
                from
                 tb_tarefas as t
                left join tb_status as s on(t.id_status_fk = s.id)
                ';
                $stmt = $this->conexao->prepare($query);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_OBJ);
           }

           public function atualizar(){//update
                $query = '
                update
                    tb_tarefas
                set
                    tarefa = ?
                where
                    id = ?';

               $stmt = $this->conexao->prepare($query); 
               $stmt->bindValue(1, $this->tarefa->__get('tarefa'));
               $stmt->bindValue(2, $this->tarefa->__get('id'));
               return $stmt->execute();   
           }

           public function remover(){//delete
                $query = '
                    delete from
                        tb_tarefas
                    where 
                        id = ? 
                ';
                $stmt = $this->conexao->prepare($query);
                $stmt->bindValue(1, $this->tarefa->__get('id'));
                return $stmt->execute();   
           }

           public function marcarRealizada(){
                $query = '
                update
                    tb_tarefas
                set 
                   id_status_fk = ?
                where
                    id = ?   ';
               
                    
                $stmt = $this->conexao->prepare($query); 
                $stmt->bindValue(1, $this->tarefa->__get('id_status'));
                $stmt->bindValue(2, $this->tarefa->__get('id'));
                return $stmt->execute();        
           }
    }

?>