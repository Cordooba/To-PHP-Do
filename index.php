<?php

	require_once 'db/connectdb.php';

	try {
		
		$sql = 'SELECT tarea,nivel,completada completada FROM tareas ORDER BY nivel DESC';

		$result = $pdo->query($sql);

	} catch (PDOException $e) {
		
		die( "Error en la creación de la tabla en la base de datos: ". $e->getMessage() );

	}

	//La funcion fetch() ejecuta la sentencia SQL SELECT * FROM... 
	//Cuando no devuelve nada mas devuelve false
	while ( $row = $result -> fetch(PDO::FETCH_ASSOC) ) {
		
		$tareas [] = $row;

	}

	include 'view.html.php';

?>