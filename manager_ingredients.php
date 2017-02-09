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
	<h1 class="formHeaders"> Ingredients</h1> 

	
	
	<table>
		 <tr> 
			<th> Name </th>
			<th> Price </th>
			<th> Supply </th>
			<th> Veg </th> 
		<?php
		include "db.php"; //include connection to database
		
		
			//select query with inner join to branch table from address table
			
			$query2 = "SELECT * FROM ingredient_view";
			$result = mysql_query($query2, $db) or die(mysql_error());
			
			//display all data meeting query requirements
			while ($row = mysql_fetch_array($result)) {
				echo "<tr><th> " . $row["name"];
				echo "</th><th> " . $row["pricekg"]; 
				echo "</th><th> " . $row["supply"];
				echo "</th><th> " . $row["vegetarian"]."</tr>" ;
			}
			
		
		?>
		
		
	
    </table>
	
	<h1 class="formHeaders"> Edit supply </h1> 
	
	<form name="addIn" action="formAddIngredient.php" method="post">
		Name: <br><input type="text" name="name">  <br>
		Supply: <br><input type="text" name="supply"> 
		<?php if ($_SESSION["role"] == 'admin') { ?>
		Price/kg: <input type="text" name="price"> <br>
		Supplier ID: <input type="text" name="supplierID"> <br>
		Vegetarian: <input type="radio" name="vegetarian"value="1"> Yes <input type="radio" name="vegetarian" value="0"> No <br>
		<?php } ?>
		<input type="submit" value="Add"> <br>
	</form>
	<?php if ($_SESSION["role"] == 'admin') { ?>
	<p style="margin: 0.5em 0em 0em 6em"> To only modify supply, leave all but name and supply blank.</p>
	<?php } ?>
</div>
</body>
</html>