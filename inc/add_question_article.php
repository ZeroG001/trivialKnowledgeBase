<?php
require_once("connectvars.php");
date_default_timezone_set("US/Eastern");

$question = $_POST['question'];
$category = $_POST['category'];
$solution = $_POST['solution'];

$dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$query = "INSERT INTO knowlege_base_questions (question, answer) VALUES (?,?);";

$stmt = $dbc->prepare($query);
$stmt->bind_param('ss', $question, $solution);
if($stmt->execute()) {
	echo "sucess";
	$stmt->close();
	header("location:../thank-you.php");
} else {die("something went horrably wrong. probably something went wrong with the query");}


?>