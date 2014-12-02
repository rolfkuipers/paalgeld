<?php 

function index() {
	//eventueel database logica en data verwerken
	include('config/database.php');
	$query = "SELECT paalgeld.*, places.`Modern Country` FROM `paalgeld` LEFT JOIN places ON paalgeld.soundcode = places.Kode";
	$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
	while($row = $result->fetch_assoc()) {
		$row['goods-value'] = $row['tax-decimal'] * 500;
		$data[] = $row;	
	}


	//uiteindelijk view laden
	include('views/header.php');
	include('views/start.php');
	include('views/footer.php');
}



//werken met functies maakt het mogelijk om later met subpaginas te werken
index()

?>