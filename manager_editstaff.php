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
	<h1 class="formHeaders"> Edit Staff Details </h1>
	
	<form>
		Staff ID: <br><input type="text" name="staff_id"><br>
		Branch: <br><input type="text" name="branch_id"><br>
		Abscences: <br><input type="text" name="ab"><br>
		Role: <br><input type="radio" name="role" value="delivery"> Delivery Driver <br><input type="radio" name="role" value="floorstaff"> Floor Staff<br>
		<input type="submit">
	</form> 
	
	<?php
		//EDIT STAFF DETAILS
		//if fields are valid
		if (isset($_GET['staff_id']) && isset($_GET['branch_id']) 
			&& isset($_GET['ab']) && isset($_GET['role'])) {
			
			//set new variables
			$editstaffid = $_GET['staff_id'];
			$branch_id = $_GET['branch_id'];
			$ab = $_GET['ab'];
			$role = $_GET['role'];
			
			mysql_query("START TRANSACTION", $db);
			//query to update table
			$query = "UPDATE manager_view
					  SET branchID='$branch_id',abscene_tracker='$ab', role='$role'
					  WHERE staffID = '$editstaffid'";
			
			//run query and check for errors
			$update = mysql_query($query, $db);
			if ($update) {
				mysql_query("COMMIT", $db);
			}
			else {
				mysql_query("ROLLBACK");
			}
		}
		//end php to edit details
    ?>
</body>
</html>