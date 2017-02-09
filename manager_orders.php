<?php 
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
        <title>Pizza Hat - Manager</title>
</head>

<body>
	
	<?php include 'manager_home.php'; ?>
	
	<div class="formHolder">
	<h1 class="formHeaders"> Your Orders </h1> 
	
	<table>
		 <tr> 
			<th> Order </th>
			<th> Branch </th>
			<th> Total Cost </th>
			<th> Sit In</th>
			<th> Customer Email </th> 
		</tr>
		
		<?php
		include "db.php"; //include connection to database
			
			$query = "SELECT * FROM stafforder_view 
					  WHERE branchID = 
					  ( SELECT branchID 
						FROM mdetails_view 
						WHERE staffID = '$staffID')
						ORDER BY order_ID";
			$result = mysql_query($query, $db) or die(mysql_error());
			
			//display all data meeting query requirements
			while ($row = mysql_fetch_array($result)) {
				$link = $row["order_ID"];
				echo "<tr><th> <a href='manager_order.php?ID=$link'>$link</a>";
				echo "</th><th> " . $row["branchID"];
				echo "</th><th> " . $row["total_cost"];
				echo "</th><th> " . $row["sit_in"];
				echo "</th><th> " . $row["customer_email"]. "</tr>";
			}
			
		?>
	
            </table>
			
			<h1 class="formHeaders"> Order Completed </h1>
	
	<form> 
				Order ID: <input type="text" name="deleteID"> 
				<input type="submit" value="Delete">
				</form> 
				<?php
				//if delete has an input
					if(isset($_GET['deleteID'])) {
					$deleteID = $_GET['deleteID']; //set search variable
					//select query with inner join to branch table from address table
					$query_dbook = "DELETE FROM stafforder_view 
								    WHERE order_ID='$deleteID'";
					mysql_query($query_dbook, $db) or die(mysql_error());
						}; ?>
		
			
			
	</div> 
	</div> 
</body>
</html>