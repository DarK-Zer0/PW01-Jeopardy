<!DOCTYPE html>
<html lang="en">
    <head>
		<title>Q&A - Jeopardy</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="styles.css">
		<?php
            session_start(); // Resumes the session

            // The Questions
            $movies = array(
                "($200) Which popular comic book character has had the most live-action portrayals?",
                "($400) This director has 3 separate movies listed in the top-10 highest grossing movies?",
                "($600) This actor tragically died on set while shooting a scene for 1990's action movie The Crow",
                "($800) Which film in the Friday the 13th franchise did Jason get his iconic hockey mask?",
                "($1000) Who is the main antagonist of the children's animated movie Coraline?"
                );
            $compScience = array(
				"($200) What is the name of the most common operating system?",
                "($400) What is the name of the process that converts human-readable code into machine-readable code?",
                "($600) What are the keyboard shortcuts for copy and pasting?",
                "($800) What is the name of the algorithm that sorts an array by repeatedly finding the minimum element and placing it at the beginning?",
                "($1000) What is the term for a computer program that can replicate itself and spread to other devices?"
				);
            $sports = array(
				"($200) Who was named the Most Valuable Player (MVP) of the NBA Finals in 2021?",
                "($400) Which team won the NCAA Men's Basketball Championship in 2021?",
                "($600) Which team won the UEFA Champions League in the 2020-2021 season?",
                "($800) Who was the top scorer in the UEFA Euro 2020 tournament?",
                "($1000) Which team had the best regular season record in the 2020 NFL season?"
            );
            $history = array(
				"($200) What was the first successful English colony in North America established by the Virginia Company of London?",
                "($400) Who was the English polymath that invented the first mechanical computer?",
                "($600) Which nineteenth century anarchist established the American Mail Letter Company?",
                "($800) In the Battle of Adwa, what African country famously defeated Italy's colonial forces?",
                "($1000) What 630-foot-tall stainless steel monument honors frontiersmen and pioneers?"
            );
            $music = array(
				"($200) What genre of music did Taylor Swift originally come from?",
                "($400) Who was the first rap artist to win a Grammy award?",
                "($600) Who is the lead singer of the American rock band Evanescence?",
                "($800) What is the name of 50 Cent's debut studio album?",
                "($1000) In which state of America was John Lennon of The Beatles assassinated?"
            );
			
			// The Correct Answers	
			$moviesAnswers = array(
                "($200) Batman",
                "($400) James Cameron",
                "($600) Brendon Lee",
                "($800) Friday the 13th: Part III",
                "($1000) The Beldam / The Other Mother"
            );
            $compScienceAnswers = array(
				"($200) Microsoft Windows",
                "($400) Compilation / Compiling",
                "($600) Ctrl + C & Ctrl + V",
                "($800) Selection Sort",
                "($1000) Virus"
			);
            $sportsAnswers = array(
				"($200) Giannis Antetokounmpo (Milwaukee Bucks)",
                "($400) Baylor University Bears",
                "($600) Chelsea FC (England)",
                "($800) Cristiano Ronaldo (Portugal)",
                "($1000) Green Bay Packers (13-3 record)"
            );
            $historyAnswers = array(
				"($200) Jamestown",
                "($400) Charles Babbage",
                "($600) Lysander Spooner",
                "($800) Ethiopia",
                "($1000) Gateway Arch"
            );
            $musicAnswers = array(
				"($200) Country",
                "($400) Eminem",
                "($600) Amy Lee",
                "($800) Get Rich or Die Tryin'",
                "($1000) New York"
            );
			
            $category = $_GET['category']; // Grabs the topic chosen
            $value = $_GET['value']; // Grabs the money value chosen
			$index = ($value / 200) - 1; // Grabs the index of the question listed under the money value chosen
            $team = $_SESSION['team' . $_SESSION['turn']]; // Grabs the team who's turn it is (team1 = left team, team2 = right team)
            $_SESSION['answered'][] = $category . $value; // Clears choice from the main board
		?>
    </head>
    <body id="questions">
        <?php
            if (!isset($_GET['display'])) {
                // Saves the value of the question
                $_SESSION['value'] = $value;

                // Shows corresponding question
                if ($category == "Movies") {
                    echo "<p class=\"qna\">$movies[$index]</p>";
                    $_SESSION['ans'] = $moviesAnswers[$index];
                } else if ($category == "Computer Science") {
                    echo "<p class=\"qna\">$compScience[$index]</p>";
                    $_SESSION['ans'] = $compScienceAnswers[$index];
                } else if ($category == "Sports") {
                    echo "<p class=\"qna\">$sports[$index]</p>";
                    $_SESSION['ans'] = $sportsAnswers[$index];
                } else if ($category == "History") {
                    echo "<p class=\"qna\">$history[$index]</p>";
                    $_SESSION['ans'] = $historyAnswers[$index];
                } else if ($category == "Music") {
                    echo "<p class=\"qna\">$music[$index]</p>";
                    $_SESSION['ans'] = $musicAnswers[$index];
                }

                // Prompts user to show the correct answer
                echo "<div class=\"reveal\">";
                echo    "<a href='questions.php?display=y'>Answer</a>";
                echo "</div>";
            } else {
                // Regrabs important variable values
                $answer = $_SESSION['ans'];
                $value = $_SESSION['value'];

                // Prompts user to verify if answer was correct
                echo "<p class=\"qna\">$answer</p>";
                echo "<div class=\"validation\">";
                echo    "<p>Did $team's Team get it right?</p>";
                echo    "<a href=\"mainBoard.php?result=$value\"><img src=\"./img/checkmark.png\"></a>";
                echo    "<a href=\"mainBoard.php?result=0\"><img src=\"./img/cross.png\"></a>";
                echo "</div>";
            }
        ?>
    </body>
</html>