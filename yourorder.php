<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
        <title>Pizza Hat</title>
		<link rel="stylesheet" type="text/css" href="customer.css" />
</head>

<body>
	<?php include 'topbar.php'; ?>

	<h1>Your Order summary</h1>
	<article>
	<?php
		if (empty($_SESSION["order_sum"])) {
			echo "There are no items in your order";
		}
		else {
			foreach($_SESSION["order_sum"] as $item) {
				for($i=$item["quantity"];$i>0;$i--) {
			?>
			<div style="padding: 15px 20% 15px 20%;">
				<?php	
						if ($item["type"] == "pizza") {
							echo $item["size"]." ";
						}
						echo $item["name"];
						echo "<div style='float:right;'>&pound; ".$item["price"]."<br/>";
				?></div><br/>
				<form action="add_to_cart.php" method="post" style="float:right;">
				<input type="hidden" value="remove" name="action" />
				<input type="hidden" value="<?php echo $item["name"]; ?>" name="pname" />
				<?php if ($item["type"] == "pizza") { ?>
				<input type="hidden" value="<?php echo $item["size"]; ?>" name="size" />
				<?php } ?>
				<input type="hidden" value="<?php echo $item["price"]; ?>" name="price" />
				<input type="hidden" value="<?php echo $item["type"]; ?>" name="type" />
				<input type="submit" value="Remove" />
				</form>
			</div><br/>
	<?php
				}
			}
	?>
	<div align="center">
	<?php
	if (isset($_SESSION["email_error"])) {
		echo "<font color='#E71E1E'>".$_SESSION["email_error"]."</font><br/><br/>";
		unset($_SESSION["email_error"]);
	} ?>
	<font size="3">Total <b>&pound; <?php echo $_SESSION["total_price"]; ?></b></font> <br/><br/>
	<form method="post" action="confirmorder.php">
		<input type="radio" name="sitin" value="Collection" checked="checked" /> Collection 
		<input type="radio" name="sitin" value="Delivery" /> Delivery 
		<input type="radio" name="sitin" value="Sitin" /> Sitting in <br/><br/>
		<input type="submit" value="Continue to Checkout" />
	</form>
	</div>
	<?php
		}
	?>
	</article>
	

</body>
</html>
