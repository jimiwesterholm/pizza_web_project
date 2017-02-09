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
		<h1 class="formHeaders"> Add Booking </h1>
	
		<form>
			Booking Time: <br><input type="text" name="time"><br>
			Branch: <br><input type="text" name="branch_id"><br>
			Number of People: <br><input type="text" name="peop_no"><br>
			Special Requests: <br><input type="text" name="requests"><br>
			Customer Email: <br><input type="text" name="customer_email">
			<input type="submit">
		</form> 
	
		<?php 
			//CODE TO ADD NEW BOOKING
			
			//if all fields are filled
			if(isset($_GET['time']) && isset($_GET['branch_id'])
			&& isset($_GET['peop_no']) && isset($_GET['requests'])
			&& isset($_GET['customer_email'])) {

				//set variables
				do {
					$book_id = rand(1,100000); //create random number for booking id
					$q = "SELECT booking_ID FROM booking_view WHERE booking_ID = '$book_id'";
				} while (!mysql_query($q, $db));
				$time = $_GET['time']; 
				$branch_id = $_GET['branch_id'];
				$peop_no = $_GET['peop_no'];
				$requests = $_GET['requests'];
				$customer_email = $_GET['customer_email'];			
			
				//query to add new booking
				$add_book = "INSERT INTO booking_view
						     VALUES ($book_id, $time, $branch_id, $peop_no, '$requests', '$customer_email')";
			
				//run query and check for erros in db
				$update = mysql_query($add_book, $db) or die(mysql_error());
				header ("Location: manager_bookings.php"); //refresh
			}
		//end code to add new booking
		?> 
	
		<h1 class="formHeaders"> Branch Bookings </h1>
	
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
					//SELECT WHAT BRANCH MANAGER IS VIEWING
					$option = isset($_POST['branch']) ? $_POST['branch'] : false;
					if ($option) {
						$findbranchID = $_POST['branch']; //set variable to option selected
					} else {
						$findbranchID = 101; //if no id is selected show for first branch
				    }
				?>
			</select>
		</form>
	
		<table>
			<tr> 
				<th> Booking ID </th>
				<th> Time For </th>
				<th> Branch ID </th>
				<th> No of People </th>
				<th> Special Requests </th> 
				<th> Customer Email </th> 
				<?php
				//CODE TO VIEW BOOKINGS
				
				//query code
				$book_query = "SELECT * FROM booking_view
							   WHERE branch_ID = '$findbranchID'";
				//run query and check for erros in db
				$result = mysql_query($book_query, $db) or die(mysql_error());
			
				//display all data meeting query requirements
				while ($row = mysql_fetch_array($result)) {
					echo "<tr><th> " . $row["booking_ID"];
					echo "</th><th> " . $row["Time"]; 
					echo "</th><th> " . $row["branch_ID"];
					echo "</th><th> " . $row["no_of_people"];
					echo "</th><th> " . $row["special_requests"];
					echo "</th><th> " . $row["email"]. "</th></tr>";
				} //end while
				//end php to view bookings
				?>
		</table>
	
		<h1 class="formHeaders"> Delete Booking </h1>
	
		<form> 
			Booking ID: <input type="text" name="deleteID"> 
						<input type="submit" value="Delete">
		</form> 
			<?php
				//if delete has an input
				if(isset($_GET['deleteID'])) {
					$deleteID = $_GET['deleteID']; //set search variable
					
					//select query with inner join to branch table from address table
					$query_dbooking = "DELETE FROM booking_view
								       WHERE booking_ID='$deleteID'";
									   
					//run query and check for erros in db
					mysql_query($query_dbooking, $db) or die(mysql_error());
					header ("Location: manager_bookings.php"); //refresh
				}
				//end php to delete a booking
			?>
		<div>
	</body>
</html>