<?php 
session_start();
include "db.php"; //include connection to database
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Pizza Hat - Manager</title>
		<link rel="stylesheet" type="text/css" href="staffa.css" />
	</head>

	<body>
		<?php
			if ($_SESSION["loggedin"]==NULL || $_SESSION["role"] == "floorstaff" || $_SESSION["role"] == "delivery") {
				header("Location: staff_log_in.php");
			}
			
			//retrieve name 
			$staffID = $_SESSION["loggedin"];
			$query = "SELECT name FROM staff WHERE staffID = '$staffID'";
			
			$result = mysql_query($query, $db) or die(mysql_error());
			
			$name="";
			
			//display all data meeting query requirements
			while ($row = mysql_fetch_array($result)) {
				$name = $row["name"];
			}
		?>
    
	
	
		<nav>
		
			<div class="b">
				<img src="pizzahat.png">
			</div>
			
			<ul> 
				<li><a href="manager_details.php"> Welcome <?php echo $name ?> </a></li>
				<li class="dropdown"> <a href="#" class dropbtn"> Staff</a>
					<div class="dropdown-content">
						<a href="manager_floorstaff.php"> Floor Staff </a>
						<a href="manager_drivers.php"> Delivery Drivers </a>
						<?php if ($_SESSION["role"] == "admin") { ?> <a href="admin_managers.php"> Managers </a><?php } ?>
						<a href="manager_addstaff.php"> Add New Staff Member </a>
						<a href="manager_editstaff.php"> Edit Staff Details </a>
					</div>
				</li>
				<?php
				if ($_SESSION["role"] != 'admin') {
				?>
				<li><a href="manager_branch.php"> Branch </a></li>
				<?php
				} else {
				?>
				<li class="dropdown"> <a href="#" class dropbtn"> Branch </a>
					<div class="dropdown-content"> 
						<a href="manager_branch.php"> Your Branch </a>
						<a href="all_branches.php"> All Branches </a>
					</div>
				<?php } ?>
				
				<li class="dropdown"> <a href="#" class dropbtn"> Supply</a>
					<div class="dropdown-content"> 
						<a href="manager_suppliers.php"> Suppliers </a>
						<a href="manager_ingredients.php"> Ingredients </a> 
					</div>
				<li class="dropdown"> <a href="#" class dropbtn"> Orders</a>
					<div class="dropdown-content"> 
						<a href="manager_orders.php"> Orders </a>
						<a href="manager_pizza.php"> Pizzas </a> 
						<a href="manager_xtra.php"> Extras </a>
					</div>
				<li><a href="manager_customers.php"> Customers </a></li> 
				<li><a href="manager_bookings.php"> Bookings </a></li> 
				<li><a href="staff_logout.php"> Log Out </a></li>
			</ul>
		</nav> 
	</body>
</html>