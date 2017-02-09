<?php
session_start();
include "db.php";

//Get login details
$staffID = $_POST["username"];
$password = $_POST["password"];
$q="SELECT * FROM Staff WHERE staffID='$staffID'";


//Check login
$result = mysql_query($q, $db) or die(mysql_error());;
$row = mysql_fetch_assoc($result);
    
if ($row["password"]==$password)
{
    $_SESSION["loggedin"] = $staffID;
    $_SESSION["role"] = $row["role"];
    $_SESSION["branch"] = $row["branch"];
	
    header ("Location: manager_details.php");
	
    if ($row["role"] == "manager" || $row["role"] == "admin")
    {
        header ("Location: manager_details.php");
	}
     else {
    header ("Location: staff_details.php");
    }
	
} else {
    header ("Location: staff_log_in.php");
}
    ?>