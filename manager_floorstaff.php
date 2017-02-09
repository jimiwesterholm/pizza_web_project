<?php 
session_start();
	include "db.php"; //include connection to database
	$branchid = isset($_POST['branch']) ? $_POST['branch'] : '';
?>

<!DOCTYPE html>
<html>
<head>
        <title>Pizza Hat - Manager</title>
</head>

<body>
	
	<?php include 'manager_home.php'; ?>
	
	<div class="formHolder">
	
	<h1 class="formHeaders"> Floor Staff </h1> 
	
	<form method="post" action="">
	<select name="branch">
		<option value="101" >Branch 101</option>
		<option value="102" >Branch 102</option>
		<option value="103" >Branch 103</option>
		<option value="104" >Branch 104</option>
		<option value="105" >Branch 105</option>
		<option value="106" >Branch 106</option>
		<option value="107" >Branch 107</option>
		<option value="108" >Branch 108</option>
		<option value="109" >Branch 109</option>
		<option value="110" >Branch 110</option>
		<input type="submit" value="Submit">
		<?php
          $option = isset($_POST['branch']) ? $_POST['branch'] : false;
          if ($option) {
				$branchID = $_POST['branch'];
				}
				else {
					$branchID = 101;
				}
   ?>
	</select>
	</form>
	
	
	<table style="margin-top:10px">
		 <tr> 
			<th> ID </th>
			<th> Name </th>
			<th> Phone Number </th>
			<th> Email </th>
			<th> Part Time </th> 
			<th> Abscence Tracker </th> 
			<th> Address </th> 
			<th> City </th> 
			<th> Postcode </th> 
			<th> Branch </th> 
		
		<?php
		
			mysql_query("START TRANSACTION;", $db)or die(mysql_error()); //START TRANSACTION 
		
			$query = "SELECT * FROM manager_view
					  INNER JOIN address_view ON manager_view.addressID=address_view.addressID
					  WHERE role ='floorstaff' AND branchID='$branchID'
					  ORDER BY name ASC";
			$result = mysql_query($query, $db) or die(mysql_error());
			
			mysql_query("COMMIT;", $db)or die(mysql_error()); //COMMIT TRANSACTION
			
			while ($row = mysql_fetch_array($result)) {
				echo "<tr><th> " . $row["staffID"];
				echo "</th><th> " . $row["name"]; 
				echo "</th><th> " . $row["phone_number"];
				echo "</th><th> " . $row["email"];
				echo "</th><th> " . $row["part_time"];
				echo "</th><th> " . $row["abscene_tracker"];
				echo "</th><th> " . $row["street_address"];
				echo "</th><th> " . $row["city"];
				echo "</th><th> " . $row["postcode"];
				echo "</th><th> " . $row["branchID"]. "</tr>" ;
			
		
		}
		?>
		
		
	
    </table>
	<h1 class="formHeaders"> Delete Staff </h1> 
	
	<form> 
				Staff ID: <input type="text" name="deleteID"> 
				<input type="submit" value="Delete">
				</form> 
				<?php
				//if delete has an input
					if(isset($_GET['deleteID'])) {
					$deleteID = $_GET['deleteID']; //set search variable
					//select query with inner join to branch table from address table
					
					mysql_query("START TRANSACTION;", $db)or die(mysql_error()); //START TRANSACTION 
					
					$query_dstaff = "DELETE FROM manager_view
								WHERE staffID='$deleteID'";
					mysql_query($query_dstaff, $db) or die(mysql_error());
					
					mysql_query("COMMIT;", $db)or die(mysql_error()); //COMMIT TRANSACTION
					header ("Location: manager_floorstaff.php");
						}; ?>
						
						
</div>
</body>
</html>