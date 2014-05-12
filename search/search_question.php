<?php

require("../inc/config.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	require_once(ROOT_PATH . 'inc/sql_queries.php');

	$criteria = $_POST["question"];

	$sql_search = new mysql;

	//search_questions returns array containing array['question_id#']['question']; # being the array numbr. I may change this to just use a numver
	$results = $sql_search->search_questions($criteria);
}
?>

<!DOCTYPE html>
<html>
	<head>
	<title> Search a question </title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href='http://fonts.googleapis.com/css?family=Average+Sans' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>css/normalize.css">
	<link rel='stylesheet' type='text/css' href='<?php echo BASE_URL ?>css/search.css'>
		<script type="text/javascript" src="<?php echo BASE_URL ?>inc/jquery.js"></script>
		<script type="text/javascript">
			$("document").ready(function(){

				$(".search_results").hide();
				$(".search_results").slideDown("slow");
	});

	</script>
	</head>

	<body>
												<!--  Search Bar  -->
		<div class="search_wrapper">
			<form action="#" method="post">
				<div class="search_input">
					<p class="header1"> Trivial Questions </p>
					<input type="text" name="question" placeholder="Search for it!" value="<?php if(isset($_POST['question'])) {echo $_POST['question'];}?>">
					<button type="submit" value="submit">Search</button>
					<div class="back_box"><a href="<?php echo BASE_URL ?>index.html"> Back </a> </div>
			</div>
		</form>
									<!-- Search Bar End -->


		<!-- This area displays the results of the page. For this I have decided to embedd PHP code in the html. I have tried separating the PHP code from the HTML code -->

			<?php if(isset($criteria) && trim($criteria) != "") { ?>

			<div class="search_results">

						<!-- If there are results, display them here -->

			<p> Your Search returned <?php echo count($results); ?> results </p>

			<?php

			foreach ($results as $result) {
				echo "<div class='result_title'><a href='". BASE_URL ."articles/view_question/". $result["question_id"] . "/'>" . $result["question"] . "</a></div>";
				echo "<div class='edit_title'><a href='". BASE_URL ."articles/edit_question/". $result["question_id"] . "/'> Edit Question </a></div>";
				echo $result["answer"] . "<br>";
			}

			?>

			</div>


								<!-- end display -->

			<!-- If nothing is entered, say "enter a search criteria" -->

			<?php } else if (isset($criteria) && trim($criteria) == "") { ?>

			<p> <span style='color:red'>Please Enter a seach criteria </span> </p>

			<!-- If no results are returned, say "no results returned" -->

			<?php } else if (isset($criteria) && empty($result)) { ?>

		 	<p class='no_results'> there were no results </p>

		 	<?php exit(); }  ?>
		</div>
	</body>
	
</html>
