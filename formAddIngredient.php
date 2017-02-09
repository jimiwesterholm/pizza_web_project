<?php
include "db.php";
session_start();

//Get personal details
$name = $_POST["name"];
$veg = $_POST["vegetarian"];
$price = $_POST["price"];
$supply = $_POST["supply"];
$supplierID = $_POST["supplierID"];

$q = "INSERT INTO ingredient_view (name, vegetarian, pricekg, supply) VALUES ('$name', '$veg', '$price', '$supply')";
$q2 = "INSERT INTO supplier_ingredient (ingredient_name, supplier_ID) VALUES ('$name', '$supplierID')";

if ($veg != NULL && $price != NULL && $supplierID != NULL) {
    mysql_query($q2, $db) or die(mysql_error($db));	//If adding ingredient
} else if ($name != NULL && $supply != NULL) {
    $q = "UPDATE ingredient_view SET supply = '$supply' WHERE name = '$name'";	//If updating supply
}
mysql_query($q, $db) or die(mysql_error($db));
header("Location: manager_ingredients.php");
