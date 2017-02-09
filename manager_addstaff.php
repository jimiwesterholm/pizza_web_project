<?php
?>

<!DOCTYPE html>
<html>
<head>
        <title>Pizza Hat - Manager</title>
</head>

<body>

	<?php include 'manager_home.php'; ?>

	<div class="formHolder">
	<h1 class="formHeaders"> Add New Staff Member </h1>
	
	<form>
		<?php if ($_SESSION["role"] == 'manager') { ?><h1> You may only add staff for your own branch. </h1><?php } ?>
		Name: <br><input type="text" name="name"><br>
		Role: <br><input type="radio" name="role" value="delivery"> Delivery Driver <br><input type="radio" name="role" value="floorstaff"> Floor Staff 
		<?php
		if ($_SESSION["role"] == 'admin') {
			echo "<input type='radio' name='role' value='admin'> Admin"
			. "<input type='radio' name='role' value='manager'> Manager";
		}
		?>
		<br>
		Phone Number: <br><input type="text" name="phone_no"><br>
		Email: <br><input type="text" name="email"><br>
		Password: <br><input type="text" name="password"><br>
		Street Address: <br><input type="text" name="st_add"><br>
		City: <br><input type="text" name="city"><br>
		Postcode: <br><input type="text" name="postcode">
		<?php if ($_SESSION["role"] == 'admin'){ ?><br>Branch: <br><input type="text" name="branch"></h1><?php } ?>
		<input type="submit">
	</form> 
	
	<?php 
			if(isset($_GET['name']) && isset($_GET['role']) && isset($_GET['phone_no'])
				&& isset($_GET['email']) && isset($_GET['password']) 
				&& isset($_GET['st_add']) && isset($_GET['city']) && isset($_GET['postcode'])){

				//Get IDs
				$_SESSION["table"] = 'staff';
				include "getID.php";
				$staff_id = $_SESSION["temp"];
				
				$_SESSION["table"] = 'address';
				include "getID.php";
				$address_id = $_SESSION["temp"]; 	
				
				if ($_SESSION["role"] == 'manager') {
					//set branch id to staff making booking as staff can only make bookings for their own branch
					$get_branch_id = "SELECT branchID FROM staff WHERE staffID = '$staffID'";
					$result = mysql_query($get_branch_id, $db) or die(mysql_error());
					$row = mysql_fetch_array($result);
					$branch_id = $row["branchID"] ;
				} else {
					$branch_id = $_GET['branch'];
				}
				

				//set variables
				$name = $_GET['name'];
				$role = $_GET['role'];
				$phone_no = $_GET['phone_no'];
				$email = $_GET['email'];
				$password = $_GET['password'];
				$st_add = $_GET['st_add'];
				$city = $_GET['city'];
				$postcode = $_GET['postcode'];
				
				
			
			$add_staff = "INSERT INTO staff
						 VALUES ($staff_id, '$name', '$role', '$phone_no', '$email', 1, 0, '$password', $address_id, $branch_id)";
			$add_address = "INSERT INTO address_view
						    VALUES ($address_id, '$st_add', '$postcode', '$city', 0, 0)";
			
			$update = mysql_query($add_staff, $db) or die(mysql_error());
			$update = mysql_query($add_address, $db) or die(mysql_error());
				}?> 
	
</body>
</html>