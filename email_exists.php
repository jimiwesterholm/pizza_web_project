<?php
session_start();
include 'db.php';

//Get email
$email = $_POST["username"];
$_SESSION["customer_email"] = $email;

//Check if that address is available
$q="SELECT email FROM Customer WHERE email='$email'";
$result = mysql_query($q, $db);
$row = mysql_fetch_assoc($result);

if ($row["email"]==NULL)
{
    header ("Location: customer_register_2.php");
} else {
	$_SESSION["email_error"] = "This email is already in use";
	header ("Location: customer_register.php");
}
?>