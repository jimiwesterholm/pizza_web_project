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

	<h1>Login</h1>
	<article>
	<?php
		$_SESSION["customer_login"] = NULL;
		$_SESSION["customer_email"] = NULL;
	?>
	
	<form name="Login" action="customer_formLG.php" method="post">
		<table align="center"><tr><td> Email: </td><td> <input type="text" name="username"> </td></tr>
		<tr><td> Password: </td><td> <input type="password" name="password"> </td></tr>
		<tr><td></td><td><input type="submit" value="Login"> </td></tr></table>
	</form>
	

	</article>
	
</body>
</html>