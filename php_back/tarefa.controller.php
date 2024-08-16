<?php 

    require '../_App-Lista-Tarefas/tarefa.model.php';
    require '../_App-Lista-Tarefas/tarefa.service.php';
    require '../_App-Lista-Tarefas/conexao.php';

    $tarefa= new Tarefa();
    $tarefa->__set('tarefa', $_POST['tarefa']);

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->inserir();

    header('Location:nova_tarefa.php?inclusao=1');

?>