<?php
session_start();
include "db.php";

//Get personal details
$email = $_SESSION["customer_email"];
$password = $_POST["password"];

$q = "INSERT INTO Customer (email, password) VALUES ('$email', '$password')";

//Check input
if ($email==NULL || $password==NULL) {
    header ("Location: customer_register.php");
}

if (!mysql_query($q, $db)) {
    echo "Error: " + mysql_error($db);
} else {
    header ("Location: index.php");
}?>