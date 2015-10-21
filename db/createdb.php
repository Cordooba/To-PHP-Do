<?php

	require_once 'connectdb.php';

	try {

		//ENUM('1','2','3','4','5')
		//SET
		//BOOL 0=FALSE 1=TRUE
		$sql = "CREATE TABLE tareas (
				id 			INT AUTO_INCREMENT PRIMARY KEY,
				tarea 		VARCHAR(255) NOT NULL,
				nivel 		ENUM('1','2','3','4','5') NOT NULL DEFAULT '1',
				completada 	BOOL DEFAULT 0,
				fechahora 	DATETIME DEFAULT CURRENT_TIMESTAMP
				) DEFAULT CHARACTER SET UTF8 ENGINE=InnoDB";

		$pdo->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

		$pdo->exec($sql);
	
	} catch ( PDOException $e ) {
	
		die( "Error en la creación de la tabla en la base de datos: ". $e->getMessage() );

	}
?>