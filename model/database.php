<?php

	$dsn = 'mysql:host=localhost;dbname=shopping_list';
	$username = 'root';
	$password = 'root';

	try {
		$db = new PDO($dsn, $username, $password);
	} catch(PDOException $e) {
		$error = "Database Error: ";
		$error .= $e->getMessage();
		include('view/error.php');
		exit();
	}

?>