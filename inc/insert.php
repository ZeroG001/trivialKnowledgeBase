<?php
	require_once("connectvars.php");
	date_default_timezone_set('US/Eastern');

	$dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$office_number = $_POST['officedropdown'];
	$title = $_POST['title'];
	$summary = $_POST['summary'];
	$name = $_POST['name'];
	$solution = $_POST['solution'];
	
	


		$query = "INSERT INTO knowlege_base (office_id, title, summary, name, solution) VALUES (?,?,?,?,?)";
		if($stmt = $dbc->prepare($query)) {
			if($stmt->bind_param('issss', $office_number, $title, $summary, $name, $solution)) {
			$stmt->execute();
			echo "sucess";
			$stmt->close();
			} else die ("something went wrong");	
		}
	
	mysqli_close($dbc);
	$dbc = null;



?>