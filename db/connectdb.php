<?php

	require_once 'datadb.php';

	try {

		$pdo = new PDO ( 'mysql:host='.$host.';dbname='.$db, $usser, $pass ) ;

		// -> utilizamos los metodos de la clase definida
		
		$pdo->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

		$pdo->exec('SET NAMES utf8');
		
	} catch ( PDOException $e ) {
			//Mostrar ese mensaje pasado por parámetros y parar la carga de todos los script DIE()
		die( 'Error de conexion a la base de datos: '. $e->getMessage() );

	}	

?>