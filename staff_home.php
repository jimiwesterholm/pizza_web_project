<?php
session_start();
include "db.php"; //include connection to database
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Pizza Hat - Staff</title>
		<link rel="stylesheet" type="text/css" href="staffa.css" />
	</head>

	<body>
	
		<?php
			//GET NAME FOR STAFF LOGGED IN
			$staffID = $_SESSION["loggedin"]; //get logged in staff id
			$query = "SELECT name FROM staff WHERE staffID = '$staffID'"; //get name from database
			
			//run the query and check for errors
			$result = mysql_query($query, $db) or die(mysql_error()); 
			while ($row = mysql_fetch_array($result)) {
				$name = $row["name"]; //assign name variable
			}
        ?>
		
		<nav>
			<div class="b">
				<img src="pizzahat.png">
			</div>
			<ul> 
				<li><a href="staff_details.php"> Welcome <?php echo $name ?> </a></li>
				<li><a href="staff_orders.php"> Orders </a></li> 
				<li><a href="staff_customers.php"> Customers </a></li> 
				<li><a href="staff_bookings.php"> Bookings </a></li> 
				<li><a href="staff_logout.php"> Log Out </a></li>
			</ul>
		</nav> 
		
	</body>
</html>