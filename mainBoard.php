
/* 							
				Temporary Code will be deleted when $_GET functionality is added from the homepage.
				Add the following to the end of your URL to test $_GET functionality: 
					?team1=Left&team2=Right
*/
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Jeoparody</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="styles.css">
		<?php
			session_start(); // Starts/Resumes the session

			// Game Set Up
			if (isset($_GET['team1']) && isset($_GET['team2'])) {
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
				$gameOver = false;

				/* (---- Temporary Code */
				$_SESSION['temp'] = true;
				/* Temporary Code ----) */
			} else { // Grabs the on-going game data
				/* (---- Temporary Code */
				if (!$_SESSION['temp']) { // Prevents values from resetting when returning from questions.php
					$team1 = "Blue";
					$team2 = "Red";

					$_SESSION['team1'] = $team1;
					$_SESSION['team2'] = $team2;

					$_SESSION['score1'] = 0;
					$_SESSION['score2'] = 0;
					$_SESSION['answered'] = array();
					$_SESSION['turn'] = 1;
					$gameOver = false;

					$_SESSION['temp'] = true;
				}
				/* Temporary Code ----) */

				$team1 = $_SESSION['team1'];
				$team2 = $_SESSION['team2'];
			}

			if (isset($_GET['result'])) { // Adds the result to the score and changes who's turn it is
				if ($_SESSION['turn'] == 1) {
					$_SESSION['score1'] += $_GET['result'];
					$_SESSION['turn'] = 2;
				} else {
					$_SESSION['score2'] += $_GET['result'];
					$_SESSION['turn'] = 1;
				}
			}

			if (count($_SESSION['answered']) == 25) { // When all questions have been attempted
				if ($_SESSION['score1'] > $_SESSION['score2']) { // Team 1 has the most money
					$tie = false;
					$winner = $team1;
				} else if ($_SESSION['score2'] > $_SESSION['score1']) { // Team 2 has the most money
					$tie = false;
					$winner = $team2;
				} else { // Team 1 & 2 have the same amount of money
					$tie = true;
				}
			}
		?>
	</head>
	<body id="mainboard">
		<?php
			if (!$gameOver) {
				if ($_SESSION['turn'] == 1) {
					echo "<div class=\"turn\">";
					echo 	"<p>It is $team1 Team's turn.</p>";
					echo "</div>";
				} else {
					echo "<div class=\"turn\">";
					echo 	"<p>It is $team2 Team's turn.</p>";
					echo "</div>";
				}

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
			} else {
				echo "<div class=\"victory\">";
				if (!$tie) { // Checks if there was a tie.
					echo "<p>Congratulations, $winner Team wins!</p>";
				} else {
					echo "<p>Wow that was a close game! It's a tie!</p>";
				}
				echo "</div>";
			}
		?>
	</body>
</html>