<?php 
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
	<h1 class="formHeaders"> Your Branch </h1>
	
	<form>
	<?php
			
			//VIEW YOUR BRANCH
			//query for viewing branch, joins to address table for the branch
			
			mysql_query("START TRANSACTION;", $db)or die(mysql_error());//START TRANSACTION 
			
			$query2 = "SELECT * FROM managerbranch_view
					   INNER JOIN address_view ON managerbranch_view.addressID=address_view.addressID";
			
			$result = mysql_query($query2, $db) or die(mysql_error());
			
			mysql_query("COMMIT;", $db)or die(mysql_error()); //COMMIT TRANSACTION
			
			//display all data for branch
			while ($row = mysql_fetch_array($result)) {
				echo "<b>Branch ID:</b> " . $row["branchID"]. "<br><br>" ;
				echo " <b>Phone Number:</b> " . $row["phone_number"]. "<br> <b>Email:</b> " . $row["email"];
				echo "<br><br> <b>Address:</b><br/> " . $row["street_address"];
				echo "<br>" . $row["city"]. ", " . $row["postcode"];
				echo "<br/><br/> <b>Opening Times:</b> ".$row["opening_time"]." - ".$row["closing_time"];
				echo "<br/><br/> <b>Capacity</b> ".$row["capacity"];
				echo "<br><br>___________________________<br><br>";
			}
		//end php for view branch details
		?>
		</form>
		
		<?php
        if ($_SESSION["role"] == 'admin') {
            ?>
        
            <h1 class="formHeaders"> Add Branch </h1> 
            <form name= "addBranch" action="formAddBranch.php" method="post">
					Opening Time: <br><input type="text" name="op_t"><br>
					Closing Time: <br><input type="text" name="cl_t"><br>
					Capacity: <br><input type="text" name="cap"><br>
                    Phone Number: <br><input type="text" name="phone"><br>
                    Street Address: <br><input type="text" name="street"><br>
                    City: <br><input type="text" name="city"><br>
                    Postcode: <br><input type="text" name="postcode"><br>
					Email: <br><input type="text" name="email"><br>
    		<input type="submit" value="Add">
            </form> 
			
            <h1 class="formHeaders"> Delete Branch </h1>
	
            <form> 
                    Branch ID: <input type="text" name="branchID"> 
                    <input type="submit" value="Delete">
            </form> 
            <?php
            //if delete has an input
            if(isset($_GET['branchID'])) {
                    $deleteID = $_GET['branchID']; //get search variable
                    //Delete the data
                    $query_d = "DELETE FROM managerbranch_view WHERE branchID='$deleteID'";
                    mysql_query($query_d, $db) or die(mysql_error());
            } 
        }?>
	<div>

</body>
</html>