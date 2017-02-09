<?php 
session_start();
include "db.php"; //include connection to database

$phone_no = isset($_POST['no']) ? $_POST['no'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
?>

<!DOCTYPE html>
<html>
	<head>
        <title>Pizza Hat - Staff </title>
	</head>

	<body>	
	
		<?php include 'staff_home.php'; ?>
	
		<div class="formHolder">
		<h1 class="formHeaders">  Your Details </h1>
	
		<form>
		<?php
			//VIEW YOUR OWN DETAILS
			//query to view details
			$query2 = "SELECT * FROM staff_view
					   INNER JOIN address_view ON staff_view.addressID=address_view.addressID
					   WHERE staffID = '$staffID'";
                
			//run the query and check for errors
            $result = mysql_query($query2, $db) or die(mysql_error());
                
				//GET INFO AND DISPLAY 
				while ($row = mysql_fetch_array($result)) {
                       echo "<b>Name:</b> " . $row["name"]. "<br> <b>StaffID:</b> " . $row["staffID"];
                       echo "<br> <b>Role:</b> " . $row["role"]. "<br> <b>Phone Number:</b> " . $row["phone_number"];
                       echo "<br> <b>Email:</b> " . $row["email"];
					   echo "<br><br> <b>Address:</b> " . $row["street_address"]. "<br> <b>City:</b> " . $row["city"];
                       echo "<br> <b>Postcode:</b> " . $row["postcode"];
                }
			//end php for display details
        ?>
        </form>
	
		<h1 class="formHeaders">  Edit Your Details </h1>
		
		<form> 
		Phone Number: <br><input type="text" name="no"><br> 
		Email: <br><input type="text" name="email"> <br> 
		Address: <br><input type="text" name="st_add">  <br>
		City: <br><input type="text" name="city">  <br>
		Postcode: <br><input type="text" name="postcode">  
		<input type="submit"> 
		<?php 
			//EDIT YOUR DETAILS
			//if input is not empty
			if (isset($_GET['no']) && isset($_GET['email'])) {
				
				//set variables to input
				$phone_no = $_GET['no']; 
				$email = $_GET['email']; 
				$st_add = $_GET['st_add']; 
				$city = $_GET['city']; 
				$postcode = $_GET['postcode']; 
			
				//sql query to update table
				$query = "UPDATE staff_view
					      SET phone_number='$phone_no',email='$email'
					      WHERE staffID = '$staffID'";
				$query2 = "UPDATE address_view
						   SET street_address='$st_add', city='$city', postcode='$postcode'
						   WHERE addressID = 
						  (SELECT addressID FROM staff_view WHERE staffID = '$staffID')";
			}
			
			//run the query and check for errors
			$update = mysql_query($query, $db) or die(mysql_error());
			$update2 = mysql_query($query2, $db) or die(mysql_error());
		//end php for edit details
		?> 
		</form> 
		
		<h1 class="formHeaders">  Change Your Password </h1>
		
		<form> 
		New Password: <br><input type="password" name="pass">
		<input type="submit"> 
		<?php 
			//EDIT YOUR DETAILS
			//if input is not empty
			
			if (isset($_SESSION["password"] )) { 
			echo $_SESSION["password"]; 
			
			unset($_SESSION["password"]);
			}
			
			if (isset($_GET['pass'])) {
				
				//set variables to input
				$pass = $_GET['pass']; 
			
				mysql_query("START TRANSACTION;", $db)or die(mysql_error()); //START TRANSACTION 
			
				//sql query to update table
				$query = "UPDATE staff_view
					      SET password='$pass'
					      WHERE staffID = '$staffID'";
						  $update = mysql_query($query, $db) or die(mysql_error());
				if (strlen($pass)<6) {
							  mysql_query("ROLLBACK;", $db)or die(mysql_error());
							  $_SESSION["password"] = "Password not changed.";
							  header ("Location: staff_details.php");
						  } else  {
						  
						  mysql_query("COMMIT;", $db)or die(mysql_error()); //COMMIT TRANSACTION 
						  $_SESSION["password"] = "Password changed.";
						  header ("Location: staff_details.php");
						  
						  }
			}
			
			//run the query and check for errors
			
		//end php for password
		?> 
		</form> 
	
		<h1 class="formHeaders">  Your Branch </h1>
	
		<form>
		<?php
			//VIEW YOUR BRANCH
			//query for viewing branch, joins to address table for the branch
			$query2 = "SELECT * FROM staffbranch_view
					   INNER JOIN address_view ON staffbranch_view.addressID=address_view.addressID
					   WHERE branchID = 
					  (SELECT branchID FROM staff_view WHERE staffID = '$staffID')";
			
			$result = mysql_query($query2, $db) or die(mysql_error());
			
			//display all data for branch
			while ($row = mysql_fetch_array($result)) {
				echo "<b>Branch ID:</b> " . $row["branchID"]. "<br><br>" ;
				echo " <b>Phone Number:</b> " . $row["phone_number"]. "<br> <b>Email:</b> " . $row["email"];
				echo "<br><br> <b>Address:</b> " . $row["street_address"];
				echo "<br> <b>City:</b> " . $row["city"]. "<br> <b>Postcode:</b> " . $row["postcode"];
			}
		//end php for view branch details
		?>
		</form>
		</div> 
	</body>
</html>