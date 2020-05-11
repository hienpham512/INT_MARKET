<?php
	
	$dsn = "mysql:host=localhost; dbname=intmarket";
	$username = "root";
	$password = "root";

	try {
		$bdd = new PDO($dsn, $username, $password);
	}catch (PDOException $e) {
		$error_message = $e -> getMessage();
		echo $error_message;
		exit();
	}
?>
