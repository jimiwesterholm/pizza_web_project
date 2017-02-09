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
	<h1 class="formHeaders"> Your Pizzas </h1> 
	
	
	<table>
		 <tr> 
			<th> Name </th>
			<th> Price </th>
			<th> Spice</th>
			<th> Vegetarian </th>
			<th> Size </th> 
		</tr>
		
		<?php
		include "db.php"; //include connection to database
		
		
			//select query with inner join to branch table from address table
			
			$query = "SELECT * FROM staffpizza_view";
			$result = mysql_query($query, $db) or die(mysql_error());
			
			//display all data meeting query requirements
			while ($row = mysql_fetch_array($result)) {
				echo "<tr><th> " . $row["name"];
				echo "</th><th> " . $row["price"]; 
				echo "</th><th> " . $row["spice"];
				echo "</th><th> " . $row["vegetarian"];
				echo "</th><th> " . $row["size"];
				/* SORRY IAIN THIS WAS LEFT OVER echo "</th><th> " . $row["changes_made"]. */"</tr>";
			}
			
		?>
	
            </table>
	</div> 
</body>
</html>