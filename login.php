<?php
 session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Jeoparody - Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="login_style.css">
    <!-- Additional meta tags, CSS links, or JavaScript links can be added here -->
</head>
<body>
     <?php
	  
	    $username= $usernameErr = "";
	   $password= $passwordErr= "";
       $usr_n_passErr = "";

       // Pre-made accounts
       $hc_users = array(
          "Indra"=>"zer0",
          "Marcus"=>"pass2",
          "Nathnael"=>"pass3",
          "Zian"=>"pass4"
       );
	
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			
			
		if (empty($_POST["username"])) {
               $usernameErr = "Name is required";	   
                } 
		
		if (!preg_match("/^[A-Za-z_]\w*$/",$_POST['username'])) {
                $usernameErr = "*Only letters,numbers and underscore are allowed. Can not start with a number.";
                } else {
               $username = $_POST["username"];
               } 
			if (empty($_POST["password"])) {
               $password = "password is required";
            } 

             if (!preg_match("/^[A-Za-z_0-9$][A-Za-z0-9_#*$]*$/",$_POST['password'])) {
				$passwordErr = "*wrong password pattern.";
	     } else {
				$password = $_POST["password"];
             }
            if (isset($hc_users[$username]) && $hc_users[$username] === $password) {
                header("Location: group.php");
                exit;
           } else {
               $usr_n_passErr= "*Incorrect username or password";
            }
		}	 
	 
	 ?>
      <h1 class= "login_header"> Login </h1>
	 <form  method="post" action= " <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> ">
	 <div class="login_fields">
  
     <div class="usr_n_span">
    
       <label class="label" for="u_name">username    </label> 
     <input class="input" type="text" id="u_name" name="username" required> 
      
	  <span class= "error">  <?php echo $usernameErr; ?> </span> <br>
    </div>
    
     <div class="pass_n_span">
    
	<label class="label" for="pass"> password </label>
     <input class="input" type="password" id="pass" name="password"  required > 
	 <span class= "error">  <?php echo $passwordErr; ?> </span> <br>
    </div>

     <div class= "submit_align">
	 <input type= "submit"><br>
    
     </div>
     <div class="mistake"> 
     <span> <?php echo $usr_n_passErr; ?> </span> <br>
    </div>
	 </div>
	</form>
</body>
</html>
