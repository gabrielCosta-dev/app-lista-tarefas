<?php 

    require '../_App-Lista-Tarefas/tarefa.model.php';
    require '../_App-Lista-Tarefas/tarefa.service.php';
    require '../_App-Lista-Tarefas/conexao.php';

    $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

    //Nova Tarefa
    if ($acao == 'inserir') {
        $tarefa= new Tarefa();
        $tarefa->__set('tarefa', $_POST['tarefa']);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->inserir();
    }else if($acao == 'recuperar'){

       $tarefa = new Tarefa();
       $conexao = new Conexao();

       $tarefaService = new TarefaService($conexao, $tarefa);
       $tarefas = $tarefaService->recuperar();

    } else if($acao == 'atualizar'){

        $tarefa = new Tarefa();
        $tarefa->__set('id', $_POST['tarefa_id']);
        $tarefa->__set('tarefa', $_POST['tarefa']);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);

        if($tarefas = $tarefaService->atualizar()) header('Location:todas_tarefas.php');
    }

    

?>