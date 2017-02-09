<?php
// CONNECT TO DATABASE
$db = mysql_connect("silva.computing.dundee.ac.uk", "16ac3u18","111ccc");
// SELECT DATABASE
mysql_select_db("16ac3d18");
if(!$db){
	echo mysql_error() ;
}
?>