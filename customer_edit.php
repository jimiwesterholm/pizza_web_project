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

	<h1>Your account</h1>
	<article>
		<?php
		include 'db.php';
		$email = $_SESSION["customer_login"];
		$query = "SELECT * FROM customer_view WHERE email='$email'";
                
		$result = mysql_query($query, $db) or die(mysql_error());
		$row = mysql_fetch_row($result);
				
		?>
		<form method="post" action="customer_editf.php">
		<table align="center">
			<tr><td><b>Name</b></td><td><?php echo $row[0]; ?></td><td><input type="text" name="name" /></td></tr>
			<tr><td><b>Phone Number</b></td><td><?php echo $row[1]; ?></td><td><input type="text" name="number" /></td></tr>
			<tr><td><b>Email</b></td><td><?php echo $row[2];?></td><td><input type="text" name="email" /></td></tr>
		<?php
		$ID = $row[3];
		if (!is_null($row[3])) {
		$query2 = "SELECT * FROM address_view WHERE addressID = $ID";
		$result = mysql_query($query2, $db) or die(mysql_error());
		$row = mysql_fetch_row($result);
		?>
			<tr><td><b>Address</b></td></tr>
			<tr><td>Street Address</td><td><?php echo $row[1]; ?></td><td><input type="text" name="street" /></td></tr>
			<tr><td>City</td><td> <?php echo $row[2]; ?></td><td><input type="text" name="city" /></td></tr>
			<tr><td>Postcode</td><td> <?php echo $row[3]; ?></td><td><input type="text" name="postcode" /></td></tr>
			<tr><td>County</td><td> <?php echo $row[4]; ?></td><td><input type="text" name="county" /></td></tr>
			<tr><td>Country</td><td> <?php echo $row[5]; ?></td><td><input type="text" name="country" /></td></tr>
			<input type="hidden" value="<?php echo $ID; ?>" name="addID" />
		<?php } else { ?>
			<tr><td><b>Address</b></td></tr>
			<tr><td>Street Address</td><td></td><td><input type="text" name="street" /></td></tr>
			<tr><td>City</td><td></td><td><input type="text" name="city" /></td></tr>
			<tr><td>Postcode</td><td></td><td><input type="text" name="postcode" /></td></tr>
			<tr><td>County</td><td></td><td><input type="text" name="county" /></td></tr>
			<tr><td>Country</td><td></td><td><input type="text" name="country" /></td></tr>
		<?php } ?>
			<tr><td colspan="2" align="right"><input type="submit" value="Edit details" /></a></td></tr></table>
			</form>
	</article>
		<?php mysql_close($db); ?>
	

</body>
</html>