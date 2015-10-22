<?php

	require_once 'db/connectdb.php';

	//TODAS LAS SENTENCIAS SQL QUE ESCRIBAMOS EN EL CODIGO PHP.TODAS EN UN BLOQUE TRY/CATCH

	if ( isset( $_GET['addtask'] ) ) {

		$tarea = htmlspecialchars($_POST['tarea'], ENT_QUOTES, 'UTF-8');
		$nivel = htmlspecialchars($_POST['nivel'], ENT_QUOTES, 'UTF-8');
		$id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
		$errores = [];

		if ( $tarea == "" ) {

			$errores[] = "Debes indicar el texto en el campo tarea.";

		}

		if ( $nivel < 1 || $nivel > 5 ) {

			$errores[] = "Debes indicar el nivel para establecer la prioridad de la tarea.";

		}

		if ( empty($errores) ) {

			try {

			$sql = "INSERT INTO tareas (tarea, nivel) VALUES ('$tarea', '$nivel');";

			$pdo -> exec($sql);

			
			} catch (PDOException $e) {
			
			die( "Error en la creación de la tabla en la base de datos: ". $e->getMessage() );

			}

			//Solo funciona en los controladores
			//header("Location: .");

			header("Location: .");
			exit();

		}

	}

	if ( isset( $_GET['deletetask'] ) ) {

		$id = $_POST['idtask'];

		if ( is_numeric($id) ) {

			try {

			$sql = "DELETE FROM tareas WHERE id = $id"  ;

			$pdo -> exec($sql);

		} catch (PDOException $e) {
			
			die( "Error en la creación de la tabla en la base de datos: ". $e->getMessage() );

		}

		header("Location: .");
		exit();

		}

	}

	try {

		$sql = 'SELECT id,tarea,nivel FROM tareas ORDER BY nivel DESC, tarea ASC;';

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