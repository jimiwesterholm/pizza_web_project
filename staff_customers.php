<?php 
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
	<h1 class="formHeaders">  Your Customers </h1>
	
	<table>
		 <tr> 
			<th> Name </th>
			<th> Phone Number </th>
			<th> Email </th>
			<th> Address </th> 
			<th> City </th> 
			<th> Postcode </th> 
		</tr>
		<?php
			//select query with inner join to branch table from address table
			$query = "SELECT * FROM staffcust_view
					  INNER JOIN address_view ON staffcust_view.addressID=address_view.addressID";
				
			//run the query and check for errors
			$result = mysql_query($query, $db) or die(mysql_error());
			
			//display all data meeting query requirements
			while ($row = mysql_fetch_array($result)) {
				echo "<tr><th> " . $row["name"];
				echo "</th><th> " . $row["phone_Number"]; 
				echo "</th><th> " . $row["email"];
				echo "</th><th> " . $row["street_address"];
				echo "</th><th> " . $row["city"];
				echo "</th><th> " . $row["postcode"]. "</th></tr>";
			}
		//end php for viewing customers
		?>
	</table>
	</div> 	
</body>
</html>