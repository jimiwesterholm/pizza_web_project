<?php
	session_start();
	$_SESSION["order_branch"] = $_POST["branch"];
	if($_POST["source"] == "findhat" ) {
		header("Location: https://zeno.computing.dundee.ac.uk/2016-ac32006/team18");
	}
	else {
		header("Location: https://zeno.computing.dundee.ac.uk/2016-ac32006/team18/confirmorder.php");
	}
?>