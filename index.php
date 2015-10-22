<?php

	require_once 'db/connectdb.php';
	//TODAS LAS SENTENCIAS SQL QUE ESCRIBAMOS EN EL CODIGO PHP
	//TODAS EN UN BLOQUE TRY/CATCH

	if ( $_POST ) {

		$tarea = htmlspecialchars($_POST['tarea'], ENT_QUOTES, 'UTF-8');
		$nivel = htmlspecialchars($_POST['nivel'], ENT_QUOTES, 'UTF-8');

		try {

			$sql = "INSERT INTO tareas (tarea, nivel) VALUES ('$tarea', '$nivel');";

			$pdo -> exec($sql);

			
		} catch (PDOException $e) {
			
			die( "Error en la creación de la tabla en la base de datos: ". $e->getMessage() );

		}

	}


	try {

		$sql = 'SELECT tarea,nivel,completada completada FROM tareas ORDER BY nivel DESC, tarea ASC;';

		$result = $pdo->query($sql);

	} catch (PDOException $e) {
		
		die( "Error en la creación de la tabla en la base de datos: ". $e->getMessage() );

	}

	//La funcion fetch() ejecuta la sentencia SQL SELECT * FROM... 
	//Cuando no devuelve nada mas devuelve false
	while ( $row = $result -> fetch(PDO::FETCH_ASSOC) ) {
		
		$tareas [] = $row;

	}

	require_once 'view.html.php';

?>