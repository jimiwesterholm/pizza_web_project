<?php
	session_start();
	
	// session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
        <title>Pizza Hat</title>
		<link rel="stylesheet" type="text/css" href="customer.css" />
</head>

<body>
	<?php include 'topbar.php'; ?>

	<a name="pizzas"></a>
	<h1>Pizzas</h1>
	<article>
	<?php
		include "db.php";
		
		$query = "SELECT * FROM customer_pizza_view ORDER BY name,size";
		$result = mysql_query($query, $db);
		
		if($result === FALSE) { 
			die(mysql_error());
		}
		while ($row = mysql_fetch_array($result)) {
			if ($row["size"] == "Large") {
				echo "<div class=\"pizza\" style='margin:10px;'><center><img src='pizza.png'><br/>";
				echo "<font size='3'><b>".$row["name"]."</font></b><br/> ";
				if ($row["vegetarian"] == 1) {
					echo "<font color='#26B61A' size='3'>V</font> ";
				}
				$spice = $row["spice"];
				for ($i=0;$i<$spice;$i++) {
					echo " <img src='spice.png'>";
				}
				echo "</center>";
				$name = $row["name"];
				$query2 = "SELECT * FROM pizza_ingredient WHERE pizza_name='$name'";
				$result2 = mysql_query($query2,$db);
				
				if ($result2 == FALSE) {
					die(mysql_error());
				}
				while ($row2 = mysql_fetch_array($result2)) {
					echo $row2["ingredient_name"]." ";
				}
				echo "<br/><br/>";
			}
			echo $row["size"]." &pound; ".$row["price"]."<br/>";
			
			
	?>
	<form method="post" action="add_to_cart.php">
	<input type="hidden" value="add" name="action" />
	<input type="hidden" value="<?php echo $row["name"]; ?>" name="pname" />
	<input type="hidden" value="<?php echo $row["size"]; ?>" name="size" />
	<input type="hidden" value="<?php echo $row["price"]; ?>" name="price" />
	<input type="hidden" value="pizza" name="type" />
	<input type="text" value="1" name="quantity" size="1" />
	<input type="submit" value="Add to order" />
	</form><br/>
	<?php
			if ($row["size"] == "Small") {
				echo "</div>";
			}
		}
	?>
	</article> 
	<br />
	<a name="drinks"></a>
	<h1>Drinks</h1>
	<article>
		<?php
			$query = "SELECT * FROM customer_extra_view WHERE type='drink'";
			$result = mysql_query($query, $db);
			
			if($result === FALSE) { 
				die(mysql_error());
			}
			while ($row = mysql_fetch_array($result)) {
				echo "<div class='pizza' style='margin:15px;'>";
				echo $row["name"]."<br/>";
				echo "&pound; ".$row["price"]."<br/>";
		?>
			<form method="post" action="add_to_cart.php">
			<input type="hidden" value="add" name="action" />
			<input type="hidden" value="<?php echo $row["name"]; ?>" name="pname" />
			<input type="hidden" value="<?php echo $row["price"]; ?>" name="price" />
			<input type="hidden" value="extra" name="type" />
			<input type="text" value="1" name="quantity" size="1" />
			<input type="submit" value="Add to order" />
			</form>
		</div>
		<?php
			}
		?>
	</article>

	<br />
	<a name="extras"></a>
	<h1>Extras</h1>
	<article>
		<?php
			$query = "SELECT * FROM customer_extra_view WHERE type NOT IN ('drink')";
			$result = mysql_query($query, $db);
			
			if($result === FALSE) { 
				die(mysql_error());
			}
			while ($row = mysql_fetch_array($result)) {
				echo "<div class='pizza' style='margin:15px;'>";
				echo $row["name"]."<br/>";
				echo "&pound; ".$row["price"]."<br/>";
		?>
			<form method="post" action="add_to_cart.php">
			<input type="hidden" value="add" name="action" />
			<input type="hidden" value="<?php echo $row["name"]; ?>" name="pname" />
			<input type="hidden" value="<?php echo $row["price"]; ?>" name="price" />
			<input type="hidden" value="extra" name="type" />
			<input type="text" value="1" name="quantity" size="1" />
			<input type="submit" value="Add to order" />
			</form>
		</div>
		<?php
			}
		?>
	</article>
	<?php mysql_close($db); ?>
	

</body>
</html>
