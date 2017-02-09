<?php 
	
?>

<!DOCTYPE html>
<html>
<head>
        <title>Pizza Hat - Manager</title>
</head>

<body>
	
	<?php 
		include 'manager_home.php';?>
	
	<div class="formHolder">
	<h1 class="formHeaders"> Suppliers </h1> 
	
	
	
	<table>
		 <tr> 
			<th> ID </th>
			<th> Name </th>
			<th> Phone Number </th>
			<th> Email </th>
			<th> Address </th> 
		<?php
		include "db.php"; //include connection to database
		
		
			//select query with inner join to branch table from address table
			
			$query2 = "SELECT * FROM supplier_view";
			$result = mysql_query($query2, $db) or die(mysql_error());
			
			//display all data meeting query requirements
			while ($row = mysql_fetch_array($result)) {
				$link = $row["supplier_ID"];
				echo "<tr><th> <a href='manager_supplier.php?ID=$link'>$link</a>";
				echo "</th><th> " . $row["name"]; 
				echo "</th><th> " . $row["phone_number"];
				echo "</th><th> " . $row["email"];
				echo "</th><th> " . $row["addressID"]."</tr>" ;
			}
			
			mysql_free_result($result);
		?>
		</table>
		<p align="left" style="margin: 0.5em 0em 0em 6em"> Click on supplier ID to view details. </p>
        <?php
        if ($_SESSION["role"] == 'admin') {
            ?>
        
            <h1 class="formHeaders"> Add Supplier </h1> 
            <form name= "addSupplier" action="formAddSupplier.php" method="post">
                    Name: <br><input type="text" name="name"><br>
                    Phone Number: <br><input type="text" name="phone"><br>
                    Email: <br><input type="text" name="email"><br>
                    Street Address: <br><input type="text" name="street"><br>
                    City: <br><input type="text" name="city"><br>
                    Postcode: <br><input type="text" name="postcode"><br>
    		<input type="submit" value="Add">
            </form> 
			
            <h1 class="formHeaders"> Delete Supplier </h1>
	
            <form> 
                    SupplierID: <input type="text" name="deleteID"> 
                    <input type="submit" value="Delete">
            </form> 
            <?php
            //if delete has an input
            if(isset($_GET['deleteID'])) {
                    $deleteID = $_GET['deleteID']; //set search variable
                    //Delete the data
                    $query_dstaff = "DELETE FROM supplier_view WHERE supplier_ID='$deleteID'";
                    mysql_query($query_dstaff, $db) or die(mysql_error($db));
            } 
        }?>
	
</div>
</body>
</html>