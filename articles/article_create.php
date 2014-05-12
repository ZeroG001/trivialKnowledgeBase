<?php
	require("../inc/config.php");

  if($_SERVER["REQUEST_METHOD"] == "POST") {
  	require_once(ROOT_PATH . "inc/sql_queries.php");

	$category = $_POST['category'];
	$title = $_POST['title'];
	$summary = $_POST['summary'];
	$solution = $_POST['solution'];

  	$queries = new mysql;

  	$queries->add_article($category, $title, $summary, $solution); 
  	exit;
  }


?>

<!DOCTYPE html>
<html>
	<head>
	<title> Blayne's Trivial Knowlege base </title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>css/knowlege_base.css">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>css/normalize.css">
	<script type="text/javascript" src="<?php echo BASE_URL ?>inc/tinymce/tinymce.min.js"></script>
	<script type="text/javascript">
	tinymce.init({

	selector:'.solution_textarea',

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

		<label for="title"> Title </label><input type="text" name="title" id="title">

		<label for="issue_category"> Caregory </label>
		<select name="category">
			<option value="option1"> option 1 </option>
			<option value="option2"> option 2 </option>
			<option value="option3"> option 3 </option>
		</select>
		

	 <label for="officedropdown">  Office </label> <select id="officedropdown" name="officedropdown">
			<option value=0 selected>0 Corporate</option> 
			<option value=5> 5 Dearborn </option>
			<option value=7> 7 Livonia </option>
			<option value=13> 13 Commerce </option>
			<option value=15> 15 Milford </option>
			<option value=17> 17 Southfield / Lathrup Village </option>
			<option value=21> 21 Southgate </option>
			<option value=23> 23 Plymouth/Canton </option>
			<option value=24> 24 Brighton </option>
			<option value=27> 27 Clinton Township </option>
			<option value=28> 28 Royal Oak </option>
			<option value=31> 31 Ann Arbor </option>
			<option value=32> 32 Fraser </option>
			<option value=34> 34 Troy </option>
			<option value=35> 35 Clarkston/Waterford </option>
			<option value=39> 39 Rochester </option>
			<option value=42> 42 Grosse Pointe - JJ </option>
			<option value=43> 43 Dexter </option> 
			<option value=45> 45 West Bloomfield </option>
			<option value=51> 51 Novi </option>
			<option value=56> 56 Bloomfield Hills - Max Broock </option>
			<option value=57> 57 Clarkston - Max Broock Realtors </option>
			<option value=58> 58 Birmingham - Max Broock Realtors </option>
			<option value=59> 59 Rochester - Max Broock Realtors </option>
			<option value=72> 72 St. Clair Shores </option>
			<option value=73> 73 Dearborn Heights  - Ford Road </option>
			<option value=74> 74 Shelby Twp </option>
			<option value=78> 78 Milan </option>
			<option value=79> 79 Saline </option>
		</select> 
		
		<div class="tiny_textarea">
			<label for="summary"> Summary of issue </label>
			<textarea cols="50" row="10" type="text" name="summary" id="summary" class="solution_textarea"> </textarea>
		</div>

		<div class="tiny_textarea">
			<label for="solution"> Solution </label>
			 <textarea class="solution_textarea" name="solution" id="solution"></textarea>
		</div>

			<button type="submit" name="submit"> Add Article </button>
		</form>
	</div>

	</body>

</html>


