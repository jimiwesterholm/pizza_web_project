<?php
session_start();	//Need this at the beginning of every file that uses session variables
?>

<!DOCTYPE html>
<html>
<head>
        <title>Pizza Hat - Staff</title>
		<link rel="stylesheet" type="text/css" href="staffa.css" />
</head>

<body>
	
        <?php
            $_SESSION["loggedin"] = NULL;
            $_SESSION["role"] = NULL;
            $_SESSION["branch"] = NULL;
        ?>
    
	
		<h1 style="margin-left:20%"> Pizza Hat - Staff Log In  </h1>
	
	
	<form name="Login" action="formLG.php" method="post" >
		Employee ID Number: <br><input type="text" name="username"> <br> 
		Password: <br><input type="password" name="password" > 
		<input type="submit" value="Login"> <br>
	</form>
	
	
	
	<p style="margin-left:20%" style="margin-top:30%"> If you don't know your log-in details, please contact your manager.</p>
	

</body>
</html>