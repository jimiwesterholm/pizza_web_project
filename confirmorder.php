<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
        <title>Pizza Hat</title>
		<link rel="stylesheet" type="text/css" href="customer.css" />
</head>

<body>
	<?php include 'topbar.php'; ?>

	<h1>Your Order summary</h1>
	<article>
	<?php
		if (empty($_SESSION["order_sum"])) {
			echo "There are no items in your order";
		}
		else {
			foreach($_SESSION["order_sum"] as $item) {
				for($i=$item["quantity"];$i>0;$i--) {
			?>
			<div style="padding: 15px 20% 15px 20%;">
				<?php	
						if ($item["type"] == "pizza") {
							echo $item["size"]." ";
						}
						echo $item["name"];
						echo "<div style='float:right;'>&pound; ".$item["price"]."<br/>";
				?></div>
			</div><br/>
	<?php
				}
			}
	?>
	<div align="center">
	<font size="3">Total <b>&pound; <?php echo $_SESSION["total_price"]; ?></b></font> <br/><br/>
	
	<?php
		include "db.php";
		// if the page is accessed through yourorder.php get the information that is passed through the form
		if (isset($_POST["sitin"])) {
			$_SESSION["ordertype"] = $_POST["sitin"];
			// if the customer has chosen delivery
			if($_SESSION["ordertype"] == "Delivery") {
				echo "<form method='post' action='placeorder.php'>";
				if ($_SESSION["customer_login"] != NULL) {
					$query2 = "SELECT street_address,city,postcode FROM address INNER JOIN customer ON address.addressID=customer.addressID WHERE email='".$_SESSION["customer_login"]."'";
					$result2 = mysql_query($query2, $db) or die(mysql_error());
					$row2 = mysql_fetch_row($result2);
					
					echo "<table><tr><td style='padding-right:20px;'><input type='radio' name='addtype' value='customeradd' checked='checked' /> Use my address</td>";
					echo "<td align='center'><input type='radio' name='addtype' value='newadd2' /> Deliver to another address </td></tr>";
					
					echo "<tr><td>".$row2[0]." <br /> ".$row2[1]." ".$row2[2]."</td><td>";
				}
				else {
					echo "Email: <input type='text' name='email' /> <br/><br/>";
					echo "<input type='hidden' name='addtype' value='newadd' />";
				}
				echo "Choose delivery address <br/><br/>";
				?>
				<table><tr><td>
				Street Address </td><td> <input type="text" name="address" /></td></tr><tr><td>
				City </td><td> <input type="text" name="city" /> </td></tr><tr><td>
				Postcode </td><td> <input type="text" name="postcode" /> </td></tr></table>
				<?php
				if ($_SESSION["customer_login"] != NULL) {
					echo "</td></tr></table>";
				}
				$_SESSION["order_branch"] = "null";
			}
			else {
				// if customer does not want delivery ask for the branch to collect/sit in
				if(!isset($_SESSION["order_branch"])) {	?>
					<form method="get" align="center" style="margin-top:10px">
					Please select a branch to place your order for <br/>
						<input type="text" name="search" id="search" placeholder="Your City..." />
						<input type="submit" value="Find a Branch" /><br/><br/>
					</form>
		<?php	}
			}
		}
		// if branch is set it means that customer has chosen to sit in or collection
		// (for delivery branch would be null and branch is not set if not chosen yet)
		if(isset($_SESSION["order_branch"]) && ($_SESSION["order_branch"] != "null")) {
			echo "<form method='post' action='placeorder.php'>";
			echo "<input type='hidden' name='addtype' value='noadd' />";
			echo "Order to be set for branch".$_SESSION["order_branch"]."<br/><br/>";
			if (!isset($_SESSION["customer_login"])) {
				echo "Email: <input type='text' name='email' /> <br/><br/>";
			}
		}
		// search method to display branch suggestions to user
		if(isset($_GET['search'])) {
			$search = $_GET['search'];
			$query = "SELECT * FROM address INNER JOIN branch ON address.addressID=branch.addressID WHERE city='$search'";
			$result = mysql_query($query, $db) or die(mysql_error());
			while ($row = mysql_fetch_array($result)) {
				echo "<br>Branch: " . $row["branchID"];
				echo "<br> Address: " . $row["street_address"].", ".$row["city"]." ".$row["postcode"] ;
				echo "<br /><form method='post' action='place_branch.php'> <input type='submit' value='Place order for this branch' /><input type='hidden' name='branch' value='".$row["branchID"]."' /><input type='hidden' name='source' value='orderpage' /></form>";
			}
			if(mysql_num_rows($result) <= 0) {
				echo "<br> Sorry, no stores in your city yet";
			}
		}
		mysql_close($db);
			?>
	<br/>
		<input type="hidden" name="sitin" value="<?php echo $_SESSION["ordertype"]; ?>" /> 
		<input type="submit" value="Place Order" />
	</form>
	</div>
	<?php
		}
	?>
	</article>
	

</body>
</html>
