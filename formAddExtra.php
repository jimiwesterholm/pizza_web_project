<?php
include "db.php";
session_start();

//Get personal details
$name = $_POST["name"];
$price = $_POST["price"];
$supply = $_POST["supply"];
$supplierID = $_POST["supplierID"];
$q = "INSERT INTO staffextra_view (name, price, supply) VALUES ('$name', '$price', '$supply')";
$q2 = "INSERT INTO extra_supplier (extra_name, supplier_ID) VALUES ('$name', '$supplierID')";

if ($supplierID != NULL && $price != NULL) {
    mysql_query($q2, $db) or die(mysql_error($db));
} else if ($name != NULL && $supply != NULL) {
    $q = "UPDATE staffextra_view SET supply = '$supply' WHERE name = '$name'";	//If updating supply
}
mysql_query($q, $db) or die(mysql_error($db));
header("Location: manager_xtra.php");
