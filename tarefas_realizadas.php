<?
$acao = 'recuperar';
require "./tarefa_controller.php";

?>
<html>

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>App Lista Tarefas</title>

	<link rel="stylesheet" href="css/estilo.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<script>
		function editar(id, tarefa_txt) {
			// create elements
			// form
			let form = document.createElement('form')
			form.action = 'tarefa_controller.php?acao=atualizar&pag=tarefas_realizadas.php'
			form.method = 'post'
			form.className = 'row'
			// input
			let input = document.createElement('input')
			input.type = 'text'
			input.name = 'tarefa'
			input.className = 'col-8 col-md-9 form-control'
			input.value = tarefa_txt
			// input hidden
			let input_id = document.createElement('input')
			input_id.type = 'hidden'
			input_id.name = 'id'
			input_id.value = id
			// button
			let button = document.createElement('button')
			button.type = 'submit'
			button.className = 'col-4 col-md-3 btn btn-info'
			button.innerHTML = 'Atualizar'

			// add elements to form
			form.appendChild(input)
			form.appendChild(button)
			form.appendChild(input_id)

			// add form to page
			let tarefa = document.getElementById('tarefa_' + id)
			tarefa.innerHTML = ''
			tarefa.insertBefore(form, tarefa[0])
		}

		function remover(id) {
			location.href = 'tarefa_controller.php?pag=tarefas_realizadas.php&acao=remover&id=' + id
		}

		function marcarRealizada(id) {
			location.href = 'tarefa_controller.php?pag=tarefas_realizadas.php&acao=marcarRealizada&id=' + id
		}
	</script>
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
			<div class="col-md-3 menu">
				<ul class="list-group">
					<li class="list-group-item"><a href="index.php">Tarefas pendentes</a></li>
					<li class="list-group-item"><a href="nova_tarefa.php">Nova tarefa</a></li>
                    <li class="list-group-item"><a href="todas_tarefas.php">Todas tarefas</a></li>
					<li class="list-group-item active"><a href="#.php">Tarefas realizadas</a></li>
                    
				</ul>
			</div>

			<div class="col-md-9">
				<div class="container pagina">
					<div class="row">
						<div class="col">
							<h4>Tarefas pendentes</h4>
							<hr />

							<? foreach ($tarefas as $key => $value) { ?>
								<? if ($value->status == 'realizado') { ?>
									<!-- row -->
									<div class="row mb-3 d-flex align-items-center tarefa py-5" style="background-color:#f2f2f2">

										<!-- txt -->
										<div class="col-sm-9" id='<?= 'tarefa_' . $value->id ?>'>
											<?= $value->tarefa ?>
										</div>
										<!-- button(s) -->
										<div class="col-sm-3 d-flex mt-3 mt-sm-0 justify-content-end">
											<i class="fas fa-trash-alt fa-lg text-danger ml-sm-auto" onclick="remover(<?= $value->id ?>)"></i>
										</div>

									</div>
								<? } ?>
							<? } ?>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>