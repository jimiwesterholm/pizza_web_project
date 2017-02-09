<?php
session_start();
include "db.php";
$order = '2'/*$_SESSION["order_ID"]*/;

//Queries for getting the extras and pizzas in a specific order
$pizzaQ = "SELECT b.pizza_name, b.size, b.Quantity, a.price FROM pizza a, pizza_order b WHERE b.order_ID = '$order' AND a.name = b.pizza_name AND a.size = b.size";
$extraQ = "SELECT a.Extra_name, b.type, a.Quantity, b.price FROM customerorder_extra a, extra b WHERE a.order_ID = '$order' AND a.Extra_name = b.name";

$resultP = mysqli_query($db, $pizzaQ) or die(mysqli_error($db));

//Display pizzas in order
while ($row = mysqli_fetch_row($resultP)) {
        echo "<tr><th> " . $row[0];
        echo "</th><th> " . $row[1];
        echo "</th><th> " . $row[2];
        echo "</th><th> " . $row[3]. "</tr>";
}
mysqli_free_result($resultP);
$resultE = mysqli_query($db, $extraQ) or die(mysqli_error($db));

//Display pizzas in order
while ($row = mysqli_fetch_row($resultE)) {
        echo "<tr><th> " . $row[0];
        echo "</th><th> " . $row[1];
        echo "</th><th> " . $row[2];
        echo "</th><th> " . $row[3]. "</tr>";
}
mysqli_free_result($resultE);