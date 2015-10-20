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
			<h1>Mis Tareas</h1>
			<hr>
			<table class="table table-striped">
				<tbody>
				<!-- Si la tarea esta completada pintarla de color rojo -->
				<?php foreach ( $tareas as $tarea ) :?>
					<?php if ( $tareas['completada'] == 0 ) :?>
					<tr class="warning">
						<th><?=$tareas['tarea']?></th>
						<th><span class="glyphicon glyphicon-ok"></span></th>
						<th><span class="glyphicon glyphicon-trash"></span></th>
					</tr>
				<?php elseif ( $tareas['completada'] != 0 ) :?>
					<tr class="danger">
						<th><?=$tareas['tarea']?></th>
						<th><span class="glyphicon glyphicon-ok"></span></th>
						<th><span class="glyphicon glyphicon-trash"></span></th>
					</tr>
				<?php endif ;?>
				<?php endforeach ;?>
				</tbody>
			</table>
			<form action="" class="form-iline" method="">
				<div class="form-group">
					<input type="text" class="form-control" name="tarea" placeholder="Introducir una tarea...">
				</div>
					<button type="submit" class="btn btn-info">Guardar</button>
			</form>
	</div>
	</div>
	</div>
</body>
</html>