<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
        <title>Pizza Hat</title>
		<link rel="stylesheet" type="text/css" href="customer.css" />
</head>

<body>
	<?php include 'topbar.php'; ?>
	
	<?php
		$_SESSION["customer_email"] = NULL;
	?>
	<h1>Register</h1>
	<article>
	<table align="center">
	<?php	if (isset($_SESSION["email_error"])) {
				echo "<tr><td colspan='2'><font color='#E71E1E'>".$_SESSION["email_error"]."</font></td></tr>";
				unset($_SESSION["email_error"]);
			} ?>
	<form name="Login" action="email_exists.php" method="post">
		<tr><td>Email: </td><td> <input type="text" name="username"> </td></tr>
		<tr><td></td><td> <input type="submit" value="Register"> </td></tr></table>
	</form>
	
	<p align="center">Input the email you'd like to use.</p>
	</article>
	

</body>
</html>