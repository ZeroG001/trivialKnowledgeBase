<?php

try {
		$db = new PDO("mysql:host=localhost; dbname=one", "root", "sonic001");
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Turns on error reporting and catches the exception
		$db->exec("SET NAMES 'utf8'");
	} catch (Exception $e) {
		echo "There was a problem connecting to the database";
		exit;
	}
?>