<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Lista de Tareas</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.css">
	<link rel="stylesheet" href="css/styles.css">
	<style>

		.deletetask{

		text-align: right;

		}

		button[type=submit] {

		margin: 0px;

		}

	</style>
</head>
<body>
	<div class="container">
		<div class="row">
		<div class="col-lg-offset-3 col-lg-6">
			<h1>Mis Tareas</h1>
			<hr>
			<table class="table table-striped">
				<thead>
					<div class="form-group col-lg-3">
						<form action="?asc" method="POST">
							<button type="submit" class="btn btn-link"><i class="glyphicon glyphicon-sort-by-alphabet"></i></button>
						</form>
					</div>
					<div class="form-group col-lg-3">	
						<form action="?desc" method="POST">
							<button type="submit" class="btn btn-link"><i class="glyphicon glyphicon-sort-by-alphabet-alt"></i></button>
						</form>
					</div>
					<div class="form-group col-lg-3">	
						<form action="?maxmin" method="POST">
							<button type="submit" class="btn btn-link"><i class="glyphicon glyphicon-sort-by-order-alt"></i></button>
						</form>
					</div>
					<div class="form-group col-lg-3">	
						<form action="?minmax" method="POST">
							<button type="submit" class="btn btn-link"><i class="glyphicon glyphicon-sort-by-order"></i></button>
						</form>
					</div>	
				</thead>
				<tbody>
				<?php if ( !empty ( $tareas ) ) :?>
					<?php foreach ( $tareas as $tarea ) :
						switch ($tarea['nivel']) {
							case '1':
								$colorTarea = 'class="active"';
								break;
							case '2':
								$colorTarea = 'class="succes"';
								break;
							case '3':
								$colorTarea = 'class="info"';
								break;
							case '4':
								$colorTarea = 'class="warning"';
								break;
							case '5':
								$colorTarea = 'class="danger"';
								break;	
							default:
								$colorTarea = '';
								break;
						}
					?>
						<tr <?=$colorTarea?>>
							<th><?=$tarea['tarea']?></th>
							<th class="completetask">
								<form action="?completetask" method="POST">
									<input type="hidden" name="idtask" value=<?=$tarea['id']?>>
									<button type="submit" class="btn btn-link"><i class="glyphicon glyphicon-ok"></i></button>
								</form>
							</th>	
							<th class="deletetask">
								<form action="?deletetask" method="POST">
									<input type="hidden" name="idtask" value=<?=$tarea['id']?>>
									<button type="submit" class="btn btn-link"><i class="glyphicon glyphicon-trash"></i></button>
								</form>
							</th>
						</tr>
					<?php endforeach ;?>
				<?php else : ?>
					<h2>No existen tareas.</h2>
					<p>Introduzca tareas pendientes.</p>
				<?php endif ; ?>		
				</tbody>
			</table>
			<form action="?addtask" method="POST">
					<div class="form-group col-lg-8">
					    <input type="text" class="form-control col-lg-8" name="tarea" placeholder="Introducir Tarea">
					</div>
					<!-- Por defecto si no selecionamos ningun nivel al guardar una tarea 
					tenemos el primer nivel solamente !!! MOD -->
					<div class="form-group col-lg-4">
					    <select class="form-control" name="nivel">
					      <option>Nivel</option>
						  <option value="1">1</option>
						  <option value="2">2</option>
						  <option value="3">3</option>
						  <option value="4">4</option>
						  <option value="5">5</option>
						</select>
					</div>
					<div class="form-group col-lg-4">
						<button type="submit" class="btn btn-info">Guardar</button>					
					</div>
			</form>
			<div class="row">
			<div class="col-lg-offset-3 col-lg-6">
				<?php if( isset($errores) ): ?>
			<div class="panel panel-danger">
				<div class="panel-heading">Error</div>
				<div class="panel-body">
					<?php foreach ( $errores as $error ) : ?>
						<?=$error?><br>
					<?php endforeach; ?>
				</div>
			</div>
			<?php endif; ?>
			</div>
			</div>
			<?php if ( !empty( $tareasCompletadas ) ) : ?>
				<h1>Tareas Completadas</h1>
				<table class="table table-striped">
					<tbody>
					<?php foreach ($tareasCompletadas as $tareasComplete) : ?>
						<tr>
							<th><?=$tareasComplete['tarea']?></th>
							<th class="deletetaskComplete">
								<form action="?deletetaskComplete" method="POST">
									<input type="hidden" name="idtask" value=<?=$tareasComplete['id']?>>
									<button type="submit" class="btn btn-link"><i class="glyphicon glyphicon-trash"></i></button>
								</form>
							</th>
						</tr>
					<?php endforeach ; ?>
					</tbody>
				</table>
			<?php else: ?>
					<h1>Tareas Completadas</h1>
					<table class="table table-striped">
					<tbody>
						<tr>
							<th>No existen tareas completadas.</th>
						</tr>
					</tbody>
					</table>	
			<?php endif; ?>
		</div>
		</div>
	</div>
</body>
</html>