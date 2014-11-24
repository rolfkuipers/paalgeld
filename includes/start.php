<?php 

function index() {
	//eventueel database logica en data verwerken
	include('config/database.php');
	$query = mysql_query("SELECT * FROM paalgeld");
	$data = mysql_fetch_array($query, MYSQL_ASSOC);

	$title = 'Dit is een test';
	

	//uiteindelijk view laden
	include('views/header.php');
	include('views/start.php');
	include('views/footer.php');
}



//werken met functies maakt het mogelijk om later met subpaginas te werken
index()

?>