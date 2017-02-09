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

	<h1>Register</h1>
	<article>
	<form name="Register" action="customer_formR.php" method="post">
		<table align="center"><tr><td>Email*</td><td><input type="text" name="username" value="<?php echo $_SESSION["customer_email"]?>" readonly> </td></tr>
		<tr><td>Password*</td><td><input type="password" name="password"></td></tr>
		<tr><td></td><td><input type="submit" value="Register"> </td></tr>
		<tr><td colspan="2"><br/>Please give the rest of your details. Items marked * must be given.</td></tr></table>
	</form>
	</article>
	

</body>
</html>