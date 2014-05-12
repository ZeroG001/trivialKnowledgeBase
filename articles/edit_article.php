<?php
require_once("../inc/config.php");

if ($_SERVER['REQUEST_METHOD'] == "GET") {
require_once (ROOT_PATH . "inc/sql_queries.php");
$sqlquery = new mysql();

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
		<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>css/knowlege_base.css">
		<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>css/normalize.css">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script type="text/javascript" src="<?php echo BASE_URL ?>inc/tinymce/tinymce.min.js"></script>
	<script type="text/javascript">
	tinymce.init({selector:'textarea'});
	</script>
		<title> Display Article </title>

	</head>

	<body>
	<div class="knowlege_base">
		<form method="post" action="#">

		<label for="title"> Title </label><input type="text" name="title" value="<?php echo htmlspecialchars($results[0]['title']); ?>">

		<label for="issue_category"> Caregory </label>
		<select name="category">
			<option value="option1" <?php if($results[0]['category'] == "option1") { echo "selected";} ?> > option 1 </option>
			<option value="option2" <?php if($results[0]['category'] == "option2") { echo "selected";} ?> > option 2 </option>
			<option value="option3" <?php if($results[0]['category'] == "option3") { echo "selected";} ?> > option 3 </option>
		</select>
		
			<label for="summary"> Summary of issue </label>
			<textarea cols="50" row="10" type="text" name="summary"> <?php echo htmlspecialchars($results[0]['summary']); ?> </textarea>

			<label for="solution"> Solution </label>
			 <textarea class="solution_textarea" name="solution"><?php echo htmlspecialchars($results[0]['solution']); ?> </textarea>

			 <input type="hidden" name="article_id" value="<?php echo $_GET['a_id'] ?>"> </input>


				<button type="submit" name="submit"> Add Article </button>
		</form>
	</div>
	</body>
<!-- 
TODO: Separate concernest at this point. maybe create another file for this part of the code.
 -->
<?php } else if(isset($_POST['submit'])) {

		//Getting ready to use that class method by calling the file that contains the class then creating a new instance of the class.
		require_once (ROOT_PATH . "inc/sql_queries.php");
		$sqlquery = new mysql();

		$article_id = $_POST['article_id'];
		$title =  $_POST['title'];
		$summary = $_POST['summary'];
		$category =  $_POST['category'];
		$solution =  $_POST['solution'];
		
		$sqlquery->update_article($article_id, $title, $summary, $category, $solution);
	} else {echo "Something went wrong. Eaither you didn't submit the form or you do not have some kind of get variable.";} ?>
</html>