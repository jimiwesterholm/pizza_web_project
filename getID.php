<?php
session_start();
include "db.php";

$_SESSION["temp"] = NULL;
$t = $_SESSION["table"];

//Choose ID name
switch ($t) {
    case 'address':
        $idName = "addressID";
        break;
    case 'booking':
        $idName = "booking_ID";
        break;
    case 'branch':
        $idName = "branchID";
        break;
    case 'customer_order':
        $idName = "order_ID";
        break;
    case 'staff':
        $idName = "staffID";
        break;
    case 'supplier':
        $idName = "supplier_ID";
        break;
}


//Query to get a new ID nummber for specified table
$q = "SELECT MAX(".$idName.") FROM ".$t."";

//Find highest id number
$result = mysql_query($q, $db) or die(mysql_error($db));;
$row = mysql_fetch_row($result);

$_SESSION["temp"] = $row[0];
$_SESSION["temp"]++;

unset($_SESSION["table"]);