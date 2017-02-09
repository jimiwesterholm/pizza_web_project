<?php
session_start();
include "db.php"; //include connection to database
?>

<!DOCTYPE html>

<html>
	<head>
        <title>Pizza Hat - Staff </title>
		
	</head>

	<body>
	
		<?php include 'staff_home.php'; ?>
	
		<div class="formHolder">
		<h1 class="formHeaders"> Your Orders </h2> 
	
	
		<table>
			<tr> 
				<th> Order </th>
				<th> Branch ID </th>
				<th> Cost </th>
				<th> Sit In</th>
				<th> Customer Email </th> 
		</tr>
		<?php
			//VIEW THE CUSTOMERS TABLE
			//query to select orders
			$query = "SELECT * FROM stafforder_view 
					  WHERE branchID = 
					  ( SELECT branchID 
						FROM staff_view 
						WHERE staffID = '$staffID')
						ORDER BY order_ID";
			$result = mysql_query($query, $db) or die(mysql_error());
			
			//display all order info
			while ($row = mysql_fetch_array($result)) {
				$link = $row["order_ID"];
				echo "<tr><th> <a href='staff_order.php?ID=$link'>$link</a>";
				echo "</th><th> " . $row["branchID"];
				echo "</th><th> " . $row["total_cost"];
				echo "</th><th> " . $row["sit_in"];
				echo "</th><th> " . $row["customer_email"]. "</tr>";
			}
		//end php for view orders
		?>
        </table>
			
		<h1 class="formHeaders"> Order Completed </h1>
	
		<form> 
			Order ID: <input type="text" name="deleteID"> 
			<input type="submit" value="Delete">
		</form> 
			<?php
				//DELETE ORDER
				//if delete has an input
				if(isset($_GET['deleteID'])) {
					$deleteID = $_GET['deleteID']; //set search variable
					//select query with inner join to branch table from address table
					$query_dorder = "DELETE FROM stafforder_view
								     WHERE order_ID='$deleteID'";
					//run the query and check for errors
					mysql_query($query_dorder, $db) or die(mysql_error());
				}; 
			//end php for deleting orders
			?>
		</div>
	</body>
</html>