<?php 

	$acao = 'recuperar';
	require 'tarefa_controller.php';

?>

<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>App Lista Tarefas</title>

		<link rel="stylesheet" href="css/estilo.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

		<style>		
			/* Edição de tarefas incluídas */
			.editar:hover, .apagar:hover, .marcarRealizada:hover{
				cursor: pointer;
			}
		</style>
	</head>

	<body>
		<nav class="navbar navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
					App Lista Tarefas
				</a>
			</div>
		</nav>

		<div class="container app">
			<div class="row">
				<div class="col-sm-3 menu">
					<ul class="list-group">
						<li class="list-group-item"><a href="index.php">Tarefas pendentes</a></li>
						<li class="list-group-item"><a href="nova_tarefa.php">Nova tarefa</a></li>
						<li class="list-group-item active"><a href="#">Todas tarefas</a></li>
					</ul>
				</div>

				<div class="col-sm-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Todas tarefas</h4>
								<hr />

								<?php foreach ($tarefas as $chave => $tarefa) {
								 ?>

								<div class="row mb-3 d-flex align-items-center tarefa">
									<div class="col-sm-9" id="tarefa_<?=$tarefa->id?>">
										<?= $tarefa->tarefa ?> (<?= $tarefa->status ?>)
									</div>
									<div class="col-sm-3 mt-2 d-flex justify-content-between">

									<?php if ($tarefa->status == 'pendente') {?>

										<i class="fas fa-trash-alt fa-lg text-danger apagar"></i>
										<i class="fas fa-edit fa-lg text-info editar"></i>

									<?php } ?>

										<i class="fas fa-check-square fa-lg text-success marcarRealizada"></i>
									</div>
								</div>

								<?php } ?>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<script>
			document.querySelectorAll('.fa-edit').forEach((editar) =>{
			editar.addEventListener('click', ()=>{
				let tarefaId = event.target.closest('.tarefa').querySelector('.col-sm-9').id
				let tarefaDiv = document.getElementById(tarefaId)
					
				//Criar form de edição
				let form = document.createElement('form')
				form.action = 'tarefa_controller.php?acao=atualizar'
				form.method = 'post'
				form.className = 'row ml-2'

				//Input entrada de texto
				let inputTarefa = document.createElement('input')
				inputTarefa.type = 'text'
				inputTarefa.name = 'tarefa'
				inputTarefa.className = 'col-9 form-control'
				inputTarefa.value = document.getElementById(tarefaId).textContent.trim()

				// Extrai o ID da tarefa da div
                tarefaId = tarefaDiv.id.replace('tarefa_', '');
				console.log(tarefaId);

				//Input hidden
				let inputId = document.createElement('input')
				inputId.type = 'hidden'
				inputId.name = 'tarefa_id';
                inputId.value = tarefaId;

				//Button de envio do form
				let botao = document.createElement('button')
				botao.type = 'submit'
				botao.className = 'col-3 btn btn-info p-1'
				botao.innerHTML = 'Atualizar'

				//Inclusão inputTarefa no form
				form.appendChild(inputTarefa)

				//Inclusão input hidden
				form.appendChild(inputId)

				//Inclusão botão ao form
				form.appendChild(botao)
				
				//Limpar conteudo div tarefa
				tarefaDiv.innerHTML = ''

				//Incluir form na página
				tarefaDiv.parentNode.insertBefore(form, tarefaDiv)
			})
			})

			document.querySelectorAll('.fa-trash-alt').forEach((apagar) =>{
			apagar.addEventListener('click', ()=>{
				let tarefaId = event.target.closest('.tarefa').querySelector('.col-sm-9').id
				let tarefaDiv = document.getElementById(tarefaId)
				
                tarefaId = tarefaDiv.id.replace('tarefa_', '');
				
				location.href =  'todas_tarefas.php?acao=remover&id='+tarefaId
				
			})
			})

			document.querySelectorAll('.fa-check-square').forEach((marcarRealizada) =>{
			marcarRealizada.addEventListener('click', ()=>{
				let tarefaId = event.target.closest('.tarefa').querySelector('.col-sm-9').id
				let tarefaDiv = document.getElementById(tarefaId)
				
                tarefaId = tarefaDiv.id.replace('tarefa_', '');
				
				location.href =  'todas_tarefas.php?acao=marcarRealizada&id='+tarefaId
				
			})
			})
			
		</script>
	</body>
</html>