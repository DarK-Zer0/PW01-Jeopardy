<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Jeoparody</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="styles.css">
		<?php
			session_start(); // Starts/Resumes the session

			// Game Set Up
			if (isset($_GET['team1']) && isset($_GET['team2'])) { // Sets up the game data
				// Grab team names from user input
				$team1 = $_GET["team1"];
				$team2 = $_GET["team2"];
				
				// Store team names until game ends
				$_SESSION['team1'] = $team1;
				$_SESSION['team2'] = $team2;

				// Initialize the scores and values of categories answered as empty arrays
				$_SESSION['score1'] = 0;
				$_SESSION['score2'] = 0;
				$_SESSION['answered'] = array();
				$_SESSION['turn'] = 1;
			} else { // Grabs the on-going game data
				// Delete everything betweeen TEMP when $_GET is implemented
				/* TEMP */
				$team1 = "Blue";
				$team2 = "Red";

				$_SESSION['team1'] = $team1;
				$_SESSION['team2'] = $team2;

				$_SESSION['score1'] = 0;
				$_SESSION['score2'] = 0;
				$_SESSION['answered'] = array();
				$_SESSION['turn'] = 1;
				/* TEMP */

				$team1 = $_SESSION['team1'];
				$team2 = $_SESSION['team2'];
			}

			if (isset($_GET['result'])) {
				if ($_SESSION['turn'] == 1) {

					$_SESSION['turn'] = 2;
				} else {
					$_SESSION['turn'] = 1;
				}
			}
		?>
	</head>
	<body id="mainboard">
		<?php
			// Display the team names and their scores
			$score1 = $_SESSION['score1'];
			$score2 = $_SESSION['score2']; 
			echo "<div class=\"scoreboard\">";
			echo		"<table>";
			echo			"<tr>";
			echo				"<th>&nbsp;$team1's Team&nbsp;</th>";
			echo				"<th>&nbsp;$team2's Team&nbsp;</th>";
			echo			"</tr>";
			echo			"<tr>";
			echo				"<td>\$$score1</td>";
			echo				"<td>\$$score2</td>";
			echo			"</tr>";
			echo 		"</table>";
			echo "</div>";

			// Define who's turn it is, the categories and the money values
			$turn = $_SESSION['turn'];
			$categories = array("Movies", "Computer Science", "Sports", "History", "Music");
			$money = array(200, 400, 600, 800, 1000);

			// Create a table to display the board
			echo "<div class=\"gameboard\">";
		 	echo 	"<table>";
			// Loop through the categories and display them as table headers
			echo 		"<tr>";
			foreach ($categories as $category) {
				echo 		"<th>$category</th>";
			}
			echo 		"</tr>";
			// Loop through the money values and display them as table cells with links to the question page
			foreach ($money as $value) {
				echo 	"<tr>";
				foreach ($categories as $category) {
					// Use the category and value as query parameters for the question page
					echo 	"<td>";
					// Check if the category and value have been answered before
					if (!in_array($category . $value, $_SESSION['answered'])) {
						// If no, display the image
						echo 	"<a href='questions.php?category=$category&value=$value'><img src=\"./img/".$value."Dollars.png\"></a>";
					} else {
						// if yes, display blank image
						echo 	"<img src=\"./img/answered.png\">";
					}
					echo 	"</td>";
				}
				echo 	"</tr>";
			}
			echo 	"</table>";
			echo "</div>";
		?>
	</body>
</html>