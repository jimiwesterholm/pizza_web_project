<?php
	session_start();
	include "db.php"; //include connection to database
	$search = isset($_POST['search']) ? $_POST['search'] : '';
?>

<!DOCTYPE html>
<html>
<head>
        <title>Find a Hat</title>
		<link rel="stylesheet" type="text/css" href="customer.css" />
</head>

	<body>
		<?php include '\topbar.php'; ?>
	
	<h1> Find Our Nearest Store </h1>
	<article>
	<form align="center" style="margin-top:10px">
		<input type="text" name="search" id="search" placeholder="Your City..." />
		<input type="submit" value="Search" />
	</form>
		<?php
		
		//if search has an input
		if(isset($_GET['search'])) {
			$search = $_GET['search']; //set search variable
			//select query with inner join to branch table from address table
			$query = "SELECT * FROM address 
					  INNER JOIN branch ON address.addressID=branch.addressID 
					  WHERE city='$search'";
			$result = mysql_query($query, $db) or die(mysql_error());
			
			//return what city was searched for
			echo " <h2> Results for " .$search. "</h2>";
			
			//display all data meeting query requirements
			while ($row = mysql_fetch_array($result)) {
				echo "<table style='display:inline-block;padding:20px;'><tr><td><b>Branch</b> </td><td>" . $row["branchID"]. "</td></tr><tr><td>Phone Number</td><td>".$row["phone_number"]. "<tr><td>Store Email</td><td>".$row["email"] ;
				echo "</td></tr><tr><td>Address</td><td>" . $row["street_address"]. "</td></tr><tr><td>City</td><td>".$row["city"]. "</td></tr><tr><td>Postcode</td><td>".$row["postcode"] ;
				echo "</td></tr><tr><td colspan='2' align='center'><form method='post' action='place_branch.php'> <input type='submit' value='Place order for this branch' /><input type='hidden' name='branch' value='".$row["branchID"]."' /><input type='hidden' name='source' value='findhat' /></form></td></tr</table>";
			}
			//if no results were found
			if(mysql_num_rows($result) <= 0)
			{
				echo "<br> Sorry, no stores in your city yet";
			}	
		}
		?>
		</article>
	</body>
</html>