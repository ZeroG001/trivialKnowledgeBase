<?php
require_once("connectvars.php");
require_once("config.php");

class mysql {
	
	/*
		Empty construct. I'm leaving it here just in case I forget how to make them

	function __construct() {
		//$this->dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	}

	*/


	//----------------------- Search the main knowledge Base -----------------------------
		function search_kb($criteria) {

	//Check to see if anything was entered before we pull information from the database
		if(trim($criteria) != "") {

			require(ROOT_PATH . "inc/database.php");

	try {
			$query="
		    SELECT article_id, title, CONCAT(SUBSTRING(solution ,LOCATE('<p>', solution) , locate('</p>', solution) + 3 ), '...') FROM knowlege_base
			WHERE title LIKE ? OR summary LIKE ? OR solution LIKE ?;";
			$results = $db->prepare($query);
			$results->bindValue(1,"%". $criteria . "%");
			$results->bindValue(2,"%". $criteria . "%");
			$results->bindValue(3,"%". $criteria . "%");
			$results->execute();
		} catch (Exception $e) {
			echo "There was an issue connecting to the database";
			echo "<pre>";
			var_dump($e);
			echo "</pre>";
			exit;
		}

		$results_array = $results->fetchAll(PDO::FETCH_ASSOC);	

			return $results_array;
			}
		}

		//This function searches for the criteria that was input in the input box then returns the results as an array
//@ INT Criteria
//@ Returns Array
function search_questions($criteria) {


	//Check to see if anything was entered before we pull information from the database
		if(trim($criteria) != "") {

			require(ROOT_PATH . "inc/database.php");

	try {
			$query="
		    SELECT question_id, question, CONCAT(SUBSTRING(answer ,LOCATE('<p>', answer) , locate('</p>', answer) + 3 ), '...') AS answer FROM knowlege_base_questions
			WHERE answer LIKE ? OR question LIKE ?;";
			$results = $db->prepare($query);
			$results->bindValue(1,"%". $criteria . "%");
			$results->bindValue(2,"%". $criteria . "%");
			$results->execute();
		} catch (Exception $e) {
			echo "There was an issue connecting to the database";
			echo "<pre>";
			var_dump($e);
			echo "</pre>";
			exit;
		}

		$results_array = $results->fetchAll(PDO::FETCH_ASSOC);	

			return $results_array;
			}

		}


		//-------------------------- Search the main knowlege base end --------------------------------------

		//This function returns an array
		function get_article_information($article_id) {

			require(ROOT_PATH . "inc/database.php");

			/*
				1.Select * from the database where the artile id = so and so
				2. Use a prepared statement to get the information.
				3. Put the information into an array I can read later on and know what I was doing.
			*/
		try {
				$query = "SELECT office_id, title, summary, category, solution FROM knowlege_base WHERE article_id = ? LIMIT 1;";
				$result = $db->prepare($query);
				$result->bindParam(1, $article_id, PDO::PARAM_INT);
				$result->execute();
			} catch (Exception $e) {
				echo "There was a problem querying the databsae.";
				exit;
			}

			$results = $result->fetchAll(PDO::FETCH_ASSOC);

			return $results;


		}


		//This function returns an array!
		function get_question_article_information($article_id) {
			/*
				1.Select * from the database where the artile id = so and so
				2. Use a prepared statement to get the information.
				3. Put the information into an array I can read later on and know what I was doing.
			*/

				require(ROOT_PATH . "inc/database.php");

				try {
				$query = "SELECT question_id, question, answer FROM knowlege_base_questions WHERE question_id = ? LIMIT 1;";
				$result = $db->prepare($query);
				$result->bindParam(1, $article_id, PDO::PARAM_INT);
				$result->execute();
			} catch (Exception $e) {
				echo "There was a problem querying the databsae.";
				exit;
			}

			$results = $result->fetchAll(PDO::FETCH_ASSOC);

			return $results;

		}


function update_article($article_id, $title, $summary, $category, $solution) {

	require_once("config.php");
	require_once(ROOT_PATH . "inc/database.php");


	try {

		$query = "UPDATE knowlege_base SET office_id = ?, title = ?, summary = ?, category = ?, solution = ? WHERE article_id = ?";
		$stmt = $db->prepare($query);
		$stmt->bindParam(1, $office_id);
		$stmt->bindParam(2, $title);
		$stmt->bindParam(3, $summary);
		$stmt->bindParam(4, $category);
		$stmt->bindParam(5, $solution);
		$stmt->bindParam(6, $article_id);
		$stmt->execute();
	} catch (Exception $e) {
		echo "Could not query the database";
		exit;
	}

	header("location:" . BASE_URL ."thank-you.php");

}


function update_question($question, $solution, $question_id) {

	require_once("config.php");
	require_once(ROOT_PATH . "inc/database.php");

	try {

	$query = "UPDATE knowlege_base_questions SET question = ?, answer = ? WHERE question_id = ?";
		$stmt = $db->prepare($query);
		$stmt->bindParam(1, $question);
		$stmt->bindParam(2, $solution);
		$stmt->bindParam(3, $question_id);
		$stmt->execute();

	} catch (Exception $e) {

		echo "There was something wrong querying the database";
		exit;
	}

	header("location:" . BASE_URL ."thank-you.php");
}
		//add new function here

	function add_article($category, $title, $summary, $solution) {

		require("config.php");
		require(ROOT_PATH . "inc/database.php");

	date_default_timezone_set('US/Eastern');

	try {
			$query = "INSERT INTO knowlege_base (title, summary, category , solution) VALUES (?,?,?,?)";
			$stmt = $db->prepare($query);
			$stmt->bindParam(1, $title);
			$stmt->bindParam(2, $summary);
			$stmt->bindParam(3, $category);
			$stmt->bindParam(4, $solution);
			$stmt->execute();

		} catch (Exception $e) {

			echo "There was an issue with the database";
			exit;

		}

		header("location:" .BASE_URL . "thank-you.php");
	}

	function add_question($question, $category, $solution) {

		require("config.php");
		require(ROOT_PATH . "inc/database.php");


	try {
			$query = "INSERT INTO knowlege_base_questions (question, answer) VALUES (?,?);";
			$stmt = $db->prepare($query);
			$stmt->bindParam(1, $question);
			$stmt->bindParam(2, $solution);
			$stmt->execute();

		} catch (Exception $e) {

			echo "There was an issue with the database";
			exit;

		}

		header("location:" . BASE_URL . "thank-you.php");

	}

	/*f
	 * This was taken out so that everything work with the new PHP Data Object Class;
	
	function __destruct() {
		mysqli_close($this->dbc);
		$this->dbc = null;
		}
	*/

}

?>