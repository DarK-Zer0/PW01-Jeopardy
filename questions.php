<!DOCTYPE html>
<html lang="en">
    <head>
		<title>Jeoparody</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="styles.css">
		<?php
            session_start(); // Resumes the session
            $_SESSION['answered'][] = $category . $value; // Clears choice from the main board

            $movies = array(
                "($200) Which popular comic book character has had the most live-action portrayals?",
                "($400) This director has 3 separate movies listed in the top-10 highest grossing movies?",
                "($600) This actor tragically died on set while shooting a scene for 1990's action movie The Crow",
                "($800) Which film in the Friday the 13th franchise did Jason get his iconic hockey mask?",
                "($1000) Who is the main antagonist of the children's animated movie Coraline?"
                );
            $compScience = array();
            $sports = array();
            $history = array();
            $music = array();

            $category = $_GET['category']; // Grab the topic chosen
            $value = $_GET['value']; // Grab the quantity of money chosen
        ?>
    </head>
    <body>
        <?php

        ?>
    </body>
</html>