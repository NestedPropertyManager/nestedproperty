<?php
//define the host of the mysql database
$dbhost = "localhost";

//define the mysql database user
$dbuser = "root";

//define the mysql database password
$dbpass = "";

//define the database to be use
$dbselect = "propertymanager";

//<table class="bordered" width="450" cellspacing="1" cellpadding="1">
//establish a connection to the database
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbselect)or die("Could not connect to the database.");

//select the database to be used
//mysql_select_db($dbselect) or die("Could not select database");

?>
