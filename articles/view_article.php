<?php
require_once("../inc/config.php");

//If the Request method is get then... 
if ($_SERVER['REQUEST_METHOD'] == "GET") {
require_once (ROOT_PATH . "inc/sql_queries.php");
$sqlquery = new mysql();

//query the database and get the results based on the $page (page is the arricle ID in the database)
$page = $_GET['a_id'];
$results = $sqlquery->get_article_information($page);

//Quick Fix. Tell the user the record does not exist if the array is empty. Long Fix retun the cound of all records in database and use that valiablr.
if (empty($results)) {

	echo "This record does not exist";
	exit();
}

?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>css/normalize.css">
		<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>css/knowlege_base.css">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

		<style>


		</style>

		<title> View Article </title>

	</head>

	<body>
	<div class="knowlege_base">

		<h2><?php echo $results[0]['title']; ?></h2>

		<p> Summary </p>
		<div class="issue_summary"> <?php echo $results[0]['summary']; ?> </div>

		<p> Solution </p>
		<div><?php echo $results[0]['solution']; ?> </div> 
		
	</div>
	</body>
<?php } else {echo "You did not get here using <code>GET</code> method";} ?>
</html>