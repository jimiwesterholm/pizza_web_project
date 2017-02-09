<?php session_start();

include 'db.php';
$user = $_SESSION["customer_login"];
// check if the customer already has an address to change
if(isset($_POST["addID"])) {
	$ID = $_POST["addID"];
}
// if customer has no previous address,
// create a new address record in address table
else {
	$query = "SELECT MAX(addressID) FROM address";
	$result = mysql_query($query, $db) or die(mysql_error());
	$row = mysql_fetch_row($result);
	$ID = $row[0] + 1;
	mysql_query("INSERT INTO address (addressID) VALUES ($ID)", $db) or die(mysql_error());
	// update the address ID to the customer's details as well
	mysql_query("UPDATE customer SET addressID = $ID WHERE email='$user'", $db) or die(mysql_error());
}
// check all values from post and update the ones that have new data
if(isset($_POST['name']) && ($_POST['name'] != null)) {
	$name = $_POST['name']; 
	$query = "UPDATE customer_view
			  SET name='$name'
			  WHERE email = '$user'";
	$res = mysql_query($query, $db) or die(mysql_error());
}
if(isset($_POST['number']) && ($_POST['number'] != null)) {
	$number = $_POST['number']; 
	$query = "UPDATE customer_view
			  SET phone_Number='$number'
			  WHERE email = '$user'";
	mysql_query($query, $db) or die(mysql_error());
}
if(isset($_POST['email']) && ($_POST['email'] != null)) {
	$email = $_POST['email']; 
	mysql_query("START TRANSACTION", $db);
	$query = "UPDATE customer_view
			  SET email='$email'
			  WHERE email = '$user'";
	mysql_query($query, $db);
	if ($res) {
		mysql_query("COMMIT",$db);
	}
	else {
		mysql_query("ROLLBACK",$db);
	}
}
if(isset($_POST['street']) && ($_POST['street'] != null)) {
	$street = $_POST['street']; 
	$query = "UPDATE address_view
			  SET street_address ='$street'
			  WHERE addressID = '$ID'";
	mysql_query($query, $db) or die(mysql_error());
}
if(isset($_POST['city']) && ($_POST['city'] != null)) {
	$city = $_POST['city']; 
	$query = "UPDATE address_view
			  SET city='$city'
			  WHERE addressID = '$ID'";
	mysql_query($query, $db) or die(mysql_error());
}
if(isset($_POST['postcode']) && ($_POST['postcode'] != null)) {
	$postcode = $_POST['postcode']; 
	$query = "UPDATE address_view
			  SET postcode='$postcode'
			  WHERE addressID = '$ID'";
	mysql_query($query, $db) or die(mysql_error());
}
if(isset($_POST['county']) && ($_POST['county'] != null)) {
	$county = $_POST['county']; 
	$query = "UPDATE address_view
			  SET county='$county'
			  WHERE addressID = '$ID'";
	mysql_query($query, $db) or die(mysql_error());
}
if(isset($_POST['country']) && ($_POST['country'] != null)) {
	$country = $_POST['country']; 
	$query = "UPDATE address_view
			  SET country='$country'
			  WHERE addressID = '$ID'";
	mysql_query($query, $db) or die(mysql_error());
}
mysql_close($db);
header("Location: https://zeno.computing.dundee.ac.uk/2016-ac32006/team18/customeracc.php");
?>