<?php 
	session_start();
	
	$action = $_POST["action"];
	if($_POST["type"] == "pizza") { $nameid = $_POST["pname"] . $_POST["size"]; }
	else { $nameid = $_POST["pname"]; }
	$done = False;
	switch ($action) {
		case "add":
			if (!empty($_POST["quantity"])) {
				if (strcmp($_POST["type"],"pizza") == 0) {
					$item_array = array($nameid => array("name" => $_POST["pname"], "type" => $_POST["type"], "size" => $_POST["size"], "price" => $_POST["price"], "quantity" => $_POST["quantity"]));
				}
				else {
					$item_array = array($nameid => array("name" => $_POST["pname"], "type" => $_POST["type"], "price" => $_POST["price"], "quantity" => $_POST["quantity"]));
				}
				$_SESSION["total_price"] = $_SESSION["total_price"] + ($item_array[$nameid]["price"] * $item_array[$nameid]["quantity"]);
				
				if (!empty($_SESSION["order_sum"])) {
					foreach($_SESSION["order_sum"] as $key => $value) {
						if ($key == $nameid) {
							$_SESSION["order_sum"][$key]["quantity"] += $_POST["quantity"];
							$done = True;
						}
					}
					if(!$done){
						$_SESSION["order_sum"] = array_merge($_SESSION["order_sum"],$item_array);
					}
				}
				else {
					$_SESSION["order_sum"] = $item_array;
				}
			}
			header("Location: https://zeno.computing.dundee.ac.uk/2016-ac32006/team18");
			break;
		case "remove":
			$_SESSION["total_price"] = $_SESSION["total_price"] - $_POST["price"];
			if ($_SESSION["total_price"] < 0) {
				$_SESSION["total_price"] = 0;
			}
			
			foreach($_SESSION["order_sum"] as $key => $value) {
				if ($key == $nameid) {
					if($_SESSION["order_sum"][$nameid]["quantity"] == 1) {
						unset($_SESSION["order_sum"][$nameid]);
					}
					else if ($_SESSION["order_sum"][$nameid]["quantity"] > 1) {
						$_SESSION["order_sum"][$nameid]["quantity"] --;
					}
				}
			}
			header("Location: https://zeno.computing.dundee.ac.uk/2016-ac32006/team18/yourorder.php");
			break;
	}
?>