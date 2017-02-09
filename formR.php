<?php
include "db.php";

//Get personal details
$staffID = $_POST["username"];
$password = $_POST["password"];
$role = $_POST["role"];
$q = "INSERT INTO Staff (staffID, password, role) VALUES ('$staffID', '$password', '$role')";

if (!mysql_query($q, $db)) {
    echo "An error occured.";
} else {
    header("Location: manager_home.php");
}?>