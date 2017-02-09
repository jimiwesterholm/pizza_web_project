<?php 
	session_start();
	include "db.php"; //include connection to database
?>

<!DOCTYPE html>
<html>
<head>
        <title>Pizza Hat - Manager</title>
</head>

<body>
	
	<?php include 'manager_home.php'; ?>
	
	<div class="formHolder">
	<h1 class="formHeaders"> Your Extras </h1> 
	
	
	<table>
		 <tr> 
			<th> Name </th>
			<th> Type </th>
			<th> Price</th>
			<th> Supply </th>
			<th> Supplier ID  </th> 
		</tr>
		
		<?php
		
			$query = "SELECT * FROM staffextra_view";
			$result = mysql_query($query, $db) or die(mysql_error());
			
			//display all data meeting query requirements
			while ($row = mysql_fetch_array($result)) {
				echo "<tr><th> " . $row["name"];
				echo "</th><th> " . $row["type"]; 
				echo "</th><th> " . $row["price"];
				echo "</th><th> " . $row["supply"];
				echo "</th><th> " . $row["supplier_ID"]. "</tr>";
			}
			
		?>
	
	</table>
	<form name="Login" action="formAddExtra.php" method="post">
		Name: <input type="text" name="name"> <br> 
		Supply: <input type="text" name="supply"> <br>
		<?php if ($_SESSION["role"] == 'admin') { ?>
		Price/kg: <input type="text" name="price"> <br>
		Supplier ID: <input type="text" name="supplierID"> <br>
		<?php } ?>
		<input type="submit" value="Add"> <br>
	</form>
	<?php if ($_SESSION["role"] == 'admin') { ?>
	<p style="margin: 0.5em 0em 0em 6em"> To only modify supply, leave all but name and supply blank.</p>
	<?php } ?>
	</div> 
</body>
</html>