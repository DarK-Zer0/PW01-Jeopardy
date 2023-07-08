
<!-- 							
				Temporary Code will be deleted when $_GET functionality is added from the homepage.
				Add the following to the end of your URL to reset the session: 
					?team1=Good&team2=Evil
-->
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Jeoparody - Board</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="styles.css">
		<?php
			session_start(); // Starts/Resumes the session

			// Game Set Up
			if (isset($_GET['start'])) {
				// Grab team names from user input
				$team1 = $_SESSION["group1Name"];
				$team2 = $_SESSION["group2Name"];
				
				// Store team names until game ends
				$_SESSION['team1'] = $team1;
				$_SESSION['team2'] = $team2;

				// Initialize the scores and values of categories answered as empty arrays
				$_SESSION['score1'] = 0;
				$_SESSION['score2'] = 0;
				$_SESSION['answered'] = array();
				$_SESSION['choices'] = 25;
				$_SESSION['turn'] = 1;
				$_SESSION['gameOver'] = false;
			} else { // Reload the team names
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

			if ($_SESSION['choices'] == 0) { // When all questions have been attempted
				$score1 = $_SESSION['score1'];
				$score2 = $_SESSION['score2'];
				if ($score1 > $score2) { // Team 1 has the most money
					$tie = false;
					$gameOver = true;
					$winner = $team1;
				} else if ($score2 > $score1) { // Team 2 has the most money
					$tie = false;
					$gameOver = true;
					$winner = $team2;
				} else { // Team 1 & 2 have the same amount of money
					$tie = true;
					$gameOver = true;
				}
			}
		?>
	</head>
	<body id="mainboard">
		<?php
			$endgame = $_SESSION['gameOver'];
			if (!$endgame) {
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
				session_destroy();
			}
		?>
	</body>
</html>