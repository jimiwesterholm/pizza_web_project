<?php
	session_start();
	
	// session_destroy();
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
		<table align="center">
			<tr><td width="60%"><b>Name</b></td><td><?php echo $row[0]; ?></td></tr>
			<tr><td><b>Phone Number</b></td><td><?php echo $row[1]; ?></td></tr>
			<tr><td><b>Email</b></td><td><?php echo $row[2]; ?></td></tr>
		<?php
		$ID = $row[3];
		if (!is_null($ID)) {
			$query2 = "SELECT * FROM address_view WHERE addressID = $ID";
			$result = mysql_query($query2, $db) or die(mysql_error());
			$row = mysql_fetch_row($result);
		?>
			<tr><td><b>Address</b></td><td><?php
				echo $row[1]."<br/>".$row[2].", ".$row[3]."<br/>".$row[4]."<br/>".$row[5];
		}
		?>	</td></tr>
			<tr><td colspan="2" align="right"><a href="customer_edit.php">Edit details</a></td></tr></table>
	</article>
		<?php mysql_close($db); ?>
	

</body>
</html>