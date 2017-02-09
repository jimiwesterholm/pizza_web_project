<?php
include "db.php";

//Log out
session_unset();
session_destroy();

header ("Location: staff_log_in.php");

?>