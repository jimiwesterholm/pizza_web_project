<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
        <title>Pizza Hat</title>
		<link rel="stylesheet" type="text/css" href="customer.css" />
</head>

<body>
	<?php include 'topbar.php'; ?>
	
	<article>
		<?php
			if (!isset($_SESSION['order_error'])) {
				echo "<center><font size='3'>Your order was placed! <br/><br/>";
				echo "Order ID: <b>".$_SESSION["orderID"]."</b> Total: <b>&pound; ".$_SESSION["total_price"]."</b></font></center>";
			}
			else {
				echo $_SESSION["order_error"];
			}
			unset($_SESSION["order_error"]);
			unset($_SESSION["total_price"]);
			unset($_SESSION["order_sum"]);
			unset($_SESSION["orderID"]);
			unset($_SESSION["order_branch"]);
			unset($_SESSION["ordertype"]);
			
		?>
	</article>
</body>
</html>