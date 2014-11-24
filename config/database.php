<?php
//connect to database
$host="localhost";
$username="root";
$password="root";
$db_name="paal";


$mysqli = new mysqli($host, $username, $password, $db_name);
	
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
?>