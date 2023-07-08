<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>JavaScript Form validation</title>
<link rel="stylesheet" href="styles.css">

<?php

session_start();

function validateForm() {
    $usernameNew = $_SESSION['username'];
    $passwordNew = $_SESSION['password'];
	
	/* Pre-made Accounts */
	$usernames = array("indra","marcus","nathnael","zian");
	$passwords = array("zer0","pass2","pass3","pass4");

	array_push($usernames,$usernameNew);
	array_push($passwords,$passwordNew);
	
	$_SESSION['usernames'] = $usernames;
	$_SESSION['passwords'] = $passwords;

}

validateForm();
	
?>

</head>

<body>


<?php

	$userTest = $_SESSION['usernames'];
	$passwordTest = $_SESSION['passwords'];
	

		print_r ($userTest);
		
		echo json_encode ($passwordTest);

?>


</body>

</html>