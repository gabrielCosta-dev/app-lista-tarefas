<?php 

    require '../_App-Lista-Tarefas/tarefa.model.php';
    require '../_App-Lista-Tarefas/tarefa.service.php';
    require '../_App-Lista-Tarefas/conexao.php';

    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    $tarefa= new Tarefa();
    $tarefa->__set('tarefa', $_POST['tarefa']);

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->inserir();

    echo '<pre>';
    print_r($tarefaService);
    echo '</pre>';

?>