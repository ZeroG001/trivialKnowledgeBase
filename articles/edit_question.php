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
	<title> Blayne's Trivial Knowlege base </title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>css/normalize.css">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>css/knowlege_base.css">
	<script type="text/javascript" src="<?php echo BASE_URL ?>inc/tinymce/tinymce.min.js"></script>
	<script type="text/javascript">
	tinymce.init({

	selector:'textarea.answer_textarea',

	 plugins: [
	"advlist autolink lists link image charmap print preview anchor",
	"searchreplace visualblocks code fullscreen",
	"insertdatetime media table contextmenu paste jbimages"
	],

	 plugins: [
	"advlist autolink lists link image charmap print preview anchor",
	"searchreplace visualblocks code fullscreen",
	"insertdatetime media table contextmenu paste jbimages"
	],

	relative_urls: false

	 });

	</script>
	</head>


	<body>
	
	<div class="knowlege_base">
		<form method="post" action="#">

		<label for="question"> Question </label><input type="text" name="question" maxlength="150" value="<?php echo htmlspecialchars($results[0]['question']); ?>">

		<label for="issue_category"> Caregory </label>

		<select name="category">
			<option value="option1"> option 1 </option>
			<option value="option2"> option 2 </option>
			<option value="option3"> option 3 </option>
		</select>
		

			<label for="solution"> Solution </label>
			 <textarea class="answer_textarea" name="solution"><?php echo htmlspecialchars($results[0]['answer']); ?></textarea>
			 <input type="hidden" name="question_id" value="<?php echo $results[0]['question_id']; ?>">

			<button type="submit" name="submit" value="submit"> Add Article </button>
		</form>
	</div>

	</body>

	<?php } else if(isset($_POST['submit'])) {

		//Getting ready to use that class method by calling the file that contains the class then creating a new instance of the class.
		require_once (ROOT_PATH . "inc/sql_queries.php");
		$sqlquery = new mysql();

		$question = $_POST['question'];
		$solution = $_POST['solution'];
		$question_id =  $_POST['question_id'];
		
		$sqlquery->update_question($question, $solution, $question_id);
	} else {echo "Something went wrong. Eaither you didn't submit the form or you do not have some kind of <code> GET </code> variable.";} ?>

</html>


