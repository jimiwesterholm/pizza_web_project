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
			
			if ($_SESSION["role"] == 'manager') {
				$query2 = "SELECT * FROM managerbranch_view
					   INNER JOIN address_view ON managerbranch_view.addressID=address_view.addressID
					   WHERE managerbranch_view.branchID = 
					  (SELECT mdetails_view.branchID FROM mdetails_view WHERE mdetails_view.staffID = $staffID);";
			} else {
				$query2 = "SELECT * FROM managerbranch_view
					   INNER JOIN address_view ON managerbranch_view.addressID=address_view.addressID
					   WHERE managerbranch_view.branchID = 
					  (SELECT adetails_view.branchID FROM adetails_view WHERE adetails_view.staffID = $staffID);";
			}
			
			
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
			}
		//end php for view branch details
		?>
		</form>
	<div>

</body>
</html>