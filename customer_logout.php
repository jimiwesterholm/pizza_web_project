<?php
session_start();
include "db.php";

//Log out
unset($_SESSION["customer_login"]);
unset($_SESSION["order_sum"]);
$_SESSION["total_price"] = 0;

header ("Location: index.php");
?>