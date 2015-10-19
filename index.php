<?php

	require_once 'db/connectdb.php';

	try {
		
		$sql = 'SELECT tarea, completada FROM tareas';

		$result = $pdo->query($sql);

	} catch (PDOException $e) {
		
		die( "Error en la creación de la tabla en la base de datos: ". $e->getMessage() );

	}

	//La funcion fetch() ejecuta la sentencia SQL SELECT * FROM... 
	//Cuando no devuelve nada mas devuelve false
	while ( $row = $result -> fetch() ) {
		
		$tareas [] = $row['tarea'];
		$tareas [] = $row['completada'];

	}

	include 'view.html.php';

?>