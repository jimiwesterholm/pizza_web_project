<?php
	session_start();
	
	include "db.php";
	
	// if the customer is logged in, get their email from the session variable
	// else get the email from the form submitted on confirmorder.php
	if (isset($_SESSION["customer_login"])) {
		$email = $_SESSION["customer_login"];
	}
	else {
		$email = $_POST["email"];
	}
	// if customer is registered and chose to deliver to address provided in 
	// their details get the address ID from the database
	if ($_POST["addtype"] == "customeradd") {
		$query = "SELECT address.addressID FROM address INNER JOIN customer ON address.addressID=customer.addressID WHERE email='".$_SESSION["customer_login"]."'";
		$result = mysql_query($query, $db) or die(mysql_error());
		$row = mysql_fetch_row($result);
		$addID = $row[0];
	}
	else if ($_POST["addtype"] == "noadd") {
		// if the order type is not delivery no address is needed (set to null)
		$addID = "null";
	}
	else {
		// if a new address is provided in confirmorder.php add that address to the database
		mysql_query("START TRANSACTION");
		
		// generate a new addrress ID
		$query3 = "SELECT MAX(addressID) FROM address";
		$result3 = mysql_query($query3, $db) or die(mysql_error());
		$row3 = mysql_fetch_row($result3);
		if ($row3[0] == NULL) { $addID = 1; }
		else { $addID = $row3[0] + 1; }
		
		$query4 = "INSERT INTO address (addressID,street_address,postcode,city) VALUES (".$addID.",'".$_POST['address']."','".$_POST['postcode']."','".$_POST['city']."')";
		$rs = mysql_query($query4, $db);
		// if customer does not exist, create a new customer in the database
		$rs2 = TRUE;
		if ($_POST["addtype"] == "newadd") {
			$query5 = "INSERT INTO customer (email,addressID) VALUES ('".$email."',".$addID.")";
			$rs2 = mysql_query($query5, $db);
		}
		// if address and new customer were inserted succesfully, commit the changes
		if ($rs and $rs2) {
			mysql_query("COMMIT");
		}
		else {
			// if email already exists, the second query probably failed because the email submitted already exists
			// set an error message to display, undo any changes made to the database and break back to yourorder.php
			$_SESSION["email_error"] = "Email is already in use";
			mysql_query("ROLLBACK");
			header("Location: https://zeno.computing.dundee.ac.uk/2016-ac32006/team18/yourorder.php");
			break;
		}
	}
	
	$query2 = "SELECT MAX(order_ID) FROM customerorder";
	$result2 = mysql_query($query2, $db) or die(mysql_error());
	$row2 = mysql_fetch_row($result2);
	$orderID = $row2[0];
	if($orderID == null) {
		$orderID = 1;
	}
	else {
		$orderID += 1;
	}
	
	if(!empty($_SESSION["order_sum"])) {
		// start transaction
		mysql_query("START TRANSACTION");
		$query6 = "	INSERT INTO customerorder (order_ID,total_cost,sit_in,being_prepared,customer_email,branchID,delivery_address)
					VALUES (".$orderID.",".$_SESSION['total_price'].",'".$_SESSION['ordertype']."',0,'".$email."',".$_SESSION['order_branch'].",".$addID.")";
		$rs = mysql_query($query6,$db);
		
		$added = TRUE;
		foreach($_SESSION["order_sum"] as $item) {
			if ($item["type"] == "pizza") {
				$query7 = "INSERT INTO pizza_order (orderID,pizza_name,pizza_size,quantity) VALUES (".$orderID.",'".$item['name']."','".$item['size']."',".$item['quantity'].")";
			}
			else {
				$query7 = "INSERT INTO customerorder_extra (order_ID,extra_name,quantity) VALUES (".$orderID.",'".$item['name']."',".$item['quantity'].")";
			}
			if (!mysql_query($query7,$db)) {
				// if an item from the order was not added, set added variable to false
				$added = FALSE;
			}
		}
		// if all the queries were succesfull commit the changes to the database
		if ($rs and $added) {
			$_SESSION["orderID"] = $orderID;
			mysql_query("COMMIT");
		}
		// if one or more transactions were not succesfull cancel all changes made since start of the order
		else {
			$_SESSION["order_error"] = "Something went wrong, order was not registered.";
			mysql_query("ROLLBACK");
		}
		mysql_close($db);
		header("Location: https://zeno.computing.dundee.ac.uk/2016-ac32006/team18/orderplaced.php");
	}

?>