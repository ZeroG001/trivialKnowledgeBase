<?php
	require("../inc/config.php");

  if($_SERVER["REQUEST_METHOD"] == "POST") {
  	requre_once(ROOT_PATH . "inc/sql_queries.php");

	$question = $_POST['question'];
	$category = $_POST['category'];
	$solution = $_POST['solution'];


  	$queries = new mysql();

  	$queries->add_article($question, $category, $solution); 
  }



?>


<!DOCTYPE html>
<html>
	<head>
	<title> Blayne's Trivial Knowlege base </title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>css/knowlege_base.css">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>css/normalize.css">
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
		<form method="post" action="<?php echo BASE_URL ?>inc/add_question_article.php"> <!-- TODO have this link to a separate pgae. --> 

		<label for="question"> Question </label><input type="text" name="question" maxlength="150">

		<label for="issue_category"> Caregory </label>

		<select name="category">
			<option value="option1"> option 1 </option>
			<option value="option2"> option 2 </option>
			<option value="option3"> option 3 </option>
		</select>
		

			<label for="solution"> Solution </label>
			 <textarea class="answer_textarea" name="solution"></textarea>

			<button type="submit" name="submit"> Add Article </button>
		</form>
	</div>

	</body>

</html>


