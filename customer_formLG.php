<?php
session_start();
include "db.php";

//Get login details
$email =  $_POST["username"];
$password = $_POST["password"];
$q="SELECT * FROM Customer WHERE email='$email'";

//Check login
$result = mysql_query($q, $db);
$row = mysql_fetch_assoc($result);

if ($row["password"]==$password)
{
	mysql_free_result($result);
    $_SESSION["customer_login"] = $email;
	$_SESSION["order_sum"] = NULL;
	$_SESSION["total_price"] = 0;
    header ("Location: index.php");
} else {
	mysql_free_result($result);
    header ("Location: customer_login.php");
}
?>