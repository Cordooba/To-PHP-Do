<?php

	require_once 'connectdb.php';

	try {

		$sql = 'CREATE TABLE tareas (
				id 			INT AUTO_INCREMENT PRIMARY KEY,
				tarea 		VARCHAR(255) NOT NULL,
				nivel 		INT,
				completada 	INT,
				fechahora 	DATETIME DEFAULT CURRENT_TIMESTAMP
				) DEFAULT CHARACTER SET UTF8 ENGINE=InnoDB';

		$pdo->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

		$pdo->exec($sql);
	
	} catch ( PDOException $e ) {
	
		die( "Error en la creación de la tabla en la base de datos: ". $e->getMessage() );

	}
?>