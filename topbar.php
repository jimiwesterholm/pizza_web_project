<?php
	if (!isset($_SESSION['order_sum'])) {
		$_SESSION["total_price"] = 0;
	}
	if (!isset($_SESSION['order_sum'])) {
		$order_array = [];
		$_SESSION['order_sum'] = $order_array;
	}
	if (!isset($_SESSION['customer_login'])) {
		$_SESSION['customer_login'] = NULL;
	}
?>

<div class="topbar">
	<a href="yourorder.php">Your order &pound;
	<?php echo $_SESSION["total_price"]; ?>
	<img src="shopcart.png"></a>
	<?php if ($_SESSION["customer_login"] == NULL) { ?>
	<a href="customer_login.php">Login</a> <a href="customer_register.php">Register</a>
	<?php } else {
		echo "<a href='customeracc.php'>".$_SESSION["customer_login"]."</a> ";
	?>
		<form style="display:inline;" method="POST" action="customer_logout.php">
		<input type="submit" value="Logout"/>
		</form>
	<?php } ?>
	
</div>
<nav>
	<table align="center"><tr><td>
	<a href="index.php"><img src="pizzahat.png"></a>
	</td><td>
	<a href="index.php#pizzas">Pizzas</a> 
	<a href="index.php#drinks">Drinks</a> 
	<a href="index.php#extras">Extras</a> 
	<a href="find_a_hat.php">Find a hat</a>
	</td></tr></table>
</nav>