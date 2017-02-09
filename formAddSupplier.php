<?php
session_start();
include "db.php";

//Get ID
$_SESSION["table"] = 'supplier';
include 'getID.php';
$id = $_SESSION["temp"];

//Get address ID
$_SESSION["table"] = "address";
include 'getID.php';
$ad_id = $_SESSION["temp"];

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$street = $_POST['street'];
$city = $_POST['city'];
$postcode = $_POST['postcode'];

$q = "INSERT INTO supplier_view VALUES ($id, $name, $phone, $email, $ad_id)";
mysql_query($q, $db) or die( mysql_error($db));

$q2 = "INSERT INTO address_view (addressID, street_address, postcode, city) VALUES ($ad_id, $street, $postcode, $city)";
mysql_query($q2, $db) or die( mysql_error($db));

mysql_free_result($result);

header("Location: manager_suppliers.php");
?>