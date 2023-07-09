<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Set up Teams</title>
    <link rel="stylesheet" href="group_style.css">
</head>
<body>
<?php
   

    // Define variables to store group information
    $group1Name = $group1Err = "";
    $group2Name = $group2Err = "";
    
    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
           if(empty($_POST["group1Name"])){
             $group1Err = "*name is required";
           }elseif (!preg_match("/^[A-Za-z0-9_ ]+$/",$_POST["group1Name"])) {
            $group1Err = "*Only letters,numbers and underscore are allowed.";
           }else{
                 $group1Name = $_POST["group1Name"];
                 $_SESSION["group1Name"] = $group1Name;
           }


           if(empty($_POST["group2Name"])){
            $group2Err = "*name is required";
          }elseif (!preg_match("/^[A-Za-z0-9_ ]+$/",$_POST["group2Name"])) {
           $group2Err = "*Only letters,numbers and underscore are allowed.";
          }else{
                $group2Name = $_POST["group2Name"];
                $_SESSION["group2Name"] = $group2Name;
          }
         
          if (empty($group1Err) && empty($group2Err) ) {
            // No errors, proceed with signup process
            header("Location: mainBoard.php");
            exit;
        }

     }
?>
  
  <div class= "main_class" >
     
  <div class= "team_header">
    <h2>Group 1</h2>
    </div>
    
    <form method="post" action="group.php">
        <div class= "group_fields">
        <div class="g1name_n_span">
  
        <label class="label">Name:</label>
        <input class="input" type="text" name="group1Name" required>
        <span class= "error">  <?php echo $group1Err; ?> </span> <br>
    </div>
      
     <div class="center_header team_header">
        <h2> Group 2 </h2>
    </div>
    
        <div class="g2name_n_span">
        <label class="label" >Name:</label>
        <input class="input" type="text" name="group2Name" required>
        <span class= "error">  <?php echo $group2Err; ?> </span> <br>
    </div>
    <div class= "submit_align">
        <input type="submit" name="G2submit" value="Set up Teams">
    </div>
       </form>

   
    
</body>
</html>