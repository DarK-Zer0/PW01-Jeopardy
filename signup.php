<?php
 session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Jeoparody - Signup</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="signup_styles.css">
    <!-- Additional meta tags, CSS links, or JavaScript links can be added here -->
</head>
<body>
    <?php
	
	 $username= $usernameErr = "";
	 $email = $emailErr ="";
	 $password= $passwordErr= "";

	 
	
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			
			
			if (empty($_POST["username"])) {
               $usernameErr = "*Name is required"; 
			
            }elseif (!preg_match("/^[A-Za-z_][A-Za-z0-9_]*$/",$_POST["username"])) {
					$usernameErr = "*Only letters,numbers and underscore are allowed. Can not start with a number.";
			
			}else{
				$username = $_POST["username"];
				$_SESSION["username"] = $username;
			}

			 


			if (empty($_POST["email"])) {
				$emailErr = "*Email is required";
				
			}elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
				$emailErr = "*Invalid email format";
				
			}else{
				$email = $_POST["email"];
				$_SESSION["email"] = $email;

			}
			
			
			if (empty($_POST["password"])) {
               $password = "*password is required";
			  
            }elseif (!preg_match("/^[A-Za-z_0-9$][A-Za-z0-9_#*$]*$/",$_POST["password"])) {
					$passwordErr = "*Only letters,numbers and underscore are allowed.";
					
			} else{
				
				 	$password = $_POST["password"];
					$_SESSION["password"] = $password;

			      }

			
			
			if (empty($usernameErr) && empty($emailErr) && empty($passwordErr)) {
				// No errors, proceed with signup process
				header("Location: group.php");
				exit;
			}
			 
			
        }
	?>
	 <div class="main_class"> 
     <div class="center_header">
	 <div class="signup_header"> 
		<p> Sign up <p>
	</div>
	</div>
	<form class="form" method="post" action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> ">
   
	<div class = "signup_fields">
	<div class ="usr_n_span">
	
		
	  <label> username </label>
		
      <input type="text" name="username" required> 
	
	 <span class= "error">  <?php echo $usernameErr; ?> </span> <br>
	</div>
	<div class ="eml_n_span">
	

	<label > Email  </label>

	 <input type="text" name="email" > 
	
  		<span class= "error">  <?php echo $emailErr; ?> </span> <br>
	</div>
	<div class ="pass_n_span">
	
		
	<label > password  </label>
		 <input type="password" name="password"  required>
	
	
	  <span class= "error">  <?php echo $passwordErr; ?> </span> <br>
	</div>
	<div class= "submit_align">
	 <input type= "submit"><br>
    
     </div>
	 </div>

	
	</form>
	</div>
	 
</body>
</html>

