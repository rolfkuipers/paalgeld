<?php
//connect to database
$host="localhost";
$username="knr17455_paal";
$password="paalgeld";
$db_name="knr17455_paalgeld";


mysql_connect("$host", "$username", "$password")or die("cannot connect to server");
mysql_select_db("$db_name")or die("cannot select db"); 
?>