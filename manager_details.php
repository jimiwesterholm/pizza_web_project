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
	<h1 class="formHeaders"> Your Details </h1>
	
	
	
	<form>
		<?php
			//VIEW YOUR OWN DETAILS
			//query to view details
			$query2 = "SELECT * FROM mdetails_view
					   INNER JOIN address_view ON mdetails_view.addressID=address_view.addressID
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
				$query = "UPDATE mdetails_view
					      SET phone_number='$phone_no',email='$email'
					      WHERE staffID = '$staffID'";
				$query2 = "UPDATE address_view
						   SET street_address='$st_add', city='$city', postcode='$postcode'
						   WHERE addressID = 
						  (SELECT addressID FROM mdetails_view WHERE staffID = '$staffID')";
			}
			
			//run the query and check for errors
			$update = mysql_query($query, $db) or die(mysql_error());
			$update2 = mysql_query($query2, $db) or die(mysql_error());
		//end php for edit details
		?> 
		</form> 
		
		<h1 class="formHeaders">  Change your password </h1>
		
		<form> 
		New Password: <br><input type="password" name="pass">
		<input type="submit"> 
		<?php 
			//EDIT YOUR PASSWORD
			
			
			if (isset($_SESSION["password"] )) { 
			echo $_SESSION["password"]; 
			
			unset($_SESSION["password"]);
			}
			
			
			//if input is not empty
			if (isset($_GET['pass'])) {
				
				//set variables to input
				$pass = $_GET['pass']; 
			
			
			
				//sql query to update table
				mysql_query("START TRANSACTION;", $db)or die(mysql_error()); //START TRANSACTION 
				
				$query = "UPDATE mdetails_view
					      SET password='$pass'
					      WHERE staffID = '$staffID'";
						  $update = mysql_query($query, $db) or die(mysql_error());
						  
						  if (strlen($pass)<6) {
							  mysql_query("ROLLBACK;", $db)or die(mysql_error());
							  $_SESSION["password"] = "Password not changed.";
							  header ("Location: manager_details.php");
						  } else  {
						  
						  mysql_query("COMMIT;", $db)or die(mysql_error()); //COMMIT TRANSACTION 
						  $_SESSION["password"] = "Password changed.";
						  header ("Location: manager_details.php");
						  
						  }
			}
			
			//run the query and check for errors
			
		//end php for password
		?> 
		</form> 
	</div> 
</body>
</html>