<?php

	require_once 'db/connectdb.php';

	//TODAS LAS SENTENCIAS SQL QUE ESCRIBAMOS EN EL CODIGO PHP.TODAS EN UN BLOQUE TRY/CATCH

	if ( isset( $_GET['asc'] ) ) {

		try {
			
			$sql = "SELECT id,tarea,nivel FROM tareas ORDER BY tarea ASC;";

			$ps = $pdo -> prepare ($sql);

			$ps -> execute();

		} catch (PDOException $e) {
			
			die( "Error en la consulta de la base de datos: ". $e->getMessage() );

		}

		while ( $row = $ps -> fetch(PDO::FETCH_ASSOC) ) {
		
			$tareas [] = $row;

		}

	}

	if ( isset( $_GET['desc'] ) ) {

		try {
			
			$sql = "SELECT id,tarea,nivel FROM tareas ORDER BY tarea DESC;";

			$ps = $pdo -> prepare ($sql);

			$ps -> execute();
			
		} catch (PDOException $e) {
			
			die( "Error en la consulta de la base de datos:  ". $e->getMessage() );

		}

		while ( $row = $ps -> fetch(PDO::FETCH_ASSOC) ) {
		
			$tareas [] = $row;

		}
		
	}

	if ( isset( $_GET['maxmin'] ) ) {

		try {
			
			$sql = "SELECT id,tarea,nivel FROM tareas ORDER BY nivel DESC;";

			$ps = $pdo -> prepare ($sql);

			$ps -> execute();
			
		} catch (PDOException $e) {
			
			die( "Error en la consulta de la base de datos:  ". $e->getMessage() );

		}

		while ( $row = $ps -> fetch(PDO::FETCH_ASSOC) ) {
		
			$tareas [] = $row;

		}

	}

	if ( isset( $_GET['minmax'] ) ) {

		try {
			
			$sql = "SELECT id,tarea,nivel FROM tareas ORDER BY nivel ASC;";

			$ps = $pdo -> prepare ($sql);

			$ps -> execute();
	
		} catch (PDOException $e) {
			
			die( "Error en la consulta de la base de datos: ". $e->getMessage() );

		}

		while ( $row = $ps -> fetch(PDO::FETCH_ASSOC) ) {
		
			$tareas [] = $row;

		}

	}

	if ( isset( $_GET['completetask'] ) ) {
		
		$tareasCompletadas = [];

		$id = $_POST['idtask'];

		try {
			
			$sql = "UPDATE tareas SET completada = '1' WHERE id = :id";

			$ps = $pdo -> prepare ($sql);

			$ps->bindValue(':id',$id);

			$ps -> execute();

			$sql = "SELECT id,tarea,nivel FROM tareas WHERE completada = '1';";

			$ps = $pdo -> prepare ($sql);

			$ps -> execute();
	
		} catch (PDOException $e) {
			
			die( "Error en la consulta de la base de datos: ". $e->getMessage() );

		}

		while ( $row = $ps -> fetch(PDO::FETCH_ASSOC) ) {
		
			$tareasCompletadas [] = $row;

		}

	}

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

			$sql = "INSERT INTO tareas (tarea, nivel) VALUES (:tarea, :nivel);";
			//Evitamos la inyecion de codigo sql
			//Prepared Statement
			$ps = $pdo->prepare($sql);
			//Metodos para establecer los datos filtrados en el Prepared Statement
			$ps->bindValue(':tarea',$tarea);
			$ps->bindValue(':nivel',$nivel);
			//Ejecutamos la sentencia
			$ps->execute();

			//$pdo -> exec($sql);

			
			} catch (PDOException $e) {
			
			die( "Error en la creación de la tabla en la base de datos: ". $e->getMessage() );

			}

			//Solo funciona en los controladores
			//header("Location: .");

			header("Location: .");
			exit();

		}

	}

	if ( isset( $_GET['deletetaskComplete'] ) ) {

		$id = $_POST['idtask'];

		if ( is_numeric($id) ) {

			try {

			$sql = "DELETE FROM tareas WHERE id = :id"  ;

			$ps = $pdo->prepare($sql);

			$ps->bindValue(':id',$id);

			$ps->execute();

			//$pdo -> exec($sql);

		} catch (PDOException $e) {
			
			die( "Error en la creación de la tabla en la base de datos: ". $e->getMessage() );

		}

		header("Location: .");
		exit();

		}

	}

	if ( isset( $_GET['deletetask'] ) ) {

		$id = $_POST['idtask'];

		if ( is_numeric($id) ) {

			try {

			$sql = "DELETE FROM tareas WHERE id = :id"  ;

			$ps = $pdo->prepare($sql);

			$ps->bindValue(':id',$id);

			$ps->execute();

			//$pdo -> exec($sql);

		} catch (PDOException $e) {
			
			die( "Error en la creación de la tabla en la base de datos: ". $e->getMessage() );

		}

		header("Location: .");
		exit();

		}

	}

	if (empty($tareasCompletadas) ) {

		try {

		$sql = 'SELECT id,tarea,nivel FROM tareas WHERE completada != "0" ORDER BY nivel DESC, tarea ASC;';

		$ps = $pdo->prepare($sql);

		$ps->execute();

		//$result = $pdo->query($sql);

		} catch (PDOException $e) {
		
			die( "Error en la creación de la tabla en la base de datos: ". $e->getMessage() );

		}

	//La funcion fetch() ejecuta la sentencia SQL SELECT * FROM... 
	//Cuando no devuelve nada mas devuelve false
	while ( $row = $ps -> fetch(PDO::FETCH_ASSOC) ) {
		
		$tareasCompletadas [] = $row;

	}		

	}

	if ( empty($tareas) ) {

		try {

		$sql = 'SELECT id,tarea,nivel FROM tareas WHERE completada != "1" ORDER BY nivel DESC, tarea ASC;';

		$ps = $pdo->prepare($sql);

		$ps->execute();

		//$result = $pdo->query($sql);

		} catch (PDOException $e) {
		
			die( "Error en la creación de la tabla en la base de datos: ". $e->getMessage() );

		}

	//La funcion fetch() ejecuta la sentencia SQL SELECT * FROM... 
	//Cuando no devuelve nada mas devuelve false
	while ( $row = $ps -> fetch(PDO::FETCH_ASSOC) ) {
		
		$tareas [] = $row;

	}

	}

	require_once 'view.html.php';

?>