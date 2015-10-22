<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Lista de Tareas</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.css">
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
	<div class="container">
		<div class="row">
		<div class="col-lg-offset-3 col-lg-6">
		<!-- <pre>
			<?php var_dump($tareas) ?>
		</pre> 

		Tareas de las mas prioritarias a las menos prioritarias
		-->
			<h1>Mis Tareas</h1>
			<hr>
			<table class="table table-striped">
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
							<th><span class="glyphicon glyphicon-ok"></span></th>
							<th><span class="glyphicon glyphicon-trash"></span></th>
						</tr>
					<?php endforeach ;?>
				<?php else : ?>
					<h2>No existen tareas.</h2>
					<p>Introduzca tareas pendientes.</p>
				<?php endif ; ?>		
				</tbody>
			</table>
			<form class="" method="POST">
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
		</div>
		</div>
	</div>
</body>
</html>