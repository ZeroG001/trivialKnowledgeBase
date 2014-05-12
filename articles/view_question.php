<?php

require_once("../inc/config.php");

if ($_SERVER['REQUEST_METHOD'] == "GET") {
require_once (ROOT_PATH . "inc/sql_queries.php");
$sqlquery = new mysql();

$page = $_GET['a_id'];
$results = $sqlquery->get_question_article_information($page);
//Quick Fix. Tell the user the record does not exist if the array is empty. Long Fix retun the cound of all records in database and use that valiablr.
if (empty($results)) {

	echo "This record does not exist";
	exit();
}

?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>css/knowlege_base.css">
		<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>css/normalize.css">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

		<style>


		</style>

		<title> View Article </title>

	</head>

	<body>
	<div class="knowlege_base">


		<h2> Question </h2>
		<div class="issue_summary"> <?php echo $results[0]['question']; ?> </div>

		<p> Answer </p>
		<div><?php echo $results[0]['answer']; ?> </div> 
		
	</div>
	</body>
<?php } else {echo "You did not get here using <code>GET</code> method";} ?>
</html>