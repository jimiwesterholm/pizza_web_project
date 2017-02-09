<?php 
session_start();
include "db.php"; //include connection to database
?>

<!DOCTYPE html>

<html>
<head>
        <title>Pizza Hat - Staff </title>		
</head>

<body>
	
	<?php include 'staff_home.php'; ?>
	
	<div class="formHolder">
	<h1 class="formHeaders"> Add Booking </h1>
	
	<form>
		Booking Time: <br><input type="text" name="time"><br>
		Number of People: <br><input type="text" name="peop_no"><br>
		Special Requests: <br><input type="text" name="requests"><br>
		Customer Email: <br><input type="text" name="customer_email">
		<input type="submit" >
	</form> 
	
	<?php 
		//PHP TO ADD NEW BOOKING TO DATABASE
		
		//IF FROM IS FILLED IN FOR ALL VARIABLES
		if(isset($_GET['time']) && isset($_GET['peop_no']) && isset($_GET['requests']) && isset($_GET['customer_email'])) {

			//SET ALL VARIABLES FOR THE NEW BOOKING

			
			do {
				$book_id = rand(1,100000); //create random number for booking id
				$q = "SELECT booking_ID FROM booking_view WHERE booking_ID = '$book_id'";
			} while (!mysql_query($q, $db));
			
			$time = $_GET['time']; //get time from form
				
			//set branch id to staff making booking as staff can only make bookings for their own branch
			$get_branch_id = "SELECT branchID FROM staff_view WHERE staffID = '$staffID'";
			$result = mysql_query($get_branch_id, $db) or die(mysql_error());
			$row = mysql_fetch_array($result);
			$branch_id = $row["branchID"] ;
			
			$peop_no = $_GET['peop_no']; //get number of people from form
			$requests = $_GET['requests']; //get requests from form
			$customer_email = $_GET['customer_email']; //get email from form			
			
			//insert new booking into database
			$add_book = "INSERT INTO booking_view
						 VALUES ($book_id, $time, $branch_id, $peop_no, '$requests', '$customer_email')";
			$update = mysql_query($add_book, $db) or die(mysql_error());
			header ("Location: staff_bookings.php"); //refresh
			} //end php for add new booking 
		?> 
	
	<h1 class="formHeaders"> Branch Bookings </h1>
	
	<table>
		 <tr> 
			<th> Booking ID </th>
			<th> Time For </th>
			<th> Branch ID </th>
			<th> No of People </th>
			<th> Special Requests </th> 
			<th> Customer Email </th> 
		<?php
		//PHP TO DISPLAY BOOKINGS
		//only display bookings for member of staffs own branch
		
			$book_query = "SELECT * FROM booking_view
						   WHERE branch_ID = 
						   ( SELECT branchID
							 FROM staff_view
							 WHERE staffID = '$staffID')"; //select from booking table
			$result = mysql_query($book_query, $db) or die(mysql_error());
			
			//display all data for bookings
			while ($row = mysql_fetch_array($result)) {
				echo "<tr><th> " . $row["booking_ID"];
				echo "</th><th> " . $row["Time"]; 
				echo "</th><th> " . $row["branch_ID"];
				echo "</th><th> " . $row["no_of_people"];
				echo "</th><th> " . $row["special_requests"];
				echo "</th><th> " . $row["email"]. "</tr>";
			} //end php to display bookings
		?>
    </table>
	
	<h1 class="formHeaders"> Delete Booking </h1>
	
	<form> 
		Booking ID: <input type="text" name="deleteID"> 
		<input type="submit" value="Delete">
	</form> 
			<?php
			//PHP FOR DELETE A BOOKING 
				//if delete has an input
				if(isset($_GET['deleteID'])) {
					$deleteID = $_GET['deleteID']; //set search variable
					
					//delete query
					$query_dbook = "DELETE FROM booking_view
								WHERE booking_ID='$deleteID'";
					mysql_query($query_dbook, $db) or die(mysql_error());
					header ("Location: staff_bookings.php"); //refresh
				} //end php for delete a booking
			?>
	<div>
	
</body>
</html>