<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Jeopardy</title>
		<meta charset="utf-8">
		<style>
			body {
				background-color: black;
			}
			
			table {
				width: 100%;
				border-collapse: collapse;
			}
			
			th {
				background-color: blue;
				color: white;
				font-family: sans-serif;;
				font-size: 24px;
				text-align: center;
				vertical-align: middle;
				width: 20%;
			}

			td {
				background-color: black;
				color: white;
				font-family: Arial;
				font-size: 36px;
				text-align: center;
				vertical-align: middle;
				padding: 5px;
			}
			
			td img {
				width: 100%;
				height: 100%;
				object-fit: cover;
				display: block;
			}

			td:hover {
				background-color: yellow;
			}
			
			p {
				color: white;
			}
		</style>
		<?php
			// Get the team names from the superglobal variable $_GET
			//$team1 = $_GET["team1"]; // Uncomment this code when $_GET is implemented
			//$team2 = $_GET["team2"]; // Uncomment this code when $_GET is implemented
			$team1 = "blue"; // Placeholder, remove when $_GET is implemented
			$team2 = "red"; // Placeholder, remove when $_GET is implemented

			// Define the categories and the money values as arrays
			$categories = array("Movies", "Computer Science", "Sports", "History", "Music");
			$money = array(200, 400, 600, 800, 1000);

			// Create a table to display the board
			echo "<table border='1'>";
			// Loop through the categories and display them as table headers
			echo "<tr>";
			foreach ($categories as $category) {
				echo "<th>$category</th>";
			}
			echo "</tr>";
			// Loop through the money values and display them as table cells with links to the question page
			foreach ($money as $value) {
				echo "<tr>";
				foreach ($categories as $category) {
					// Use the category and value as query parameters for the question page
					echo "<td><a href='question.php?category=$category&value=$value'><img src=\"./img/".$value."Dollars.png\"></a></td>";
				}
				echo "</tr>";
			}
			echo "</table>";

			// Display the team names and their scores
			echo "<p>Team 1: $team1</p>";
			echo "<p>Team 2: $team2</p>";
		?>
	</head>
	<body>
	</body>
</html>